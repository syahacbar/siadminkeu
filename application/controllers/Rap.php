<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rap extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Rap_model');
        $this->load->model('Instansi_model');
        $this->load->model('Kegiatan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
         $instansi = $this->Instansi_model->get_all();
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/rap/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/rap/index/';
            $config['first_url'] = base_url() . 'index.php/rap/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Rap_model->total_rows($q);
        $rap = $this->Rap_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);
		

        $data = array(
            'rap_data' => $rap,
            'instansi' => $instansi,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
			'menu' => "rap",
        );
        $this->template->load('template','rap/rap_list', $data);
    }
	
	public function cetak()
	{
		$data['menu'] = "rap";
		$id_instansi = $this->input->post('id_instansi',TRUE);
		$tahun = $this->input->post('tahun',TRUE);
		
		if ($id_instansi != "-Pilih Instansi-") {
		$data['tahun'] = $tahun;
		$data['rap_data']=    $this->Rap_model->get_all_cetak($id_instansi, $tahun);
		$instansi =    $this->Instansi_model->get_by_id($id_instansi);
			$data['nama_instansi'] = $instansi->nama_instansi;
			$data['urusan_pemerintahan'] = $instansi->urusan_pemerintahan;
			$data['organisasi'] = $instansi->organisasi;
			$data['sub_unit_organisasi'] = $instansi->sub_unit_organisasi;
			$data['pejabat_mengetahui'] = $instansi->pejabat_mengetahui;
			$data['nama_pejabat'] = $instansi->nama_pejabat;
			$data['penanggung_jawab'] = $instansi->penanggung_jawab;
		
		$this->load->view('rap/rap_cetak',$data);
		} else {
			redirect(site_url('rap'));
		}
	}

    public function read($id) 
    {
        $row = $this->Rap_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_rap' => $row->id_rap,
		'kode_kegiatan' => $row->kode_kegiatan,
		'lokasi_kegiatan' => $row->lokasi_kegiatan,
		'target_kegiatan' => $row->target_kegiatan,
		'sumber_dana' => $row->sumber_dana,
		'triwulan_1' => $row->triwulan_1,
		'triwulan_2' => $row->triwulan_2,
		'triwulan_3' => $row->triwulan_3,
		'triwulan_4' => $row->triwulan_4,
		'jumlah_total' => $row->jumlah_total,
		'id_instansi' => $row->id_instansi,
		'tahun' => $row->tahun,
		'id_admin' => $row->id_admin,
		'menu' => "rap",
	    );
            $this->template->load('template','rap/rap_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('rap'));
        }
    }

    public function create() 
    {
        $instansi = $this->Instansi_model->get_all();
		$kegiatan = $this->Kegiatan_model->get_all();
		
		$data = array(
			 'instansi' => $instansi,
            'kegiatan' => $kegiatan,
            'button' => 'Create',
            'action' => site_url('rap/create_action'),
	    'id_rap' => set_value('id_rap'),
	    'kode_kegiatan' => set_value('kode_kegiatan'),
	    'lokasi_kegiatan' => set_value('lokasi_kegiatan'),
	    'target_kegiatan' => set_value('target_kegiatan'),
	    'sumber_dana' => set_value('sumber_dana'),
	    'triwulan_1' => set_value('triwulan_1'),
	    'triwulan_2' => set_value('triwulan_2'),
	    'triwulan_3' => set_value('triwulan_3'),
	    'triwulan_4' => set_value('triwulan_4'),
	    'jumlah_total' => set_value('jumlah_total'),
	    'id_instansi' => set_value('id_instansi'),
	    'tahun' => set_value('tahun'),
	    'id_admin' => set_value('id_admin'),
		'menu' => "rap",
	);
        $this->template->load('template','rap/rap_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
			$triwulan_1 = str_replace(",","",$this->input->post('triwulan_1',TRUE));
			$triwulan_2 = str_replace(",","",$this->input->post('triwulan_2',TRUE));
			$triwulan_3 = str_replace(",","",$this->input->post('triwulan_3',TRUE));
			$triwulan_4 = str_replace(",","",$this->input->post('triwulan_4',TRUE));
			
            $data = array(
		'kode_kegiatan' => $this->input->post('kode_kegiatan',TRUE),
		'lokasi_kegiatan' => $this->input->post('lokasi_kegiatan',TRUE),
		'target_kegiatan' => $this->input->post('target_kegiatan',TRUE),
		'sumber_dana' => $this->input->post('sumber_dana',TRUE),
		'triwulan_1' => $triwulan_1,
		'triwulan_2' => $triwulan_2,
		'triwulan_3' => $triwulan_3,
		'triwulan_4' => $triwulan_4,
		'jumlah_total' => $triwulan_1 + $triwulan_2 + $triwulan_3 + $triwulan_4,
		'id_instansi' => $this->input->post('id_instansi',TRUE),
		'tahun' => $this->input->post('tahun',TRUE),
		'id_admin' => $_SESSION['id_admin'],
	    );

            $this->Rap_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('rap'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Rap_model->get_by_id($id);
		 $instansi = $this->Instansi_model->get_all();
		$kegiatan = $this->Kegiatan_model->get_all();

        if ($row) {
            $data = array(
			 'instansi' => $instansi,
            'kegiatan' => $kegiatan,
                'button' => 'Update',
                'action' => site_url('rap/update_action'),
		'id_rap' => set_value('id_rap', $row->id_rap),
		'kode_kegiatan' => set_value('kode_kegiatan', $row->kode_kegiatan),
		'lokasi_kegiatan' => set_value('lokasi_kegiatan', $row->lokasi_kegiatan),
		'target_kegiatan' => set_value('target_kegiatan', $row->target_kegiatan),
		'sumber_dana' => set_value('sumber_dana', $row->sumber_dana),
		'triwulan_1' => set_value('triwulan_1', number_format($row->triwulan_1)),
		'triwulan_2' => set_value('triwulan_2', number_format($row->triwulan_2)),
		'triwulan_3' => set_value('triwulan_3', number_format($row->triwulan_3)),
		'triwulan_4' => set_value('triwulan_4', number_format($row->triwulan_4)),
		'jumlah_total' => set_value('jumlah_total', number_format($row->jumlah_total)),
		'id_instansi' => set_value('id_instansi', $row->id_instansi),
		'tahun' => set_value('tahun', $row->tahun),
		'id_admin' => set_value('id_admin', $row->id_admin),
		'menu' => "rap",
	    );
            $this->template->load('template','rap/rap_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('rap'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_rap', TRUE));
        } else {
			$triwulan_1 = str_replace(",","",$this->input->post('triwulan_1',TRUE));
			$triwulan_2 = str_replace(",","",$this->input->post('triwulan_2',TRUE));
			$triwulan_3 = str_replace(",","",$this->input->post('triwulan_3',TRUE));
			$triwulan_4 = str_replace(",","",$this->input->post('triwulan_4',TRUE));
			
			
            $data = array(
		'kode_kegiatan' => $this->input->post('kode_kegiatan',TRUE),
		'lokasi_kegiatan' => $this->input->post('lokasi_kegiatan',TRUE),
		'target_kegiatan' => $this->input->post('target_kegiatan',TRUE),
		'sumber_dana' => $this->input->post('sumber_dana',TRUE),
		'triwulan_1' => $triwulan_1,
		'triwulan_2' => $triwulan_2,
		'triwulan_3' => $triwulan_3,
		'triwulan_4' => $triwulan_4,
		'jumlah_total' => $triwulan_1 + $triwulan_2 + $triwulan_3 + $triwulan_4,
		'id_instansi' => $this->input->post('id_instansi',TRUE),
		'tahun' => $this->input->post('tahun',TRUE),
		'id_admin' => $_SESSION['id_admin'],
	    );

            $this->Rap_model->update($this->input->post('id_rap', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('rap'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Rap_model->get_by_id($id);

        if ($row) {
            $this->Rap_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('rap'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('rap'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_kegiatan', 'kode kegiatan', 'trim|required');
	$this->form_validation->set_rules('lokasi_kegiatan', 'lokasi kegiatan', 'trim|required');
	$this->form_validation->set_rules('target_kegiatan', 'target kegiatan', 'trim|required');
	$this->form_validation->set_rules('sumber_dana', 'sumber dana', 'trim|required');
	$this->form_validation->set_rules('triwulan_1', 'triwulan 1', 'trim|required');
	$this->form_validation->set_rules('triwulan_2', 'triwulan 2', 'trim|required');
	$this->form_validation->set_rules('triwulan_3', 'triwulan 3', 'trim|required');
	$this->form_validation->set_rules('triwulan_4', 'triwulan 4', 'trim|required');
	$this->form_validation->set_rules('id_instansi', 'id instansi', 'trim|required');
	$this->form_validation->set_rules('tahun', 'tahun', 'trim|required');

	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
		
		$id_instansi = $this->input->post('id_instansi',TRUE);
		$thn = $this->input->post('tahun',TRUE);
		
		if ($id_instansi != "-Pilih Instansi-") {	
		// Panggil data 
			$tahun  = $thn;
			$rap_data =    $this->Rap_model->get_all_cetak($id_instansi, $tahun); //nanti di foreach dibawah
			$instansi =    $this->Instansi_model->get_by_id($id_instansi);
			$nama_instansi  = $instansi->nama_instansi;
			$urusan_pemerintahan  = $instansi->urusan_pemerintahan;
			$organisasi  = $instansi->organisasi;
			$sub_unit_organisasi  = $instansi->sub_unit_organisasi;
			$pejabat_mengetahui  = $instansi->pejabat_mengetahui;
			$nama_pejabat  = $instansi->nama_pejabat;
			$penanggung_jawab  = $instansi->penanggung_jawab;
		
         $namafile = "Laporan RAP";
		 $setCreator = $_SESSION['nama'];	   
		 $setLastModifiedBy = $_SESSION['nama'];	   
		 $setTitle = $namafile;	   
		 $setSubject = $namafile;	   
		 $setDescription = $namafile;	   
		 $setKeywords = $namafile;	   
		 
		 // Load plugin PHPExcel nya    
		 include APPPATH.'third_party/PHPExcel/PHPExcel.php';        
		 // Panggil class PHPExcel nya    
		 $excel = new PHPExcel();
		 
		 // Settingan awal fil excel    
		 $excel->getProperties()->setCreator($setCreator)                 
								->setLastModifiedBy($setLastModifiedBy)
								->setTitle($setTitle)
								->setSubject($setSubject)
								->setDescription($setDescription)
								->setKeywords($setKeywords);
		 
		    // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
    $style_col = array(
      'font' => array('bold' => true), // Set font nya jadi bold
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ),
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
      )
    );

    // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
    $style_row = array(
      'alignment' => array(
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ),
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
      )
    );
	
	// garis kiri
    $garis_kiri = array(
      'borders' => array(
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
      )
    );
	 $excel->getActiveSheet()->getStyle('B7:B8')->applyFromArray($garis_kiri);
	 
	// garis kanan
    $garis_kanan = array(
      'borders' => array(
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border right dengan garis tipis
      )
    );
	$excel->getActiveSheet()->getStyle('K7:K8')->applyFromArray($garis_kanan);
	// garis atas
    $garis_atas = array(
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border top dengan garis tipis
      )
    );
	$excel->getActiveSheet()->getStyle('C6:J6')->applyFromArray($garis_atas);
	// garis kiri atas
    $garis_kiri_atas = array(
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
      )
    );
	$excel->getActiveSheet()->getStyle('B6')->applyFromArray($garis_kiri_atas);
	// garis kanan atas
    $garis_kanan_atas = array(
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border right dengan garis tipis
      )
    );
	$excel->getActiveSheet()->getStyle('K6')->applyFromArray($garis_kanan_atas);
    $excel->setActiveSheetIndex(0)->setCellValue('B2', "DOKUMEN PENGGUNAAAN/PENGELUARAN, BELANJA  ANGGARAN SATUAN KERJA PERANGKAT DAERAH"); // Set kolom B2 dengan tulisan "DATA SISWA"
    $excel->setActiveSheetIndex(0)->setCellValue('B3', $nama_instansi); // Set kolom B2 dengan tulisan "DATA SISWA"
    $excel->setActiveSheetIndex(0)->setCellValue('B4', "TAHUN $tahun"); // Set kolom B2 dengan tulisan "DATA SISWA"
    
	$excel->getActiveSheet()->mergeCells('B2:K2'); // Set Merge Cell pada kolom B2 sampai E1
    $excel->getActiveSheet()->mergeCells('B3:K3'); // Set Merge Cell pada kolom B2 sampai E1
    $excel->getActiveSheet()->mergeCells('B4:K4'); // Set Merge Cell pada kolom B2 sampai E1
    
	$excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(TRUE); // Set bold kolom B2
    $excel->getActiveSheet()->getStyle('B3')->getFont()->setBold(TRUE); // Set bold kolom B2
    $excel->getActiveSheet()->getStyle('B4')->getFont()->setBold(TRUE); // Set bold kolom B2
    
	$excel->getActiveSheet()->getStyle('B2')->getFont()->setSize(15); // Set font size 15 untuk kolom B2
    $excel->getActiveSheet()->getStyle('B3')->getFont()->setSize(15); // Set font size 15 untuk kolom B2
    $excel->getActiveSheet()->getStyle('B4')->getFont()->setSize(15); // Set font size 15 untuk kolom B2
    
	$excel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom B2
    $excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom B2
    $excel->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom B2
	
	
	 // Buat header instansi
    $excel->setActiveSheetIndex(0)->setCellValue('C6', "Urusan Pemerintahan    :  $urusan_pemerintahan"); // Set kolom A3 dengan tulisan "NO"
    $excel->setActiveSheetIndex(0)->setCellValue('C7', "Organisasi                           :  $organisasi"); // Set kolom B3 dengan tulisan "NIS"
    $excel->setActiveSheetIndex(0)->setCellValue('C8', "Sub Unit Organisasi         :  $sub_unit_organisasi"); // Set kolom C3 dengan tulisan "NAMA"
   
   
   //set lebar kolomnya
   $excel->getActiveSheet()->getColumnDimension('A')->setWidth(2,86);
   $excel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
   $excel->getActiveSheet()->getColumnDimension('C')->setWidth(50);
   $excel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
   $excel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
   $excel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
   $excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
   $excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
   $excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
   $excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
   $excel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
	
    // Buat header tabel nya pada baris ke 3
    $excel->setActiveSheetIndex(0)->setCellValue('B9', "KODE KEGIATAN"); // Set kolom A3 dengan tulisan "NO"
	$excel->getActiveSheet()->mergeCells('B9:B10');
    $excel->setActiveSheetIndex(0)->setCellValue('C9', "URAIAN KEGIATAN"); // Set kolom B3 dengan tulisan "NIS"
	$excel->getActiveSheet()->mergeCells('C9:C10');
	
    $excel->setActiveSheetIndex(0)->setCellValue('D9', "LOKASI KEGIATAN"); // Set kolom C3 dengan tulisan "NAMA"
	$excel->getActiveSheet()->mergeCells('D9:D10');
    $excel->setActiveSheetIndex(0)->setCellValue('E9', "TARGET KEGIATAN"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
	$excel->getActiveSheet()->mergeCells('E9:E10');
    $excel->setActiveSheetIndex(0)->setCellValue('F9', "SUMBER DANA"); // Set kolom E3 dengan tulisan "ALAMAT"
	$excel->getActiveSheet()->mergeCells('F9:F10');
    $excel->setActiveSheetIndex(0)->setCellValue('G9', "TRIWULAN"); // Set kolom E3 dengan tulisan "ALAMAT"
	$excel->getActiveSheet()->mergeCells('G9:J9');
    $excel->setActiveSheetIndex(0)->setCellValue('G10', "I"); // Set kolom E3 dengan tulisan "ALAMAT"
    $excel->setActiveSheetIndex(0)->setCellValue('H10', "II"); // Set kolom E3 dengan tulisan "ALAMAT"
    $excel->setActiveSheetIndex(0)->setCellValue('I10', "III"); // Set kolom E3 dengan tulisan "ALAMAT"
    $excel->setActiveSheetIndex(0)->setCellValue('J10', "IV"); // Set kolom E3 dengan tulisan "ALAMAT"
    $excel->setActiveSheetIndex(0)->setCellValue('K9', "JUMLAH"); // Set kolom E3 dengan tulisan "ALAMAT"
	$excel->getActiveSheet()->mergeCells('K9:K10');

    // Apply style header yang telah kita buat tadi ke masing-masing kolom header
    $excel->getActiveSheet()->getStyle('B9:B10')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('C9:C10')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('D9:D10')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('E9:E10')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('F9:F10')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('G9:J9')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('G10')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('H10')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('I10')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('J10')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('K9:K10')->applyFromArray($style_col);
	$excel->getActiveSheet()->getStyle('B9:K10')->getAlignment()->setWrapText(true); 

	$numrow = 11; // Set baris pertama untuk isi tabel adalah baris ke 4
    foreach($rap_data as $data){ // Lakukan looping pada variabel siswa
      $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->kode_kegiatan);
      $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->uraian_kegiatan);
      $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->lokasi_kegiatan);
      $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->target_kegiatan);
      $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->sumber_dana);
      $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->triwulan_1);
      $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->triwulan_2);
      $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data->triwulan_3);
      $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data->triwulan_4);
      $excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data->jumlah_total);
      
      // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
      $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
	  
	  //wrap-text
	  $excel->getActiveSheet()->getStyle('B'.$numrow)->getAlignment()->setWrapText(true); 
      $excel->getActiveSheet()->getStyle('C'.$numrow)->getAlignment()->setWrapText(true); 
      $excel->getActiveSheet()->getStyle('D'.$numrow)->getAlignment()->setWrapText(true); 
      $excel->getActiveSheet()->getStyle('E'.$numrow)->getAlignment()->setWrapText(true); 
      $excel->getActiveSheet()->getStyle('F'.$numrow)->getAlignment()->setWrapText(true); 
      $excel->getActiveSheet()->getStyle('G'.$numrow)->getAlignment()->setWrapText(true); 
      $excel->getActiveSheet()->getStyle('H'.$numrow)->getAlignment()->setWrapText(true); 
      $excel->getActiveSheet()->getStyle('I'.$numrow)->getAlignment()->setWrapText(true); 
      $excel->getActiveSheet()->getStyle('J'.$numrow)->getAlignment()->setWrapText(true); 
      $excel->getActiveSheet()->getStyle('K'.$numrow)->getAlignment()->setWrapText(true); 
	  
	  $numformat = 'Rp#,##0';
	  $excel->getActiveSheet()->getStyle('G'.$numrow)->getNumberFormat()->setFormatCode($numformat);
	  $excel->getActiveSheet()->getStyle('H'.$numrow)->getNumberFormat()->setFormatCode($numformat);
	  $excel->getActiveSheet()->getStyle('I'.$numrow)->getNumberFormat()->setFormatCode($numformat);
	  $excel->getActiveSheet()->getStyle('J'.$numrow)->getNumberFormat()->setFormatCode($numformat);
	  $excel->getActiveSheet()->getStyle('K'.$numrow)->getNumberFormat()->setFormatCode($numformat);
	  
	  $numrow++; // Tambah 1 setiap kali looping
	}
		
	 $numrow1 = $numrow+3;	
	 $numrow2 = $numrow1+3;	
	 $numrow3 = $numrow1+4;	
	 $numrow4 = $numrow1+9;	
	 $numrow5 = $numrow1+4;	
	 $numrow6 = $numrow1+3;	
	 $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow1, '……………………………………….');
	 $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow2, 'Mengetahui,');
	 $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow3, $pejabat_mengetahui);
	 $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow4, $nama_pejabat);
	 $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow3, 'Penanggungg Jawab Penggunaan Dana');
	 $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow4, $penanggung_jawab);
	 
		 // Set judul file excel nya    
		 $excel->getActiveSheet(0)->setTitle($namafile);    
		 $excel->setActiveSheetIndex(0);    
		 // Proses file excel    
		 header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');    
		 header('Content-Disposition: attachment; filename="'.$namafile.'.xlsx"'); // Set nama file excel nya    
		 header('Cache-Control: max-age=0');    $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');    $write->save('php://output');
    
		} else {
			redirect(site_url('rap'));
		}
	
	}

}

/* End of file Rap.php */
/* Location: ./application/controllers/Rap.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-10-26 06:24:47 */
/* http://harviacode.com */