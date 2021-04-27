<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\JWT\JWT;

class Login extends CI_Controller {

	function __construct()
	{
			parent::__construct();

			$this->load->model('User');
	}

	public function index()
	{
    $this->load->view('login');
	}

	public function signIn()
	{
    $u = $this->input->post('username'); //Username Posted
		$p = sha1($this->input->post('password')); //Pasword Posted
		$q = array('username' => $u); //For where query condition
		$kunci = $this->config->item('thekey');
		$invalidLogin = ['status' => 'Invalid Login']; //Respon if login invalid
		$val = $this->User->get_user($q)->row(); //Model to get single data row from database base on username
		if($this->User->get_user($q)->num_rows() == 0){$this->response($invalidLogin, REST_Controller::HTTP_NOT_FOUND);}
		$match = $val->password;   //Get password for user from database
		if($p == $match){  //Condition if password matched
			$token['id'] = $val->id;  //From here
			$token['username'] = $u;
			$date = new DateTime();
			$token['iat'] = $date->getTimestamp();
			$token['exp'] = $date->getTimestamp() + 30; //To here is to generate token 60*60*5
			$output['token'] = JWT::encode($token,$kunci ); //This is the output token
			$output['statusCode'] = 200;
			$this->session->set_userdata('userId', $val->id);
			echo json_encode($output);
		}
		else {
				$invalidLogin['statusCode'] = 401;
				$invalidLogin['message'] = 'Login failed';
				echo json_encode($invalidLogin);
		}				
	}
}