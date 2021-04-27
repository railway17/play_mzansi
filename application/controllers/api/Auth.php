<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\JWT\JWT;

class Auth extends BD_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model('User');
    }

    public function register_post()
    {
        $u = $this->post('username'); //Username Posted
        $p = sha1($this->post('password')); //Pasword Posted
        $firstName = $this->post('first_name');
        $lastName = $this->post('last_name');
        $q = array('username' => $u); //For where query condition
        $data = array(
            'username'=>$u,
            'password'=>$p,
            'first_name'=>$firstName,
            'last_name'=>$lastName,
            'status'=>1,
            'level'=>2
        );
        $val = $this->User->get_user($q)->row(); //Model to get single data row from database base on username
        if($this->User->get_user($q)->num_rows() == 0) {
            $this->User->insert($data);
        } else {
            $this->response($invalidLogin, REST_Controller::HTTP_BAD_REQUEST);
        }
        $user = $this->User->get_user(array('username'=>$u))->row();
        $output = $this->getToken($user->id, $u);
        $this->set_response($output, REST_Controller::HTTP_OK); //This is the respon if success		
    }

    public function login_post()
    {
        $u = $this->post('username'); //Username Posted
        $p = sha1($this->post('password')); //Pasword Posted
        $q = array('username' => $u); //For where query condition
        
        $invalidLogin = ['status' => 'Invalid Login']; //Respon if login invalid
        $val = $this->User->get_user($q)->row(); //Model to get single data row from database base on username
        if($this->User->get_user($q)->num_rows() == 0){$this->response($invalidLogin, REST_Controller::HTTP_NOT_FOUND);}
		$match = $val->password;   //Get password for user from database
        if($p == $match){  //Condition if password matched
        	$output = $this->getToken($val->id, $u);
            $this->set_response($output, REST_Controller::HTTP_OK); //This is the respon if success
        }
        else {
            $this->set_response($invalidLogin, REST_Controller::HTTP_NOT_FOUND); //This is the respon if failed
        }
    }

    private function getToken($id, $u) {
        $kunci = $this->config->item('thekey');
        $token['id'] = $id;  //From here
        $token['username'] = $u;
        $date = new DateTime();
        $token['iat'] = $date->getTimestamp();
        $token['exp'] = $date->getTimestamp() + $this->config->item('sess_expiration'); //To here is to generate token = admin session expiration time
        $output['token'] = JWT::encode($token,$kunci ); //This is the output token
        return $output;
    }

}
