<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Team extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_team', 'team');
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
        init_view('team/list');
    }

    public function get_team(){
        $data = $this->team->get_data_team($this->input->post());
		echo json_encode($data);
    }

    public function add_team(){
        init_view('team/add');
    }

    public function submit()
	{
		$data = $this->team->submit_team($this->input->post());
		echo json_encode($data);
	}

    public function edit_team($id)
	{
		$data['result'] = $this->team->get_team_by_id($id);
		init_view('team/edit', $data);
	}

    public function update()
	{
		$data = $this->team->update_team($this->input->post());
		echo json_encode($data);
	}

    public function remove($id)
	{
		$data = $this->team->remove_team($id);
		echo json_encode($data);
	}

}