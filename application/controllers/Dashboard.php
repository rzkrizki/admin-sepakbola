<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_dashboard', 'dashboard');
    }

    public function _remap($method, $param = array())
	{
		if (method_exists($this, $method)) {
			return call_user_func_array(array($this, $method), $param);
		} else {
			dd('Halaman Tidak Ditemukan');
		}
	}

    public function index(){
        $data['total_pertandingan'] = $this->dashboard->get_all_schedule();
        $data['total_pertandingan_bulan_ini'] = $this->dashboard->get_schedule_this_month();
        $data['total_pertandingan_hari_ini'] = $this->dashboard->get_schedule_today();
        $data['total_tim'] = $this->dashboard->get_all_team();
        $data['top_scorer'] = $this->dashboard->get_top_score();
        init_view('dashboard', $data);
    }
}