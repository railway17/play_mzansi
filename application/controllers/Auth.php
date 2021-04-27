<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		$this->load->view('admin/content/login');
	}

  public function login()
	{
		$this->load->view('admin/content/login');
	}
}
