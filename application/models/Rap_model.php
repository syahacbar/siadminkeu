<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rap_model extends CI_Model
{

    public $table = 'rap';
    public $id = 'id_rap';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        if ($this->session->userdata('level') == 'admin') {
		return $this->db->query("SELECT * FROM ".$this->table." k, admin a, kegiatan kg, instansi i WHERE k.id_admin = a.id_admin AND kg.kode_kegiatan = k.kode_kegiatan AND i.id_instansi = k.id_instansi    ")->result();	
		} else {
		return $this->db->query("SELECT * FROM ".$this->table." k, admin a, kegiatan kg, instansi i WHERE k.id_admin = a.id_admin AND kg.kode_kegiatan = k.kode_kegiatan AND i.id_instansi = k.id_instansi AND  a.id_admin='".$_SESSION['id_admin']."' ")->result();
		}
    }
	
	 function get_all_cetak($id_instansi, $tahun)
    {
        if ($this->session->userdata('level') == 'admin') {
		return $this->db->query("SELECT * FROM ".$this->table." k, admin a, kegiatan kg, instansi i WHERE k.id_admin = a.id_admin AND kg.kode_kegiatan = k.kode_kegiatan AND i.id_instansi = k.id_instansi  AND i.id_instansi = $id_instansi AND k.tahun = $tahun  ")->result();	
		} else {
		return $this->db->query("SELECT * FROM ".$this->table." k, admin a, kegiatan kg, instansi i WHERE k.id_admin = a.id_admin AND kg.kode_kegiatan = k.kode_kegiatan AND i.id_instansi = k.id_instansi AND i.id_instansi = $id_instansi AND k.tahun = $tahun AND  a.id_admin='".$_SESSION['id_admin']."' ")->result();
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
        $this->db->like('id_rap', $q);
	$this->db->or_like('kode_kegiatan', $q);
	$this->db->or_like('lokasi_kegiatan', $q);
	$this->db->or_like('target_kegiatan', $q);
	$this->db->or_like('sumber_dana', $q);
	$this->db->or_like('triwulan_1', $q);
	$this->db->or_like('triwulan_2', $q);
	$this->db->or_like('triwulan_3', $q);
	$this->db->or_like('triwulan_4', $q);
	$this->db->or_like('jumlah_total', $q);
	$this->db->or_like('id_instansi', $q);
	$this->db->or_like('tahun', $q);
	$this->db->or_like('id_admin', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
		if ($this->session->userdata('level') == 'admin') {
		return $this->db->query("SELECT * FROM ".$this->table." k, admin a, kegiatan kg, instansi i WHERE k.id_admin = a.id_admin AND kg.kode_kegiatan = k.kode_kegiatan AND i.id_instansi = k.id_instansi  LIMIT $start, $limit ")->result();
		} else {
        return $this->db->query("SELECT * FROM ".$this->table." k, admin a, kegiatan kg, instansi i WHERE k.id_admin = a.id_admin AND kg.kode_kegiatan = k.kode_kegiatan AND i.id_instansi = k.id_instansi AND a.id_admin='".$_SESSION['id_admin']."' LIMIT $start, $limit ")->result();
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

/* End of file Rap_model.php */
/* Location: ./application/models/Rap_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-10-26 06:24:47 */
/* http://harviacode.com */