<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kegiatan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Kegiatan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/kegiatan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/kegiatan/index/';
            $config['first_url'] = base_url() . 'index.php/kegiatan/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Kegiatan_model->total_rows($q);
        
		$kegiatan = $this->Kegiatan_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'kegiatan_data' => $kegiatan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
			'menu' => "kegiatan",
        );
        $this->template->load('template','kegiatan/kegiatan_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Kegiatan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_kegiatan' => $row->id_kegiatan,
		'kode_kegiatan' => $row->kode_kegiatan,
		'uraian_kegiatan' => $row->uraian_kegiatan,
		'id_admin' => $_SESSION['id_admin'],
		'menu' => "kegiatan",
	    );
            $this->template->load('template','kegiatan/kegiatan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kegiatan'));
        }
    }

    public function create() 
    {	
		$acak = rand(100000,999999);
		$kode = "ID".$acak;
		
        $data = array(
            'button' => 'Create',
            'action' => site_url('kegiatan/create_action'),
	    'id_kegiatan' => set_value('id_kegiatan'),
	    'kode_kegiatan' => $kode,
	    'uraian_kegiatan' => set_value('uraian_kegiatan'),
	    'id_admin' => set_value('id_admin'),
		'menu' => "kegiatan",
	);
        $this->template->load('template','kegiatan/kegiatan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_kegiatan' => $this->input->post('kode_kegiatan',TRUE),
		'uraian_kegiatan' => $this->input->post('uraian_kegiatan',TRUE),
		'id_admin' => $_SESSION['id_admin'],
		
	    );

            $this->Kegiatan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kegiatan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Kegiatan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kegiatan/update_action'),
		'id_kegiatan' => set_value('id_kegiatan', $row->id_kegiatan),
		'kode_kegiatan' => set_value('kode_kegiatan', $row->kode_kegiatan),
		'uraian_kegiatan' => set_value('uraian_kegiatan', $row->uraian_kegiatan),
		'id_admin' => set_value('id_admin', $row->id_admin),
		'menu' => "kegiatan",
	    );
            $this->template->load('template','kegiatan/kegiatan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kegiatan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kegiatan', TRUE));
        } else {
            $data = array(
		'kode_kegiatan' => $this->input->post('kode_kegiatan',TRUE),
		'uraian_kegiatan' => $this->input->post('uraian_kegiatan',TRUE),
		'id_admin' => $_SESSION['id_admin'],
	    );

            $this->Kegiatan_model->update($this->input->post('id_kegiatan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kegiatan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Kegiatan_model->get_by_id($id);

        if ($row) {
            $this->Kegiatan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kegiatan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kegiatan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('uraian_kegiatan', 'uraian kegiatan', 'trim|required');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "kegiatan.xls";
        $judul = "kegiatan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Kegiatan");
	xlsWriteLabel($tablehead, $kolomhead++, "Uraian Kegiatan");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Admin");

	foreach ($this->Kegiatan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_kegiatan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->uraian_kegiatan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_admin);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Kegiatan.php */
/* Location: ./application/controllers/Kegiatan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-10-26 06:24:47 */
/* http://harviacode.com */