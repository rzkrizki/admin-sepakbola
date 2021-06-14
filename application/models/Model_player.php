<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_player extends CI_Model
{

	public function contruct()
	{
		parent::__construct();
	}

    public function get_all_player(){
        return $this->db->where('is_deleted', '0')->get('player')->result();
    }

    public function get_data_player($post){

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
                    b.nama_tim LIKE '%".$search."%' OR
                    a.nama_pemain LIKE '%".$search."%' OR
                    a.tinggi_badan LIKE '%".$search."%' OR
                    a.berat_badan LIKE '%".$search."%' OR
                    a.posisi_pemain LIKE '%".$search."%' OR
                    a.nomor_punggung LIKE '%".$search."%' OR
                )
            ";
        }

        $coloumn = $order[0]['column'];

		$dir = $order[0]['dir'];

        if($coloumn == 0){
            $coloumn_by = 'a.date_created '.$dir.'';
        }elseif($coloumn == 1){
            $coloumn_by = 'b.nama_tim '.$dir.'';
		}elseif($coloumn == 2){
            $coloumn_by = 'a.nama_pemain '.$dir.'';
        }elseif($coloumn == 3){
            $coloumn_by = 'a.tinggi_badan '.$dir.'';
        }elseif($coloumn == 4){
            $coloumn_by = 'a.berat_badan '.$dir.'';
        }elseif($coloumn == 5){
            $coloumn_by = 'a.posisi_pemain '.$dir.'';
        }elseif($coloumn == 6){
            $coloumn_by = 'a.nomor_punggung '.$dir.'';
        }

        $json = array();

        $sql = 'SELECT a.*, b.nama_tim
            FROM player a
            LEFT JOIN team b ON a.team_id = b.id
            WHERE a.is_deleted = 0
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
			$json['data'][$i]['team'] = $v->nama_tim;
            $json['data'][$i]['nama'] = $v->nama_pemain;
            $json['data'][$i]['tinggi'] = $v->tinggi_badan . ' cm';
            $json['data'][$i]['berat'] = $v->berat_badan . ' kg';
            $json['data'][$i]['posisi'] = ucwords(str_replace('_', ' ', $v->posisi_pemain));
            $json['data'][$i]['nomor'] = $v->nomor_punggung;
            $json['data'][$i]['action'] = '<div style="white-space:nowrap;">';
            $json['data'][$i]['action'] .= '<button class="btn btn-success mr-2" onclick="editData('.$v->id.')" style="padding: 10px"><i class="fa fa-pencil"></i> <b>EDIT</b></button>';
			$json['data'][$i]['action'] .= '<button class="btn btn-danger" onclick="deleteData('.$v->id.')" style="padding: 10px"><i class="fa fa-trash"></i> <b>DELETE</b></button>';
            $json['data'][$i]['action'] .= '</div>';
            $no++;
			$i++;
        }

        return $json;
    }

    public function submit_player($post){
        date_default_timezone_set('Asia/Jakarta');

        $data = array(
            'team_id' => $post['team_id'],
            'nama_pemain' => $post['nama_pemain'],
            'tinggi_badan' => $post['tinggi_badan'],
            'berat_badan' => $post['berat_badan'],
            'posisi_pemain' => $post['posisi_pemain'],
            'nomor_punggung' => $post['nomor_punggung'],
            'is_deleted' => 0,
            'date_created' => date('Y-m-d H:i:s'),
        );

        $available_number_in_team = $this->db->where('team_id', $post['team_id'])
                                    ->where('nomor_punggung', $post['nomor_punggung'])
                                    ->get('player')->num_rows();


        if($available_number_in_team > 0){
            $data['result'] = [];
            $data['message'] = 'Nomor punggung sudah dipakai';
            $data['status'] = 500;
        }else{
            $result = $this->db->insert('player', $data);

            if($result){
                $data['result'] = $result;
                $data['message'] = 'Berhasil menambahkan pemain';
                $data['status'] = 200;
            }else{
                $data['result'] = [];
                $data['message'] = 'Gagal menambahkan pemain';
                $data['status'] = 500;
            }
        }

        return $data;
    }

    public function get_player_by_id($id){
        return $this->db->where('id', $id)->get('player')->row();
    }

    public function get_player_by_team($id){
        return $this->db->where('team_id', $id)->get('player')->result();
    }

    public function update_player($post){

        $data = array(
            'team_id' => $post['team_id'],
            'nama_pemain' => $post['nama_pemain'],
            'tinggi_badan' => $post['tinggi_badan'],
            'berat_badan' => $post['berat_badan'],
            'posisi_pemain' => $post['posisi_pemain'],
            'nomor_punggung' => $post['nomor_punggung'],
        );

        $available_number_in_team = $this->db->where('team_id', $post['team_id'])
                                    ->where('nomor_punggung', $post['nomor_punggung'])
                                    ->where_not_in('id', $post['id'])
                                    ->get('player')->num_rows();


        if($available_number_in_team > 0){
            $data['result'] = [];
            $data['message'] = 'Nomor punggung sudah dipakai';
            $data['status'] = 500;
        }else{
            $result = $this->db->where('id', $post['id'])->update('player', $data);

            if($result){
                $data['result'] = $result;
                $data['message'] = 'Berhasil update pemain';
                $data['status'] = 200;
            }else{
                $data['result'] = [];
                $data['message'] = 'Gagal update pemain';
                $data['status'] = 500;
            }
        }

        return $data;
    }

    public function remove_player($id)
    {
        $result = $this->db->where('id', $id)->set('is_deleted', '1')->update('player');

        if($result){
            $data['result'] = $result;
            $data['message'] = 'Berhasil menghapus pemain';
            $data['status'] = 200;
        }else{
            $data['result'] = [];
            $data['message'] = 'Gagal menghapus pemain';
            $data['status'] = 500;
        }

        return $data;
    }
}