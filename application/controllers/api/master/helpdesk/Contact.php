<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Contact extends REST_Controller {

	function __construct()
	{
		parent::__construct();

		$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
		$this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
	}
	function index_get() {
        if($this->get('user_id')=='' OR $this->get('user_id')==NULL){
            $hasil['status'] = 'Harap memasukkan User ID.';
			$this->response($hasil, 200);
        }else{
            $cek = $this->Main_model->getSelectedData('user_to_role a', 'a.*', array('a.user_id'=>$this->get('user_id')))->row();
            if($cek==NULL){
                $hasil['status'] = 'Data yang Anda cari tidak ditemukan.';
			    $this->response($hasil, 200);
            }else{
                if($cek->role_id=='0' OR $cek->role_id=='1'){
                    $get_data_petugas = $this->Main_model->getSelectedData('petugas a', 'a.*')->result();
                    $data_tampung = array();
                    foreach ($get_data_petugas as $key => $value) {
                        $isi['user_id'] = $value->user_id;
                        $isi['nama'] = $value->nama;
                        $isi['role'] = 'Petugas';
                        $data_tampung[] = $isi;
                    }
                    $this->response($data_tampung, 200);

                }elseif($cek->role_id=='2'){
                    $q_petugas = "SELECT a.* FROM petugas a WHERE a.user_id NOT IN (".$this->get('user_id').")";
                    $get_data_petugas = $this->db->query($q_petugas)->result();
                    foreach ($get_data_petugas as $key => $value) {
                        $isi['user_id'] = $value->user_id;
                        $isi['nama'] = $value->nama;
                        $isi['role'] = 'Petugas';
                        $data_tampung[] = $isi;
                    }
                    $data_admin['user_id'] = '1';
                    $data_admin['nama'] = 'Admin';
                    $data_admin['role'] = 'Admin';
                    $data_tampung[] = $data_admin;
                    $this->response($data_tampung, 200);
                }else{
                    $hasil['status'] = 'Akun Anda tidak dikenali oleh sistem.';
                    $this->response($hasil, 200);
                }
            }
        }
	}

	function index_post() {
    }

	function index_put() {
	}

	function index_delete() {
    }
}