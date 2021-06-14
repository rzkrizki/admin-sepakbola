<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Schedule extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_team', 'team');
        $this->load->model('model_schedule', 'schedule');
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
        init_view('schedule/list');
    }

    public function get_schedule(){
        $data = $this->schedule->get_data_schedule($this->input->post());
		echo json_encode($data);
    }

    public function add_schedule(){
        $data['team'] = $this->team->get_all_team();
        init_view('schedule/add', $data);
    }

    public function submit()
	{
		$data = $this->schedule->submit_schedule($this->input->post());
		echo json_encode($data);
	}

    public function edit_schedule($id)
	{
        $data['team'] = $this->team->get_all_team();
		$data['result'] = $this->schedule->get_schedule_by_id($id);
		init_view('schedule/edit', $data);
	}

    public function update()
	{
		$data = $this->schedule->update_schedule($this->input->post());
		echo json_encode($data);
	}

    public function remove($id)
	{
		$data = $this->schedule->remove_schedule($id);
		echo json_encode($data);
	}

}