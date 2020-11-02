<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		
		
		if (!$this->session->has_userdata('username')) {
			redirect("login");
		} 
		
		$this->load->model('Admin_model');
		$this->load->model('Kegiatan_model');
		$this->load->model('Instansi_model');
		$this->load->model('Rap_model');
		$this->load->model('Belanja_model');
		$this->load->model('Pendapatan_model');
		
	}
	
	public function index()
	{
		$data['menu'] = "home";
		$data['admin']=    $this->Admin_model->total_rows();
		$data['kegiatan']=    $this->Kegiatan_model->total_rows();
		$data['instansi']=    $this->Instansi_model->total_rows();
		$data['rap']=    $this->Rap_model->total_rows();
		$data['belanja']=    $this->Belanja_model->total_rows();
		$data['pendapatan']=    $this->Pendapatan_model->total_rows();
		$this->template->load('template','v_home', $data);
	}
}
