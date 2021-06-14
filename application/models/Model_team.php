<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_team extends CI_Model
{

	public function contruct()
	{
		parent::__construct();
	}

    public function get_all_team(){
        return $this->db->where('is_deleted', '0')->get('team')->result();
    }

    public function get_data_team($post){

        $this->output->enable_profiler(false);
		$arrsearch = $post['search'];
		$start = $post['start'];
		$length = $post['length'];
        $search = $arrsearch['value'];
        $order = $post['order'];

        $qsearch = '';

        $where = '';  
        
        if($search != '') {
            $where .= "
                AND (
                    nama_tim LIKE '%".$search."%' OR
                    tahun_berdiri LIKE '%".$search."%' OR
                    alamat_markas_tim LIKE '%".$search."%' OR
                    kota_markas_tim LIKE '%".$search."%'
                )
            ";
        }

        $coloumn = $order[0]['column'];

		$dir = $order[0]['dir'];

        if($coloumn == 0){
            $coloumn_by = 'date_created '.$dir.'';
        }elseif($coloumn == 2){
            $coloumn_by = 'nama_tim '.$dir.'';
		}elseif($coloumn == 3){
            $coloumn_by = 'tahun_berdiri '.$dir.'';
        }elseif($coloumn == 5){
            $coloumn_by = 'kota_markas_tim '.$dir.'';
        }

        $json = array();

        $sql = 'SELECT *
            FROM team
            WHERE is_deleted = 0
            '.$where.'
            ORDER BY '.$coloumn_by.' 
        ';

        $query = $this->db->query($sql);

		$total = $query->num_rows();
		$json['recordsFiltered'] = $total;
		$json['recordsTotal'] = $total;
		$json['draw'] = $this->input->post('draw');

		$json['data'] = array();

		$sql .= "LIMIT ".$start.",".$length.";";

		$query = $this->db->query($sql);

        $i=0;
        $no = 1;
        foreach ($query->result() as $k => $v) {
            $json['data'][$i]['no'] = $no;
            if($v->logo_tim == '-'){
                $json['data'][$i]['logo'] = '<img src="https://via.placeholder.com/60" alt="Logo Tim" class="img-thumb" style="width: 30%; border-radius: 0px">';
            }else{
                $json['data'][$i]['logo'] = '<img src="'.$v->logo_tim.'" alt="Logo Tim" class="img-thumb" style="width: 30%; border-radius: 0px">';
            }
			$json['data'][$i]['name'] = $v->nama_tim;
            $json['data'][$i]['tahun'] = $v->tahun_berdiri;
            $json['data'][$i]['alamat'] = $v->alamat_markas_tim;
            $json['data'][$i]['kota'] = $v->kota_markas_tim;
            $json['data'][$i]['action'] = '<div style="white-space:nowrap;">';
            $json['data'][$i]['action'] .= '<button class="btn btn-success mr-2" onclick="editData('.$v->id.')" style="padding: 10px"><i class="fa fa-pencil"></i> <b>EDIT</b></button>';
			$json['data'][$i]['action'] .= '<button class="btn btn-danger" onclick="deleteData('.$v->id.')" style="padding: 10px"><i class="fa fa-trash"></i> <b>DELETE</b></button>';
            $json['data'][$i]['action'] .= '</div>';
            $no++;
			$i++;
        }

        return $json;
    }

    public function submit_team($post){
        date_default_timezone_set('Asia/Jakarta');

        $data = array(
            'nama_tim' => $post['nama_tim'],
            'logo_tim' => $post['logo_tim'],
            'tahun_berdiri' => $post['tahun_berdiri'],
            'kota_markas_tim' => $post['kota_markas_tim'],
            'alamat_markas_tim' => $post['alamat_markas_tim'],
            'is_deleted' => 0,
            'date_created' => date('Y-m-d H:i:s'),
        );

        $result = $this->db->insert('team', $data);

        if($result){
            $data['result'] = $result;
            $data['message'] = 'Berhasil menambahkan team';
            $data['status'] = 200;
        }else{
            $data['result'] = [];
            $data['message'] = 'Gagal menambahkan team';
            $data['status'] = 500;
        }

        return $data;
    }

    public function get_team_by_id($id){
        return $this->db->where('id', $id)->get('team')->row();
    }

    public function update_team($post){

        $data = array(
            'nama_tim' => $post['nama_tim'],
            'logo_tim' => $post['logo_tim'],
            'tahun_berdiri' => $post['tahun_berdiri'],
            'kota_markas_tim' => $post['kota_markas_tim'],
            'alamat_markas_tim' => $post['alamat_markas_tim']
        );

        $result = $this->db->where('id', $post['id'])->update('team', $data);

        if($result){
            $data['result'] = $result;
            $data['message'] = 'Berhasil update team';
            $data['status'] = 200;
        }else{
            $data['result'] = [];
            $data['message'] = 'Gagal update team';
            $data['status'] = 500;
        }

        return $data;
    }

    public function remove_team($id)
    {
        $result = $this->db->where('id', $id)->set('is_deleted', '1')->update('team');

        if($result){
            $data['result'] = $result;
            $data['message'] = 'Berhasil menghapus team';
            $data['status'] = 200;
        }else{
            $data['result'] = [];
            $data['message'] = 'Gagal menghapus team';
            $data['status'] = 500;
        }

        return $data;
    }
}