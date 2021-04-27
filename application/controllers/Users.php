<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		// if(!$this->session->userdata('userId')) {
		// 	redirect('/login');
		// }
    $this->load->model('User');
	}	

	public function index()
	{
		$data['current_view'] = 'users';
		$this->load->view('admin/template/content', $data);
	}

  public function getAll() {
    $users = $this->User->getAll();
    $response  = [];
    $response['data'] = $users;
    echo json_encode($response);
  }

  public function updateUserStatus() {
    $userId = $this->input->post('userId');
    $q = array('id'=>$userId);
    $user = $this->User->get_user($q)->row();
    
    $updateData = array(
      'id'=>$userId,
      'status'=>$user->status ? false : true
    );
    $response = $this->User->update($updateData);
    echo json_encode($response);
  }

  public function logout()
  {
      $this->session->sess_destroy();
      redirect('/login');
  }
}
