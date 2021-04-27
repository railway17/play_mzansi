<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class User extends CI_Model{

	function get_user($q) {
		return $this->db->get_where('m_user',$q);
	}

	function insert($user) {
		return $this->db->insert('m_user', $user);
	}
	
	function update($data) {
		$this->db->where('id', $data['id']);
		return $this->db->update('m_user', $data);
 	}

	function getAll() {
		$sql = "SELECT id, username, first_name, last_name, status, createdAt FROM m_user WHERE level=2";
	
		$query = $this->db->query($sql);
		if($query->num_rows()) {
				return $query->result_array();
		}
		return NULL;      
	}
	
}