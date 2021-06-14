<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_report extends CI_Model
{

    public function contruct()
    {
        parent::__construct();
    }

    public function get_data_report($post, $id)
    {

        $this->output->enable_profiler(false);
        $arrsearch = $post['search'];
        $start = $post['start'];
        $length = $post['length'];
        $search = $arrsearch['value'];
        $order = $post['order'];

        $qsearch = '';

        $where = '';

        if ($search != '') {
            $where .= "
                AND (
                    a.total_score LIKE '%" . $search . "%' OR
                    DATE_FORMAT(b.tanggal_pertandingan, '%e %b %Y') LIKE '%" . $search . "%' OR
                    c.nama_tim LIKE '%" . $search . "%' OR
                    d.nama_tim LIKE '%" . $search . "%' OR
                    e.nama_pemain LIKE '%" . $search . "%'
                )
            ";
        }

        $coloumn = $order[0]['column'];

        $dir = $order[0]['dir'];

        if ($coloumn == 0) {
            $coloumn_by = 'a.date_created ' . $dir . '';
        } elseif ($coloumn == 1) {
            $coloumn_by = 'b.tanggal_pertandingan ' . $dir . '';
        } elseif ($coloumn == 2) {
            $coloumn_by = 'b.waktu_pertandingan ' . $dir . '';
        } elseif ($coloumn == 3) {
            $coloumn_by = 'c.nama_tim ' . $dir . '';
        } elseif ($coloumn == 4) {
            $coloumn_by = 'd.nama_tim ' . $dir . '';
        } elseif ($coloumn == 5) {
            $coloumn_by = 'a.total_score ' . $dir . '';
        } elseif ($coloumn == 6) {
            $coloumn_by = 'e.nama_pemain ' . $dir . '';
        } elseif ($coloumn == 7) {
            $coloumn_by = 'a.time_score ' . $dir . '';
        }

        $json = array();

        $sql = 'SELECT a.id,
            DATE_FORMAT(b.tanggal_pertandingan, "%e %b %Y") as tanggal_pertandingan,
            DATE_FORMAT(b.waktu_pertandingan, "%H:%i") as waktu_pertandingan,
            c.nama_tim as tim_tuan_rumah,
            d.nama_tim as tim_tamu,
            a.total_score,
            e.nama_pemain as player_score,
            a.time_score
            FROM report a
            LEFT JOIN schedule b ON a.schedule_id = b.id
            LEFT JOIN team c ON b.tim_tuan_rumah = c.id
            LEFT JOIN team d ON b.tim_tamu = d.id
            LEFT JOIN player e ON a.player_score = e.id
            WHERE a.is_deleted = 0
            AND a.schedule_id = ' . $id . '
            ' . $where . '
            ORDER BY ' . $coloumn_by . ' 
        ';

        $query = $this->db->query($sql);

        $total = $query->num_rows();
        $json['recordsFiltered'] = $total;
        $json['recordsTotal'] = $total;
        $json['draw'] = $this->input->post('draw');

        $json['data'] = array();

        $sql .= "LIMIT " . $start . "," . $length . ";";

        $query = $this->db->query($sql);

        $i = 0;
        $no = 1;
        foreach ($query->result() as $k => $v) {
            $json['data'][$i]['no'] = $no;
            $json['data'][$i]['date'] = $v->tanggal_pertandingan;
            $json['data'][$i]['time'] = $v->waktu_pertandingan;
            $json['data'][$i]['tuan_rumah'] = $v->tim_tuan_rumah;
            $json['data'][$i]['tamu'] = $v->tim_tamu;
            $json['data'][$i]['total_score'] = $v->total_score;
            $json['data'][$i]['player_score'] = $v->player_score;
            $json['data'][$i]['time_score'] = $v->time_score;
            $json['data'][$i]['action'] = '<div style="white-space:nowrap;">';
            $json['data'][$i]['action'] .= '<button class="btn btn-success mr-2" onclick="editData(' . $v->id . ')" style="padding: 10px"><i class="fa fa-pencil"></i> <b>EDIT</b></button>';
            $json['data'][$i]['action'] .= '<button class="btn btn-danger" onclick="deleteData(' . $v->id . ')" style="padding: 10px"><i class="fa fa-trash"></i> <b>DELETE</b></button>';
            $json['data'][$i]['action'] .= '</div>';
            $no++;
            $i++;
        }

        return $json;
    }

    public function submit_report($post)
    {
        date_default_timezone_set('Asia/Jakarta');

        $data = array(
            'schedule_id' => $post['schedule_id'],
            'total_score' => $post['total_score'],
            'player_score' => $post['player_score'],
            'time_score' => $post['time_score'],
            'is_deleted' => 0,
            'date_created' => date('Y-m-d H:i:s'),
        );

        $result = $this->db->insert('report', $data);

        if ($result) {
            $data['result'] = $result;
            $data['message'] = 'Berhasil menambahkan hasil pertandingan';
            $data['status'] = 200;
        } else {
            $data['result'] = [];
            $data['message'] = 'Gagal menambahkan hasil pertandingan';
            $data['status'] = 500;
        }


        return $data;
    }

    public function get_report_by_id($id)
    {
        return $this->db->select('
        a.id,
        a.schedule_id,
        b.tanggal_pertandingan, 
        b.waktu_pertandingan,  
        c.nama_tim as tim_tuan_rumah,
        d.nama_tim as tim_tamu,
        a.total_score,
        a.player_score,
        e.nama_pemain as player_name,
        a.time_score,
        f.id as tim_score
        ')
        ->from('report a')
        ->join('schedule b', 'a.schedule_id = b.id', 'left')
        ->join('team c', 'b.tim_tuan_rumah = c.id', 'left')
        ->join('team d', 'b.tim_tamu = d.id', 'left')
        ->join('player e', 'a.player_score = e.id', 'left')
        ->join('team f', 'e.team_id = f.id', 'left')
        ->where('a.id', $id)
        ->get()->row();
    }

    public function update_report($post)
    {

        date_default_timezone_set('Asia/Jakarta');

        $data = array(
            'schedule_id' => $post['schedule_id'],
            'total_score' => $post['total_score'],
            'player_score' => $post['player_score'],
            'time_score' => $post['time_score'],
        );

        $result = $this->db->where('id', $post['id'])->update('report', $data);

        if ($result) {
            $data['result'] = $result;
            $data['message'] = 'Berhasil update hasil pertandingan';
            $data['status'] = 200;
        } else {
            $data['result'] = [];
            $data['message'] = 'Gagal update hasil pertandingan';
            $data['status'] = 500;
        }

        return $data;
    }

    public function remove_report($id)
    {
        $result = $this->db->where('id', $id)->set('is_deleted', '1')->update('report');

        if ($result) {
            $data['result'] = $result;
            $data['message'] = 'Berhasil menghapus hasil pertandingan';
            $data['status'] = 200;
        } else {
            $data['result'] = [];
            $data['message'] = 'Gagal menghapus hasil pertandingan';
            $data['status'] = 500;
        }

        return $data;
    }
}
