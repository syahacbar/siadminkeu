<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Instansi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Instansi_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/instansi/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/instansi/index/';
            $config['first_url'] = base_url() . 'index.php/instansi/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Instansi_model->total_rows($q);
        $instansi = $this->Instansi_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'instansi_data' => $instansi,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
			'menu' => "instansi",
        );
        $this->template->load('template','instansi/instansi_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Instansi_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_instansi' => $row->id_instansi,
		'nama_instansi' => $row->nama_instansi,
		'urusan_pemerintahan' => $row->urusan_pemerintahan,
		'organisasi' => $row->organisasi,
		'sub_unit_organisasi' => $row->sub_unit_organisasi,
		'pejabat_mengetahui' => $row->pejabat_mengetahui,
		'nama_pejabat' => $row->nama_pejabat,
		'penanggung_jawab' => $row->penanggung_jawab,
		'id_admin' => $_SESSION['id_admin'],
		'menu' => "instansi",
	    );
            $this->template->load('template','instansi/instansi_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('instansi'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('instansi/create_action'),
	    'id_instansi' => set_value('id_instansi'),
	    'nama_instansi' => set_value('nama_instansi'),
	    'urusan_pemerintahan' => set_value('urusan_pemerintahan'),
	    'organisasi' => set_value('organisasi'),
	    'sub_unit_organisasi' => set_value('sub_unit_organisasi'),
	    'pejabat_mengetahui' => set_value('pejabat_mengetahui'),
	    'nama_pejabat' => set_value('nama_pejabat'),
	    'penanggung_jawab' => set_value('penanggung_jawab'),
	    'id_admin' => set_value('id_admin'),
		'menu' => "instansi",
	);
        $this->template->load('template','instansi/instansi_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_instansi' => $this->input->post('nama_instansi',TRUE),
		'urusan_pemerintahan' => $this->input->post('urusan_pemerintahan',TRUE),
		'organisasi' => $this->input->post('organisasi',TRUE),
		'sub_unit_organisasi' => $this->input->post('sub_unit_organisasi',TRUE),
		'pejabat_mengetahui' => $this->input->post('pejabat_mengetahui',TRUE),
		'nama_pejabat' => $this->input->post('nama_pejabat',TRUE),
		'penanggung_jawab' => $this->input->post('penanggung_jawab',TRUE),
		'id_admin' => $_SESSION['id_admin'],
	    );

            $this->Instansi_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('instansi'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Instansi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('instansi/update_action'),
		'id_instansi' => set_value('id_instansi', $row->id_instansi),
		'nama_instansi' => set_value('nama_instansi', $row->nama_instansi),
		'urusan_pemerintahan' => set_value('urusan_pemerintahan', $row->urusan_pemerintahan),
		'organisasi' => set_value('organisasi', $row->organisasi),
		'sub_unit_organisasi' => set_value('sub_unit_organisasi', $row->sub_unit_organisasi),
		'pejabat_mengetahui' => set_value('pejabat_mengetahui', $row->pejabat_mengetahui),
		'nama_pejabat' => set_value('nama_pejabat', $row->nama_pejabat),
		'penanggung_jawab' => set_value('penanggung_jawab', $row->penanggung_jawab),
		'id_admin' => set_value('id_admin', $row->id_admin),
		'menu' => "instansi",
	    );
            $this->template->load('template','instansi/instansi_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('instansi'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_instansi', TRUE));
        } else {
            $data = array(
		'nama_instansi' => $this->input->post('nama_instansi',TRUE),
		'urusan_pemerintahan' => $this->input->post('urusan_pemerintahan',TRUE),
		'organisasi' => $this->input->post('organisasi',TRUE),
		'sub_unit_organisasi' => $this->input->post('sub_unit_organisasi',TRUE),
		'pejabat_mengetahui' => $this->input->post('pejabat_mengetahui',TRUE),
		'nama_pejabat' => $this->input->post('nama_pejabat',TRUE),
		'penanggung_jawab' => $this->input->post('penanggung_jawab',TRUE),
		'id_admin' => $_SESSION['id_admin'],
	    );

            $this->Instansi_model->update($this->input->post('id_instansi', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('instansi'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Instansi_model->get_by_id($id);

        if ($row) {
            $this->Instansi_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('instansi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('instansi'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_instansi', 'nama instansi', 'trim|required');
	$this->form_validation->set_rules('urusan_pemerintahan', 'urusan pemerintahan', 'trim|required');
	$this->form_validation->set_rules('organisasi', 'organisasi', 'trim|required');
	$this->form_validation->set_rules('sub_unit_organisasi', 'sub unit organisasi', 'trim|required');
	$this->form_validation->set_rules('pejabat_mengetahui', 'pejabat mengetahui', 'trim|required');
	$this->form_validation->set_rules('nama_pejabat', 'nama pejabat', 'trim|required');
	$this->form_validation->set_rules('penanggung_jawab', 'penanggung jawab', 'trim|required');

	$this->form_validation->set_rules('id_instansi', 'id_instansi', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "instansi.xls";
        $judul = "instansi";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Instansi");
	xlsWriteLabel($tablehead, $kolomhead++, "Urusan Pemerintahan");
	xlsWriteLabel($tablehead, $kolomhead++, "Organisasi");
	xlsWriteLabel($tablehead, $kolomhead++, "Sub Unit Organisasi");
	xlsWriteLabel($tablehead, $kolomhead++, "Pejabat Mengetahui");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Pejabat");
	xlsWriteLabel($tablehead, $kolomhead++, "Penanggung Jawab");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Admin");

	foreach ($this->Instansi_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_instansi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->urusan_pemerintahan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->organisasi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->sub_unit_organisasi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pejabat_mengetahui);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_pejabat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->penanggung_jawab);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_admin);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Instansi.php */
/* Location: ./application/controllers/Instansi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-10-26 06:24:47 */
/* http://harviacode.com */