<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Instansi_model extends CI_Model
{

    public $table = 'instansi';
    public $id = 'id_instansi';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        if ($this->session->userdata('level') == 'admin') {
		return $this->db->query("SELECT * FROM ".$this->table." k, admin a WHERE k.id_admin = a.id_admin   ")->result();	
		} else {
		return $this->db->query("SELECT * FROM ".$this->table." k, admin a WHERE k.id_admin = a.id_admin AND a.id_admin='".$_SESSION['id_admin']."' ")->result();
		}
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_instansi', $q);
	$this->db->or_like('nama_instansi', $q);
	$this->db->or_like('pejabat_mengetahui', $q);
	$this->db->or_like('nama_pejabat', $q);
	$this->db->or_like('penanggung_jawab', $q);
	$this->db->or_like('id_admin', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
		if ($this->session->userdata('level') == 'admin') {
		return $this->db->query("SELECT * FROM ".$this->table." k, admin a WHERE k.id_admin = a.id_admin  LIMIT $start, $limit ")->result();	
		} else {
        return $this->db->query("SELECT * FROM ".$this->table." k, admin a WHERE k.id_admin = a.id_admin AND a.id_admin='".$_SESSION['id_admin']."' LIMIT $start, $limit ")->result();
		}
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Instansi_model.php */
/* Location: ./application/models/Instansi_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-10-26 06:24:47 */
/* http://harviacode.com */