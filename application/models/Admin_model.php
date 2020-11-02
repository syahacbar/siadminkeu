<?php
class Admin_model extends CI_Model{
	
	var $tb = "admin";
	var $id = "id_admin";
	
	function cek_login($where){		
		return $this->db->get_where($this->tb,$where);
	}
	
	// get all
    function get_all()
    {
        return $this->db->get($this->tb);
    }
	
	// get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->tb)->row();
    }
	
	
	 function total_rows($q = NULL) {
        $this->db->like('id_admin', $q);
	$this->db->or_like('nama', $q);
	$this->db->or_like('username', $q);
	$this->db->or_like('password', $q);
	$this->db->from($this->tb);
        return $this->db->count_all_results();
    }
	 function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, 'asc');
        $this->db->like('id_admin', $q);
	$this->db->or_like('nama', $q);
	$this->db->or_like('username', $q);
	$this->db->or_like('password', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->tb)->result();
    }
	function get_auth(){		
		return $this->db->get_where($this->tb,  array('username' => $_SESSION['username']));
	}	
	
	function ganti($data, $key)
	{
		$this->db->where($this->id, $key);
		$this->db->update($this->tb, $data);
	}	
	
	 function insert($data)
    {
        $this->db->insert($this->tb, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->tb, $data);
    }
	
	function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->tb);
    }
}