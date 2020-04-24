<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Laporan extends REST_Controller {

	function __construct()
	{
		parent::__construct();

		$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
		$this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
	}
	function index_get() {
        if($this->get('id_laporan_kegiatan')=='' OR $this->get('id_laporan_kegiatan')==NULL){
            $get_data = $this->Main_model->getSelectedData('laporan_kegiatan a', 'a.*')->result();
            if($get_data==NULL){
                $hasil['status'] = 'Data kosong.';
                $this->response($hasil, 200);
            }else{
                $tampil = array();
                foreach ($get_data as $key => $value) {
                    $get_data_foto = $this->Main_model->getSelectedData('foto_laporan_kegiatan a', 'a.*', array('a.id_laporan_kegiatan'=>$value->id_laporan_kegiatan))->result();
                    $hasil['data_laporan'] = $get_data;
                    $hasil['data_foto'] = $get_data_foto;
                    $tampil[] = $hasil;
                }
                $this->response($tampil, 200);
            }
        }else{
            $get_data = $this->Main_model->getSelectedData('laporan_kegiatan a', 'a.*', array('a.id_laporan_kegiatan'=>$this->get('id_laporan_kegiatan')))->row();
            $get_data_foto = $this->Main_model->getSelectedData('foto_laporan_kegiatan a', 'a.*', array('a.id_laporan_kegiatan'=>$this->get('id_laporan_kegiatan')))->result();
            if($get_data==NULL){
                $hasil['status'] = 'Data kosong.';
                $this->response($hasil, 200);
            }else{
                $hasil = array();
                $hasil['data_laporan'] = $get_data;
                $hasil['data_foto'] = $get_data_foto;
                $this->response($hasil, 200);
            }
        }
	}

	function index_post() {
        $this->db->trans_start();
        $tampung1 = $this->post('data_laporan');
        $cek = $this->Main_model->getSelectedData('jadwal_kegiatan a', 'a.*', array("a.id_jadwal_kegiatan" => $tampung1['id_jadwal_kegiatan']))->row();
        $get_last_id = $this->Main_model->getLastID('laporan_kegiatan','id_laporan_kegiatan');

        $data_insert1 = array(
            'id_laporan_kegiatan' => $get_last_id['id_laporan_kegiatan']+1,
            'unit' => $tampung1['unit'],
            'id_kegiatan' => $tampung1['id_jadwal_kegiatan'],
            'keterangan' => $tampung1['keterangan'],
            'created_by' => $tampung1['user_id'],
            'created_at' => date('Y-m-d H:i:s')
        );
        $this->Main_model->insertData('laporan_kegiatan',$data_insert1);
        // print_r($data_insert1);
        $tampung2 = $this->post('data_foto');
        foreach ($tampung2 as $key => $value) {
            $data_insert2 = array(
                'id_laporan_kegiatan' => $get_last_id['id_laporan_kegiatan']+1,
                'file' => $value['file'],
                'keterangan' => $value['keterangan']
            );
            $this->Main_model->insertData('foto_laporan_kegiatan',$data_insert2);
            // print_r($data_insert2);
        }
        $this->Main_model->log_activity($tampung1['user_id'],'Menambahkan data','Menambahkan laporan kegiatan ('.$cek->kegiatan.') via mobile apps');
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

	function index_put() {
	}

	function index_delete() {
    }
}