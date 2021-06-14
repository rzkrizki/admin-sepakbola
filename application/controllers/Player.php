<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Player extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
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
        init_view('player/list');
    }

    public function get_player(){
        $data = $this->player->get_data_player($this->input->post());
		echo json_encode($data);
    }

	public function get_player_by_team($id){
		$data = $this->player->get_player_by_team($id);
		echo json_encode($data);
	}

    public function add_player(){
        $data['team'] = $this->team->get_all_team();
        init_view('player/add', $data);
    }

    public function submit()
	{
		$data = $this->player->submit_player($this->input->post());
		echo json_encode($data);
	}

    public function edit_player($id)
	{
        $data['team'] = $this->team->get_all_team();
		$data['result'] = $this->player->get_player_by_id($id);
		init_view('player/edit', $data);
	}

    public function update()
	{
		$data = $this->player->update_player($this->input->post());
		echo json_encode($data);
	}

    public function remove($id)
	{
		$data = $this->player->remove_player($id);
		echo json_encode($data);
	}

}