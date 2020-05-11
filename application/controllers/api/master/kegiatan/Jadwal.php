<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Jadwal extends REST_Controller {

	function __construct()
	{
		parent::__construct();

		$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
		$this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
	}
	function index_get() {
        if($this->get('id_jadwal_kegiatan')=='' OR $this->get('id_jadwal_kegiatan')==NULL){
            $cek = $this->Main_model->getSelectedData('jadwal_kegiatan a', 'a.*')->result();
            if($cek==NULL){
                $hasil['status'] = 'Data kosong.';
			    $this->response($hasil, 200);
            }else{
                $this->response($cek, 200);
            }
        }else{
            $cek = $this->Main_model->getSelectedData('jadwal_kegiatan a', 'a.*', array('a.id_jadwal_kegiatan'=>$this->get('id_jadwal_kegiatan')))->row();
            if($cek==NULL){
                $hasil['status'] = 'Data yang Anda cari tidak ditemukan.';
			    $this->response($hasil, 200);
            }else{
                $this->response($cek, 200);
            }
        }
	}

	function index_post() {
		$cek = $this->Main_model->getSelectedData('user a', 'a.*', array("a.id" => $this->post('user_id'), "a.is_active" => '1', 'a.deleted' => '0'), 'a.username ASC')->result();
		if($cek!=NULL){
            $cur_data = date('Y-m-d');
            if($cur_data<$this->post('tanggal')){
                foreach ($cek as $key => $value) {
                    $this->db->trans_start();
                    $get_last_id = $this->Main_model->getLastID('jadwal_kegiatan','id_jadwal_kegiatan');

                    $data_insert1 = array(
                        'id_jadwal_kegiatan' => $get_last_id['id_jadwal_kegiatan']+1,
                        'direktorat' => $this->post('direktorat'),
                        'subdirektorat' => $this->post('subdirektorat'),
                        'kegiatan' => $this->post('kegiatan'),
                        'tanggal' => $this->post('tanggal'),
                        'tanggal_selesai' => $this->post('tanggal'),
                        'lokasi' => $this->post('lokasi'),
                        'peserta' => $this->post('peserta'),
                        'surat' => $this->post('surat'),
                        'created_by' => $this->post('user_id'),
                        'created_at' => date('Y-m-d H:i:s')
                    );
                    $this->Main_model->insertData('jadwal_kegiatan',$data_insert1);
                    // print_r($data_insert1);
                    $this->Main_model->log_activity($this->post('user_id'),'Menambahkan data','Menambahkan data jadwal kegiatan ('.$this->post('kegiatan').' - '.$this->Main_model->convert_tanggal($this->post('tanggal')).') via mobile apps');
                    $this->db->trans_complete();
                    if($this->db->trans_status() === false){
                        $hasil['status'] = 'Gagal menambahkan data, harap coba lagi.';
			            $this->response($hasil, 200);
                    }
                    else{
                        $hasil['status'] = 'Sukses menambahkan data.';
			            $this->response($hasil, 200);
                    }
                }
            }
            else{
                $hasil['status'] = 'Hari telah lewat, tidak bisa menambahkan jadwal kegiatan.';
			    $this->response($hasil, 200);
            }
		}
		else{
			$hasil['status'] = 'Username/ Email yang Anda masukkan tidak terdaftar, sehingga tidak bisa menggunakan fitur ini.';
			$this->response($hasil, 200);
		}
	}

	function index_put() {
	}

	function index_delete() {
    }
}