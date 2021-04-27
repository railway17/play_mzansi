<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	function __construct()
	{
			parent::__construct();

			$this->load->model('User');
	}

	public function index()
	{
		$this->load->view('register');
	}

	public function signup()
	{
		$u = $this->input->post('username'); //Username Posted
		$p = sha1($this->input->post('password')); //Pasword Posted
		$q = array('username' => $u); //For where query condition
		$data = array(
				'username'=>$u,
				'password'=>$p,
				'status'=>1,
				'level'=>1
		);
		$val = $this->User->get_user($q)->row(); //Model to get single data row from database base on username
		if($this->User->get_user($q)->num_rows() == 0) {
				$userId = $this->User->insert($data);
				$token['id'] = $userId;  //From here
				$token['username'] = $u;
				$date = new DateTime();
				$token['iat'] = $date->getTimestamp();
				$token['exp'] = $date->getTimestamp() + 30; //To here is to generate token 60*60*5
				$output['token'] = JWT::encode($token,$kunci ); //This is the output token
				$output['statusCode'] = 200;
				$this->session->set_userdata('userId', $userId);
				echo json_encode($output);

				$response = array(
					'statusCode'=> 200,
					'userId'=>$userId,
					'message'=>'Successfully registered!'
				);
				echo json_encode($response);
		} else {
			$response = array(
				'statusCode'=> 400,
				'message'=>'User already exists!'
			);
			echo json_encode($response);
		}
	}
}
