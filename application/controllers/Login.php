<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {

	
	function __construct(){
		
		parent::__construct();	
		
		
		
		$this->load->model('Admin_model');
			
	}
	
	function index(){
		if ($this->session->has_userdata('username')) {
			if ($this->session->userdata('level') == 'pegawai') {
				redirect("naik_pangkat");	
			} else if ($this->session->userdata('level') == 'admin') {
				redirect("home");	
			} 
		} 	
			$this->load->view('login/v_admin');
	}
 
	function login(){
		if ($this->session->has_userdata('username')) {
			if ($this->session->userdata('level') == 'pegawai') {
				redirect("naik_pangkat");	
			} else if ($this->session->userdata('level') == 'admin') {
				redirect("home");	
			} 
		} 	
		if (isset($_POST['submit'])) {
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			$where = array(
				'username' => $username,
				'password' => $password
				);
			//cek tabel admin	
			$cek = $this->Admin_model->cek_login($where)->num_rows();
			$data = $this->Admin_model->cek_login($where);
			if($cek > 0){
				foreach ($data->result() as $r) {
					$level = $r->level;	
					$nama = $r->nama;	
					$id_admin = $r->id_admin;	
				}	
				
				$data_session = array(
					'username' 		=> $username,
					'level' 		=> $level,
					'id_admin' 		=> $id_admin,
					'nama' 			=> $nama
					);
				
				$this->session->set_userdata($data_session);
				$this->session->set_flashdata('status', 'Berhasil Login');
				redirect("home");

			}else{	
				$this->session->set_flashdata('status', 'Gagal Login');
				redirect("login");
			}
		} 
	
	}	
 
	function logout(){
		$this->session->sess_destroy();
		redirect("login");
	}
}
