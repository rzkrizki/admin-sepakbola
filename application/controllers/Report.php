<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_report', 'report');
        $this->load->model('model_schedule', 'schedule');
        $this->load->model('model_team', 'team');
        $this->load->model('model_player', 'player');
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
        if(empty($_GET['schedule_id'])){
            redirect(base_url('schedule'));
        }else{
            $data['schedule_id'] = $_GET['schedule_id'];
            init_view('report/list', $data);
        }
    }

    public function get_report($id){
        $data = $this->report->get_data_report($this->input->post(), $id);
		echo json_encode($data);
    }

    public function add_report(){
        if(empty($_GET['schedule_id'])){
            redirect(base_url('schedule'));
        }else{
            $data['schedule'] = $this->schedule->get_schedule_for_report($_GET['schedule_id']);
            $data['team'] = $this->team->get_all_team();
            init_view('report/add', $data);
        }
    }

    public function submit()
	{
		$data = $this->report->submit_report($this->input->post());
		echo json_encode($data);
	}

    public function edit_report($id)
	{
        $data['team'] = $this->team->get_all_team();
		$data['result'] = $this->report->get_report_by_id($id);
        $data['player'] = $this->player->get_player_by_team($data['result']->tim_score);
		init_view('report/edit', $data);
	}

    public function update()
	{
		$data = $this->report->update_report($this->input->post());
		echo json_encode($data);
	}

    public function remove($id)
	{
		$data = $this->report->remove_report($id);
		echo json_encode($data);
	}

}