<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_dashboard extends CI_Model
{

	public function contruct()
	{
		parent::__construct();
	}

    public function get_all_schedule(){
        return $this->db->where('is_deleted', '0')->get('schedule')->num_rows();
    }

    public function get_schedule_this_month(){
        $sql = 'SELECT * FROM schedule WHERE MONTH(tanggal_pertandingan) =  MONTH(CURDATE()) AND is_deleted = 0';
        return $this->db->query($sql)->num_rows();
    }

    public function get_schedule_today(){
        $sql = 'SELECT * FROM schedule WHERE tanggal_pertandingan =  CURDATE() AND is_deleted = 0';
        return $this->db->query($sql)->num_rows();
    }

    public function get_all_team(){
        return $this->db->where('is_deleted', '0')->get('team')->num_rows();
    }

    public function get_top_score()
    {
        return $this->db->select('
        SUM(a.total_score) as total_score,
        b.nama_pemain as player_name,
        b.posisi_pemain,
        c.nama_tim as tim_score
        ')
        ->from('report a')
        ->join('player b', 'a.player_score = b.id', 'left')
        ->join('team c', 'b.team_id = c.id', 'left')
        ->group_by('a.player_score')
        ->order_by('total_score', 'desc')
        ->get()
        ->result();
    }
}