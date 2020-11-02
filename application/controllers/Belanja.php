<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Belanja extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Belanja_model');
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
            $config['first_url'] = base_url() . 'index.php/belanja/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/belanja/index/';
            $config['first_url'] = base_url() . 'index.php/belanja/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Belanja_model->total_rows($q);
        $belanja = $this->Belanja_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);
		$data = array(
            'belanja_data' => $belanja,
			'instansi' => $instansi,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'menu' => "belanja",
        );
        $this->template->load('template','belanja/belanja_list', $data);
    }
	
	public function cetak()
	{
		$data['menu'] = "belanja";
		$id_instansi = $this->input->post('id_instansi',TRUE);
		$tahun = $this->input->post('tahun',TRUE);
		
		if ($id_instansi != "-Pilih Instansi-") {
		$data['tahun'] = $tahun;
		$data['belanja_data']=    $this->Belanja_model->get_all_cetak($id_instansi, $tahun);
		$instansi =    $this->Instansi_model->get_by_id($id_instansi);
			$data['nama_instansi'] = $instansi->nama_instansi;
			$data['urusan_pemerintahan'] = $instansi->urusan_pemerintahan;
			$data['organisasi'] = $instansi->organisasi;
			$data['sub_unit_organisasi'] = $instansi->sub_unit_organisasi;
			$data['pejabat_mengetahui'] = $instansi->pejabat_mengetahui;
			$data['nama_pejabat'] = $instansi->nama_pejabat;
			$data['penanggung_jawab'] = $instansi->penanggung_jawab;
		
		$this->load->view('belanja/belanja_cetak',$data);
		} else {
			redirect(site_url('belanja'));
		}
	}
	
    public function read($id) 
    {
        $row = $this->Belanja_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_belanja' => $row->id_belanja,
		'kode_kegiatan' => $row->kode_kegiatan,
		'pc' => $row->pc,
		'waktu' => $row->waktu,
		'harga' => $row->harga,
		'jumlah' => $row->jumlah,
		'triwulan_1' => $row->triwulan_1,
		'triwulan_2' => $row->triwulan_2,
		'triwulan_3' => $row->triwulan_3,
		'triwulan_4' => $row->triwulan_4,
		'jumlah_total' => $row->jumlah_total,
		'id_instansi' => $row->id_instansi,
		'tahun' => $row->tahun,
		'id_admin' => $row->id_admin,
		'menu' => "belanja",
	    );
            $this->template->load('template','belanja/belanja_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('belanja'));
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
            'action' => site_url('belanja/create_action'),
	    'id_belanja' => set_value('id_belanja'),
	    'kode_kegiatan' => set_value('kode_kegiatan'),
	    'pc' => set_value('pc'),
	    'waktu' => set_value('waktu'),
	    'harga' => set_value('harga'),
	    'jumlah' => set_value('jumlah'),
	    'triwulan_1' => set_value('triwulan_1'),
	    'triwulan_2' => set_value('triwulan_2'),
	    'triwulan_3' => set_value('triwulan_3'),
	    'triwulan_4' => set_value('triwulan_4'),
	    'jumlah_total' => set_value('jumlah_total'),
	    'id_instansi' => set_value('id_instansi'),
	    'tahun' => set_value('tahun'),
	    'id_admin' => set_value('id_admin'),
		'menu' => "belanja",
	);
        $this->template->load('template','belanja/belanja_form', $data);
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
			$harga 		= str_replace(",","",$this->input->post('harga',TRUE));
			$pc			= str_replace(",","",$this->input->post('pc',TRUE));
			
            $data = array(
		'kode_kegiatan' => $this->input->post('kode_kegiatan',TRUE),
		'pc' => $pc,
		'waktu' => $this->input->post('waktu',TRUE),
		'harga' => $harga,
		'jumlah' => $harga*$pc,
		'triwulan_1' => $triwulan_1,
		'triwulan_2' => $triwulan_2,
		'triwulan_3' => $triwulan_3,
		'triwulan_4' => $triwulan_4,
		'jumlah_total' => $triwulan_1 + $triwulan_2 + $triwulan_3 + $triwulan_4,
		'id_instansi' => $this->input->post('id_instansi',TRUE),
		'tahun' => $this->input->post('tahun',TRUE),
		'id_admin' => $_SESSION['id_admin'],
	    );

            $this->Belanja_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('belanja'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Belanja_model->get_by_id($id);
		$instansi = $this->Instansi_model->get_all();
		$kegiatan = $this->Kegiatan_model->get_all();
        if ($row) {
            $data = array(
			'instansi' => $instansi,
            'kegiatan' => $kegiatan,
                'button' => 'Update',
                'action' => site_url('belanja/update_action'),
		'id_belanja' => set_value('id_belanja', $row->id_belanja),
		'kode_kegiatan' => set_value('kode_kegiatan', $row->kode_kegiatan),
		'pc' => set_value('pc', $row->pc),
		'waktu' => set_value('waktu', $row->waktu),
		'harga' => set_value('harga', number_format($row->harga)),
		'jumlah' => set_value('jumlah', number_format($row->jumlah)),
		'triwulan_1' => set_value('triwulan_1', number_format($row->triwulan_1)),
		'triwulan_2' => set_value('triwulan_2', number_format($row->triwulan_2)),
		'triwulan_3' => set_value('triwulan_3', number_format($row->triwulan_3)),
		'triwulan_4' => set_value('triwulan_4', number_format($row->triwulan_4)),
		'jumlah_total' => set_value('jumlah_total', number_format($row->jumlah_total)),
		'id_instansi' => set_value('id_instansi', $row->id_instansi),
		'tahun' => set_value('tahun', $row->tahun),
		'id_admin' => set_value('id_admin', $row->id_admin),
		'menu' => "belanja",
	    );
            $this->template->load('template','belanja/belanja_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('belanja'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_belanja', TRUE));
        } else {
			$triwulan_1 = str_replace(",","",$this->input->post('triwulan_1',TRUE));
			$triwulan_2 = str_replace(",","",$this->input->post('triwulan_2',TRUE));
			$triwulan_3 = str_replace(",","",$this->input->post('triwulan_3',TRUE));
			$triwulan_4 = str_replace(",","",$this->input->post('triwulan_4',TRUE));
			$harga = str_replace(",","",$this->input->post('harga',TRUE));
			$pc = str_replace(",","",$this->input->post('pc',TRUE));
			
            $data = array(
		'kode_kegiatan' => $this->input->post('kode_kegiatan',TRUE),
		'pc' => $pc,
		'waktu' => $this->input->post('waktu',TRUE),
		'harga' => $harga,
		'jumlah' => $harga*$pc,
		'triwulan_1' => $triwulan_1,
		'triwulan_2' => $triwulan_2,
		'triwulan_3' => $triwulan_3,
		'triwulan_4' => $triwulan_4,
		'jumlah_total' => $triwulan_1 + $triwulan_2 + $triwulan_3 + $triwulan_4,
		'id_instansi' => $this->input->post('id_instansi',TRUE),
		'tahun' => $this->input->post('tahun',TRUE),
		'id_admin' => $_SESSION['id_admin'],
	    );

            $this->Belanja_model->update($this->input->post('id_belanja', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('belanja'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Belanja_model->get_by_id($id);

        if ($row) {
            $this->Belanja_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('belanja'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('belanja'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_kegiatan', 'kode kegiatan', 'trim|required');
	$this->form_validation->set_rules('pc', 'pc', 'trim|required');
	$this->form_validation->set_rules('waktu', 'waktu', 'trim|required');
	$this->form_validation->set_rules('harga', 'harga', 'trim|required');
	$this->form_validation->set_rules('triwulan_1', 'triwulan 1', 'trim|required');
	$this->form_validation->set_rules('triwulan_2', 'triwulan 2', 'trim|required');
	$this->form_validation->set_rules('triwulan_3', 'triwulan 3', 'trim|required');
	$this->form_validation->set_rules('triwulan_4', 'triwulan 4', 'trim|required');
	$this->form_validation->set_rules('id_instansi', 'id instansi', 'trim|required');
	$this->form_validation->set_rules('tahun', 'tahun', 'trim|required');

	$this->form_validation->set_rules('id_belanja', 'id_belanja', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
       $id_instansi = $this->input->post('id_instansi',TRUE);
		$thn = $this->input->post('tahun',TRUE);
		
		if ($id_instansi != "-Pilih Instansi-") {	
		// Panggil data 
			$tahun  = $thn;
			$belanja_data =    $this->Belanja_model->get_all_cetak($id_instansi, $tahun); //nanti di foreach dibawah
			$instansi =    $this->Instansi_model->get_by_id($id_instansi);
			$nama_instansi  = $instansi->nama_instansi;
			$urusan_pemerintahan  = $instansi->urusan_pemerintahan;
			$organisasi  = $instansi->organisasi;
			$sub_unit_organisasi  = $instansi->sub_unit_organisasi;
			$pejabat_mengetahui  = $instansi->pejabat_mengetahui;
			$nama_pejabat  = $instansi->nama_pejabat;
			$penanggung_jawab  = $instansi->penanggung_jawab;
		
         $namafile = "Laporan Pembelanjaan";
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
	
    $excel->setActiveSheetIndex(0)->setCellValue('B2', "DOKUMEN PENGGUNAAAN/PENGELUARAN, BELANJA  ANGGARAN SATUAN KERJA PERANGKAT DAERAH"); // Set kolom B2 dengan tulisan "DATA SISWA"
    $excel->setActiveSheetIndex(0)->setCellValue('B3', $nama_instansi); // Set kolom B2 dengan tulisan "DATA SISWA"
    $excel->setActiveSheetIndex(0)->setCellValue('B4', "TAHUN $tahun"); // Set kolom B2 dengan tulisan "DATA SISWA"
    
	$excel->getActiveSheet()->mergeCells('B2:L2'); // Set Merge Cell pada kolom B2 sampai E1
    $excel->getActiveSheet()->mergeCells('B3:L3'); // Set Merge Cell pada kolom B2 sampai E1
    $excel->getActiveSheet()->mergeCells('B4:L4'); // Set Merge Cell pada kolom B2 sampai E1
    
	$excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(TRUE); // Set bold kolom B2
    $excel->getActiveSheet()->getStyle('B3')->getFont()->setBold(TRUE); // Set bold kolom B2
    $excel->getActiveSheet()->getStyle('B4')->getFont()->setBold(TRUE); // Set bold kolom B2
    
	$excel->getActiveSheet()->getStyle('B2')->getFont()->setSize(15); // Set font size 15 untuk kolom B2
    $excel->getActiveSheet()->getStyle('B3')->getFont()->setSize(15); // Set font size 15 untuk kolom B2
    $excel->getActiveSheet()->getStyle('B4')->getFont()->setSize(15); // Set font size 15 untuk kolom B2
    
	$excel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom B2
    $excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom B2
    $excel->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom B2
	
	
	
   
   
   //set lebar kolomnya
   $excel->getActiveSheet()->getColumnDimension('A')->setWidth(2,86);
   $excel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
   $excel->getActiveSheet()->getColumnDimension('C')->setWidth(38);
   $excel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
   $excel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
   $excel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
   $excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
   $excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
   $excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
   $excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
   $excel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
   $excel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
	
    // Buat header tabel nya pada baris ke 3
    $excel->setActiveSheetIndex(0)->setCellValue('B6', "KODE KEGIATAN"); // Set kolom A3 dengan tulisan "NO"
	$excel->getActiveSheet()->mergeCells('B6:B7');
    $excel->setActiveSheetIndex(0)->setCellValue('C6', "URAIAN KEGIATAN"); // Set kolom B3 dengan tulisan "NIS"
	$excel->getActiveSheet()->mergeCells('C6:C7');
	
    $excel->setActiveSheetIndex(0)->setCellValue('D6', "PC (BUAH)"); // Set kolom C3 dengan tulisan "NAMA"
	$excel->getActiveSheet()->mergeCells('D6:D7');
    $excel->setActiveSheetIndex(0)->setCellValue('E6', "WAKTU (JAM)"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
	$excel->getActiveSheet()->mergeCells('E6:E7');
    $excel->setActiveSheetIndex(0)->setCellValue('F6', "HARGA"); // Set kolom E3 dengan tulisan "ALAMAT"
	$excel->getActiveSheet()->mergeCells('F6:F7');	
	$excel->setActiveSheetIndex(0)->setCellValue('G6', "JUMLAH"); // Set kolom E3 dengan tulisan "ALAMAT"
	$excel->getActiveSheet()->mergeCells('G6:G7');	
    $excel->setActiveSheetIndex(0)->setCellValue('H6', "TRIWULAN"); // Set kolom E3 dengan tulisan "ALAMAT"
	$excel->getActiveSheet()->mergeCells('H6:K6');
    $excel->setActiveSheetIndex(0)->setCellValue('H7', "I"); // Set kolom E3 dengan tulisan "ALAMAT"
    $excel->setActiveSheetIndex(0)->setCellValue('I7', "II"); // Set kolom E3 dengan tulisan "ALAMAT"
    $excel->setActiveSheetIndex(0)->setCellValue('J7', "III"); // Set kolom E3 dengan tulisan "ALAMAT"
    $excel->setActiveSheetIndex(0)->setCellValue('K7', "IV"); // Set kolom E3 dengan tulisan "ALAMAT"
    $excel->setActiveSheetIndex(0)->setCellValue('L6', "JUMLAH"); // Set kolom E3 dengan tulisan "ALAMAT"
	$excel->getActiveSheet()->mergeCells('L6:L7');

    // Apply style header yang telah kita buat tadi ke masing-masing kolom header
    $excel->getActiveSheet()->getStyle('B6:B7')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('C6:C7')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('D6:D7')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('E6:E7')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('F6:F7')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('G6:G7')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('H6:K6')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('H7')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('I7')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('J7')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('K7')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('L6:L7')->applyFromArray($style_col);
	$excel->getActiveSheet()->getStyle('B6:L7')->getAlignment()->setWrapText(true); 

	$numrow = 8; // Set baris pertama untuk isi tabel adalah baris ke 4
    foreach($belanja_data as $data){ // Lakukan looping pada variabel siswa
      $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->kode_kegiatan);
      $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->uraian_kegiatan);
      $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->pc);
      $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->waktu);
      $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->harga);
      $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->jumlah);
      $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->triwulan_1);
      $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data->triwulan_2);
      $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data->triwulan_3);
      $excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data->triwulan_4);
      $excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $data->jumlah_total);
      
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
      $excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row);
	  
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
      $excel->getActiveSheet()->getStyle('L'.$numrow)->getAlignment()->setWrapText(true); 
	  
	  $numformat = 'Rp#,##0';
	  $excel->getActiveSheet()->getStyle('F'.$numrow)->getNumberFormat()->setFormatCode($numformat);
	  $excel->getActiveSheet()->getStyle('G'.$numrow)->getNumberFormat()->setFormatCode($numformat);
	  $excel->getActiveSheet()->getStyle('H'.$numrow)->getNumberFormat()->setFormatCode($numformat);
	  $excel->getActiveSheet()->getStyle('I'.$numrow)->getNumberFormat()->setFormatCode($numformat);
	  $excel->getActiveSheet()->getStyle('J'.$numrow)->getNumberFormat()->setFormatCode($numformat);
	  $excel->getActiveSheet()->getStyle('K'.$numrow)->getNumberFormat()->setFormatCode($numformat);
	  $excel->getActiveSheet()->getStyle('L'.$numrow)->getNumberFormat()->setFormatCode($numformat);
	  
	  $numrow++; // Tambah 1 setiap kali looping
	}
		
	 $numrow1 = $numrow+3;	
	 $numrow2 = $numrow1+3;	
	 $numrow3 = $numrow1+4;	
	 $numrow4 = $numrow1+9;	
	 $numrow5 = $numrow1+4;	
	 $numrow6 = $numrow1+3;	
	 $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow1, '……………………………………….');
	 $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow2, 'Mengetahui,');
	 $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow3, $pejabat_mengetahui);
	 $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow4, $nama_pejabat);
	 $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow3, 'Penanggungg Jawab Penggunaan Dana');
	 $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow4, $penanggung_jawab);
	 
		 // Set judul file excel nya    
		 $excel->getActiveSheet(0)->setTitle($namafile);    
		 $excel->setActiveSheetIndex(0);    
		 // Proses file excel    
		 header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');    
		 header('Content-Disposition: attachment; filename="'.$namafile.'.xlsx"'); // Set nama file excel nya    
		 header('Cache-Control: max-age=0');    $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');    $write->save('php://output');
    
		} else {
			redirect(site_url('belanja'));
		}
	
	}
}

/* End of file Belanja.php */
/* Location: ./application/controllers/Belanja.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-10-26 06:24:47 */
/* http://harviacode.com */