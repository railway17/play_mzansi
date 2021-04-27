<?php 
	$this->load->view('admin/template/header', ["current_view" => $current_view]);
	$this->load->view($current_view);
	$this->load->view('admin/template/footer');
?>