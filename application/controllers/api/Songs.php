<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Songs extends BD_Controller {
  function __construct()
  {
    // Construct the parent class
    parent::__construct();
    $this->auth();
    $this->load->model('Song');
  }
	
  public function index_get($id = 0)
  {
    $songs = $this->Song->getAll();
    
    // If the id parameter doesn't exist return all the users

    if ($id === 0)
    {
        // Check if the users data store contains users (in case the database result returns NULL)
        if ($songs)
        {
            // Set the response and exit
            $this->response($songs, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'No musics were found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    // Find and return a single record for a particular user.

    $id = (int) $id;

    // Validate the id.
    if ($id <= 0)
    {
        // Invalid id, set the response and exit.
        $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
    }

    // Get the user from the array, using the id as key for retrieval.
    // Usually a model is to be used for this.

    $song = NULL;

    if (!empty($songs))
    {
        foreach ($songs as $key => $value)
        {
            if (isset($value['id']) && $value['id'] == $id)
            {
                $song = $value;
            }
        }
    }

    if (!empty($song))
    {
        $this->set_response($song, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }
    else
    {
        $this->set_response([
            'status' => FALSE,
            'message' => 'Music could not be found'
        ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
    }
  }

  public function musics_get($id)
  {
    if ($id === 0) {
        $this->response([
                'status' => FALSE,
                'statusCode'=>400,
                'message' => 'Song id is required'
            ], REST_Controller::HTTP_BAD_REQUEST); 
    } 

    $song = $this->Song->get($id);
    if(empty($song)) {
        $this->response([
            'status' => FALSE,
            'statusCode'=>400,
            'message' => 'Invalid song id'
        ], REST_Controller::HTTP_BAD_REQUEST); 
    }

    $path = $song['path'];
    if(!is_dir($path)) {
        $this->response([
            'status' => FALSE,
            'statusCode'=>500,
            'message' => 'Invalid song id'
        ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR); 
    }
    $files = $this->dirToArray($path);
    $scanned_directory = array_diff($files, array('..', '.'));

    $this->response($scanned_directory, REST_Controller::HTTP_OK); 
  }

  public function download_get($id)
  {
    $fileName = $this->get('file_name');
    if ($id === 0 || empty($fileName)) {
        $this->response([
                'status' => FALSE,
                'statusCode'=>400,
                'message' => 'Song id and filename are required'
            ], REST_Controller::HTTP_BAD_REQUEST); 
    } 

    $song = $this->Song->get($id);
    if(empty($song)) {
        $this->response([
            'status' => FALSE,
            'statusCode'=>400,
            'message' => 'Invalid song id'
        ], REST_Controller::HTTP_BAD_REQUEST); 
    }

    $path = $song['path'];
    if(!is_dir($path)) {
        $this->response([
            'status' => FALSE,
            'statusCode'=>500,
            'message' => 'Invalid song id'
        ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR); 
    }
    $fullPath = $path.'\\'.$fileName;
    if (file_exists ( $fullPath )) {
        // get file content
        $data = file_get_contents ( $fullPath );
        //force download
        force_download ( $fileName, $data );
       } else {
        // Redirect to base url
        $this->set_response([
            'status' => FALSE,
            'message' => 'Music could not be found'
        ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
    }
  }

  private function dirToArray($dir) {
  
    $result = array();
 
    $cdir = scandir($dir);
    foreach ($cdir as $key => $value)
    {
       if (!in_array($value,array(".","..")))
       {
          if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
          {
             $result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value);
          }
          else
          {
             $result[] = $value;
          }
       }
    }
   
    return $result;
 }
}
