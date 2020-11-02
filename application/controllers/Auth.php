<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class auth extends CI_Controller {
	
	

	function __construct(){
		parent::__construct();
		
		$this->load->model('Admin_model');
	}
	
	public function pegawai()
	{
		if (!$this->session->has_userdata('username')) {
			redirect("login_pegawai");
		} else {
			if ($this->session->userdata('level') != 'pegawai') {
				redirect("home");	
			}
		}	
		
		$data['menu'] = "auth";
		$data['auth']=    $this->m_pegawai->get_auth();
		$this->template->load('template_p','auth/v_pegawai',$data);
	}
	
	
	
	
	
	
	
	public function admin()
	{	
		if (!$this->session->has_userdata('username')) {
			redirect("login");
		} else {
			if ($this->session->userdata('level') != 'admin') {
				redirect("naik_pangkat");	
			}
		}	
		
		$data['menu'] = "auth";
		$data['auth']=    $this->Admin_model->get_auth();
		$this->template->load('template','auth/v_admin', $data);
		
	}
	
	public function proses_admin()
	{	
		if (!$this->session->has_userdata('username')) {
			redirect("login");
		} else {
			if ($this->session->userdata('level') != 'admin') {
				redirect("naik_pangkat");	
			}
		}	
		if(isset($_POST['submit'])){
			$id_admin   			 =  $this->input->post('id_admin');
			$nama       	 =  $this->input->post('nama');
			$username        =  $this->input->post('username');
			$password        =  md5($this->input->post('password'));
			
			$data           =  array('nama'     	=>$nama,
                                     'username'       =>$username,
                                     'password'       =>$password);
									 
			$this->Admin_model->ganti($data, $id_admin);	
			$this->session->set_flashdata('status', 'Data berhasil diganti');
			if ($_SESSION['username'] == $username) {
				redirect('auth/admin');
			} else {
				redirect('.');
			}	
		}	
		
	}
	
	
	
	
	
	
	
	
	 
	
	
}
