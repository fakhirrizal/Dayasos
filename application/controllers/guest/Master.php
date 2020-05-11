<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {
	function __construct() {
		parent::__construct();
	}
	/* Kegiatan */
	public function jadwal_kegiatan()
	{
		$data['parent'] = 'master_kegiatan';
		$data['child'] = 'jadwal_kegiatan';
		$data['grand_child'] = '';
		$this->load->view('guest/template/header',$data);
		$this->load->view('guest/master/jadwal_kegiatan',$data);
		$this->load->view('guest/template/footer');
	}
	public function json_jadwal_kegiatan()
	{
		$get_data1 = $this->Main_model->getSelectedData('jadwal_kegiatan a', 'a.*')->result();
		$data_tampil = array();
		$no = 1;
		foreach ($get_data1 as $key => $value) {
			$isi['number'] = $no++.'.';
			$isi['dir'] = $value->direktorat;
			$isi['subdir'] = $value->subdirektorat;
			$isi['kegiatan'] = $value->kegiatan;
			$isi['tgl'] = $this->Main_model->convert_tanggal(date('Y-m-d', strtotime($value->tanggal)));
			$isi['lokasi'] = $value->lokasi;
			$isi['peserta'] = $value->peserta;
			$data_tampil[] = $isi;
		}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data_tampil),
			"iTotalDisplayRecords" => count($data_tampil),
			"aaData"=>$data_tampil);
		echo json_encode($results);
	}
	public function timeline_kegiatan()
	{
		$data['parent'] = 'master_kegiatan';
		$data['child'] = 'timeline_kegiatan';
		$data['grand_child'] = '';
		$data['events'] = $this->Main_model->getSelectedData('jadwal_kegiatan a', 'a.*')->result_array();
		$this->load->view('guest/template/header',$data);
		$this->load->view('guest/master/timeline_kegiatan',$data);
		$this->load->view('guest/template/footer');
	}
	/* Other Function */
	public function ajax_page()
	{
	}
	public function ajax_function()
	{
	}
}