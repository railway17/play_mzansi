<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class Song extends CI_Model{

	function get($id) {
		$this->db->select('title, author, duration, createdAt, path, deleted');
		$this->db->where('id', $id);
		$query = $this->db->get('m_song', $id);
		return $query->row_array();
	}

	function getByPath($path) {
		$this->db->select('id, title, author, duration, createdAt, path, deleted');
		$this->db->where('path',$path);
		$query = $this->db->get('m_song');
		return $query->row_array();
	}
	
	function insert($song) {
		return $this->db->insert('m_song', $song);
	}
	
	function update($id, $song) {
		$this->db->where('id', $id);
		return $this->db->update('m_song', $song);
 	}

	function getAll() {
		$sql = "SELECT id, title, author, duration, createdAt FROM m_song WHERE deleted=0";
	
		$query = $this->db->query($sql);
		if($query->num_rows()) {
				return $query->result_array();
		}
		return NULL;  
	}	
}