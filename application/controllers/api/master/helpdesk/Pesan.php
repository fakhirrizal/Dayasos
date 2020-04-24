<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Pesan extends REST_Controller {

	function __construct()
	{
		parent::__construct();

		$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
		$this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
	}
	function index_get()
    {
	}

	function index_post() {
        if($this->post('pengirim')=='' OR $this->post('pengirim')==NULL OR $this->post('penerima')=='' OR $this->post('penerima')==NULL){
            $hasil['status'] = 'Pengirim atau penerima tidak boleh kosong.';
            $this->response($hasil, 200);
        }else{
            $cek1 = $this->Main_model->getSelectedData('user a', 'a.*', array("a.id" => $this->post('pengirim'), "a.is_active" => '1', 'a.deleted' => '0'), 'a.username ASC')->result();
            if($cek1==NULL){
                $hasil['status'] = 'ID pengirim tidak terdaftar di dalam sistem.';
                $this->response($hasil, 200);
            }else{
                $cek2 = $this->Main_model->getSelectedData('user a', 'a.*', array("a.id" => $this->post('penerima'), "a.is_active" => '1', 'a.deleted' => '0'), 'a.username ASC')->row();
                if($cek2==NULL){
                    $hasil['status'] = 'ID penerima tidak terdaftar di dalam sistem.';
                    $this->response($hasil, 200);
                }else{
                    $this->db->trans_start();
                    $get_last_id = $this->Main_model->getLastID('helpdesk','id_pesan');

                    $data_insert1 = array(
                        'id_pesan' => $get_last_id['id_pesan']+1,
                        'pengirim' => $this->post('pengirim'),
                        'penerima' => $this->post('penerima'),
                        'waktu' => date('Y-m-d H:i:s'),
                        'pesan' => $this->post('pesan')
                    );
                    $this->Main_model->insertData('helpdesk',$data_insert1);
                    // print_r($data_insert1);
                    $this->Main_model->log_activity($this->post('pengirim'),'Menambahkan data','Mengirim pesan ke '.$cek2->fullname.' via mobile apps');
                    $this->db->trans_complete();
                    if($this->db->trans_status() === false){
                        $hasil['status'] = 'Pesan gagal dikirim, harap coba lagi.';
			            $this->response($hasil, 200);
                    }
                    else{
                        $hasil['status'] = 'Pesan telah terkirim.';
			            $this->response($hasil, 200);
                    }
                }
            }
        }
	}

	function index_put() {
	}

	function index_delete() {
    }
}