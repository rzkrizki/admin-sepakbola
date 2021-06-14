<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_schedule extends CI_Model
{

    public function contruct()
    {
        parent::__construct();
    }

    public function get_data_schedule($post)
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
                    DATE_FORMAT(a.tanggal_pertandingan, '%e %b %Y') LIKE '%" . $search . "%' OR
                    b.nama_tim LIKE '%" . $search . "%' OR
                    c.nama_tim LIKE '%" . $search . "%'
                )
            ";
        }

        $coloumn = $order[0]['column'];

        $dir = $order[0]['dir'];

        if ($coloumn == 0) {
            $coloumn_by = 'a.date_created ' . $dir . '';
        } elseif ($coloumn == 1) {
            $coloumn_by = 'a.tanggal_pertandingan ' . $dir . '';
        } elseif ($coloumn == 2) {
            $coloumn_by = 'a.waktu_pertandingan ' . $dir . '';
        } elseif ($coloumn == 3) {
            $coloumn_by = 'b.nama_tim ' . $dir . '';
        } elseif ($coloumn == 4) {
            $coloumn_by = 'c.nama_tim ' . $dir . '';
        }

        $json = array();

        $sql = 'SELECT a.id,
            DATE_FORMAT(a.tanggal_pertandingan, "%e %b %Y") as tanggal_pertandingan,
            DATE_FORMAT(a.waktu_pertandingan, "%H:%i") as waktu_pertandingan,
            b.nama_tim as tim_tuan_rumah,
            c.nama_tim as tim_tamu
            FROM schedule a
            LEFT JOIN team b ON a.tim_tuan_rumah = b.id
            LEFT JOIN team c ON a.tim_tamu = c.id
            WHERE a.is_deleted = 0
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
            $json['data'][$i]['action'] = '<div style="white-space:nowrap;">';
            $json['data'][$i]['action'] .= '<button class="btn btn-info mr-2" onclick="showReport(' . $v->id . ')" style="padding: 10px"><i class="fa fa-book"></i> <b>LIHAT HASIL PERTANDINGAN</b></button>';
            $json['data'][$i]['action'] .= '<button class="btn btn-success mr-2" onclick="editData(' . $v->id . ')" style="padding: 10px"><i class="fa fa-pencil"></i> <b>EDIT</b></button>';
            $json['data'][$i]['action'] .= '<button class="btn btn-danger" onclick="deleteData(' . $v->id . ')" style="padding: 10px"><i class="fa fa-trash"></i> <b>DELETE</b></button>';
            $json['data'][$i]['action'] .= '</div>';
            $no++;
            $i++;
        }

        return $json;
    }

    public function submit_schedule($post)
    {
        date_default_timezone_set('Asia/Jakarta');

        $data = array(
            'tanggal_pertandingan' => date("Y-m-d", strtotime($post['tanggal_pertandingan'])),
            'waktu_pertandingan' => $post['waktu_pertandingan'],
            'tim_tuan_rumah' => $post['tim_tuan_rumah'],
            'tim_tamu' => $post['tim_tamu'],
            'is_deleted' => 0,
            'date_created' => date('Y-m-d H:i:s'),
        );

        $exist_schedule_tuan_rumah = $this->db->where('tim_tuan_rumah', $post['tim_tuan_rumah'])
            ->where('tanggal_pertandingan', date("Y-m-d", strtotime($post['tanggal_pertandingan'])))
            ->where('waktu_pertandingan', $post['waktu_pertandingan'])
            ->get('schedule')->num_rows();

        $exist_schedule_tamu = $this->db->where('tim_tamu', $post['tim_tamu'])
            ->where('tanggal_pertandingan', date("Y-m-d", strtotime($post['tanggal_pertandingan'])))
            ->where('waktu_pertandingan', $post['waktu_pertandingan'])
            ->get('schedule')->num_rows();

        $exist_schedule = $this->db->where('tim_tuan_rumah', $post['tim_tuan_rumah'])
            ->where('tim_tamu', $post['tim_tamu'])
            ->where('tanggal_pertandingan', date("Y-m-d", strtotime($post['tanggal_pertandingan'])))
            ->where('waktu_pertandingan', $post['waktu_pertandingan'])
            ->get('schedule')->num_rows();


        if ($exist_schedule > 0) {
            $data['result'] = [];
            $data['message'] = 'Jadwal pertandingan tersebut sudah ada';
            $data['status'] = 500;
        } else if ($exist_schedule_tuan_rumah > 0) {
            $data['result'] = [];
            $data['message'] = 'Jadwal tim tuan rumah sudah ada ditanggal dan waktu tersebut';
            $data['status'] = 500;
        } else if ($exist_schedule_tamu > 0) {
            $data['result'] = [];
            $data['message'] = 'Jadwal tim tamu sudah ada ditanggal dan waktu tersebut';
            $data['status'] = 500;
        } else {
            $result = $this->db->insert('schedule', $data);

            if ($result) {
                $data['result'] = $result;
                $data['message'] = 'Berhasil menambahkan jadwal pertandingan';
                $data['status'] = 200;
            } else {
                $data['result'] = [];
                $data['message'] = 'Gagal menambahkan jadwal pertandingan';
                $data['status'] = 500;
            }
        }

        return $data;
    }

    public function get_schedule_by_id($id)
    {
        return $this->db->where('id', $id)->get('schedule')->row();
    }

    public function get_schedule_for_report($id){
        return $this->db->select('a.tanggal_pertandingan, a.waktu_pertandingan, b.nama_tim as tim_tuan_rumah, c.nama_tim as tim_tamu')
        ->from('schedule a')
        ->join('team b', 'a.tim_tuan_rumah = b.id', 'left')
        ->join('team c', 'a.tim_tamu = c.id', 'left')
        ->where('a.id', $id)
        ->get()
        ->row();
    }

    public function update_schedule($post)
    {

        date_default_timezone_set('Asia/Jakarta');

        $data = array(
            'tanggal_pertandingan' => date("Y-m-d", strtotime($post['tanggal_pertandingan'])),
            'waktu_pertandingan' => $post['waktu_pertandingan'],
            'tim_tuan_rumah' => $post['tim_tuan_rumah'],
            'tim_tamu' => $post['tim_tamu'],
            'is_deleted' => 0,
            'date_created' => date('Y-m-d H:i:s'),
        );

        $exist_schedule_tuan_rumah = $this->db->where_not_in('id', $post['id'])
            ->where('tim_tuan_rumah', $post['tim_tuan_rumah'])
            ->where('tanggal_pertandingan', date("Y-m-d", strtotime($post['tanggal_pertandingan'])))
            ->where('waktu_pertandingan', $post['waktu_pertandingan'])
            ->get('schedule')->num_rows();

        $exist_schedule_tamu = $this->db->where_not_in('id', $post['id'])
            ->where('tim_tamu', $post['tim_tamu'])
            ->where('tanggal_pertandingan', date("Y-m-d", strtotime($post['tanggal_pertandingan'])))
            ->where('waktu_pertandingan', $post['waktu_pertandingan'])
            ->get('schedule')->num_rows();

        $exist_schedule = $this->db->where_not_in('id', $post['id'])
            ->where('tim_tuan_rumah', $post['tim_tuan_rumah'])
            ->where('tim_tamu', $post['tim_tamu'])
            ->where('tanggal_pertandingan', date("Y-m-d", strtotime($post['tanggal_pertandingan'])))
            ->where('waktu_pertandingan', $post['waktu_pertandingan'])
            ->get('schedule')->num_rows();


        if ($exist_schedule > 0) {
            $data['result'] = [];
            $data['message'] = 'Jadwal pertandingan tersebut sudah ada';
            $data['status'] = 500;
        } else if ($exist_schedule_tuan_rumah > 0) {
            $data['result'] = [];
            $data['message'] = 'Jadwal tim tuan rumah sudah ada ditanggal dan waktu tersebut';
            $data['status'] = 500;
        } else if ($exist_schedule_tamu > 0) {
            $data['result'] = [];
            $data['message'] = 'Jadwal tim tamu sudah ada ditanggal dan waktu tersebut';
            $data['status'] = 500;
        } else {
            $result = $this->db->where('id', $post['id'])->update('schedule', $data);

            if ($result) {
                $data['result'] = $result;
                $data['message'] = 'Berhasil update jadwal pertandingan';
                $data['status'] = 200;
            } else {
                $data['result'] = [];
                $data['message'] = 'Gagal update jadwal pertandingan';
                $data['status'] = 500;
            }
        }

        return $data;
    }

    public function remove_schedule($id)
    {
        $result = $this->db->where('id', $id)->set('is_deleted', '1')->update('schedule');

        if ($result) {
            $data['result'] = $result;
            $data['message'] = 'Berhasil menghapus jadwal pertandingan';
            $data['status'] = 200;
        } else {
            $data['result'] = [];
            $data['message'] = 'Gagal menghapus jadwal pertandingan';
            $data['status'] = 500;
        }

        return $data;
    }
}
