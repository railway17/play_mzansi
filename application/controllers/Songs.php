<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\JWT\JWT;

class Songs extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('userId')) {
			redirect('/login');
		}
		$this->load->model('Song');
	}	

	public function index()
	{
		$data['current_view'] = 'songs';
		$this->load->view('admin/template/content', $data);
	}

	public function addNew()
	{
		$data = $this->input->post('data');
		$response = [];
		if(!isset($data) || count($data) == 0) {
			$response['statusCode'] = 400;
			echo json_encode($response);
			return;
		}
		
		$title = $data[0]['title'];
		$author = $data[0]['author'];
		$duration = $data[0]['duration'];
		
		try {
			$path = realpath(FCPATH.'uploads').'\\'.$title;
			$song = array(
				'title'=>$title,
				'author'=>$author,
				'duration'=>$duration,
				'path'=>$path,
				'deleted'=>0
			);
			$s = $this->Song->getByPath($path);
			
			if(!empty($s) && $s['deleted'] == 1) {
				$this->Song->update($s['id'], $song);
			} else if(is_dir($path)) {
				throw new Exception('Folder already exists', 123);
			} else {
				mkdir($path, 0777, TRUE);
				$this->Song->insert($song);
			}
		
			$this->writeMetaFile($song);
	
			$response['data'] = $song;
			$response['statusCode'] = 200;
			
			echo json_encode($response);
		} catch  (Exception $e) {
			$response['data'] = null;
			$response['statusCode'] = 500;
			$response['message'] = $e->getMessage();
			echo json_encode($response);
		}		
	}

	public function getAll()
	{
		$songs = $this->Song->getAll();	
		$response  = [];
    $response['data'] = !isset($songs) ? [] : $songs;
		echo json_encode($response);
	}

	public function update()
	{
		$data = $this->input->post('data');
		$keys = array_keys($data);
		$response['statusCode'] = 403;
		if(!isset($data) || count($data) == 0) {
			$response['statusCode'] = 400;
		} else if(count($keys) != 0) {
			$id = $keys[0];
			$this->Song->update($id, $data[$id]);
			$song = $this->Song->get($id);
			$this->writeMetaFile($song);
			$response['statusCode'] = 200;

		}
		$songs = $this->Song->getAll();	
		$response['data'] = $songs;
		echo json_encode($response);
		return;
	}

	public function delete()
	{
		$id = $this->input->post('id');
		$song = $this->Song->get($id);
		$song['deleted'] = 1;
		$this->Song->update($id, $song);
		$this->writeMetaFile($song);
		$response  = [];
		$response['statusCode'] = 200;
    $response['data'] = $song;
		echo json_encode($response);
	}

	public function upload()
	{
		$files = $_FILES['videos'];
		$id = $this->input->post('id');
		$song = $this->Song->get($id);
		$upload = $this->upload_files($song, $id, $files);
		$response['statusCode'] = count($upload) > 0 ? 200 : 500;
		echo json_encode($response);		
	}

	private function upload_files($song, $id, $files)
	{
		$path = $song['path'];
		$title = $song['title'];
		$config = array(
				'upload_path'   => $path,
				'allowed_types' => 'mp4|mp3|jpg|png',
				'overwrite'     => 1,                       
		);

		$this->load->library('upload', $config);

		$uploads = array();

		foreach ($files['name'] as $key=>$video) {
				$_FILES['uploadFiles[]']['name']= $files['name'][$key];
				$_FILES['uploadFiles[]']['type']= $files['type'][$key];
				$_FILES['uploadFiles[]']['tmp_name']= $files['tmp_name'][$key];
				$_FILES['uploadFiles[]']['error']= $files['error'][$key];
				$_FILES['uploadFiles[]']['size']= $files['size'][$key];

				$fileName = $video;

				$uploadFiles[] = $fileName;

				$config['file_name'] = $fileName;

				$this->upload->initialize($config);

				if ($this->upload->do_upload('uploadFiles[]')) {
						$this->upload->data();
				} else {
						return false;
				}
		}

		return $uploadFiles;
	}

	public function writeMetaFile($song){
		$filePath = $song['path'].'\\meta.json';
		$song['createdAt'] = date('Y-m-d H:i:s');
		$song['active'] = $song['deleted'] ? true : false;
		unset($song['path']);
		unset($song['deleted']);
		$fp = fopen($filePath, 'w+');
		fwrite($fp, json_encode($song, JSON_PRETTY_PRINT));
		fclose($fp);
	}
}
