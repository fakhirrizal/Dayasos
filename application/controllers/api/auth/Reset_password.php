<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Reset_password extends REST_Controller {

	function __construct()
	{
		parent::__construct();

		$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
		$this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
	}
	function index_get() {
	}

	function index_post() {
		$cek = $this->Main_model->getSelectedData('petugas a', '*', array("a.email" => $this->post('email')))->result();
		if($cek!=NULL){
			foreach ($cek as $key => $value) {
				require_once(APPPATH.'libraries/class.phpmailer.php');
				$new_pass = random_string('alnum', 8);
				$mail = new PHPMailer; 
				$mail->IsSMTP();
				$mail->SMTPSecure = 'ssl'; 
				$mail->Host = "mail.aplikasiku.online";
				// 0 = off (for production use, No debug messages)
				// 1 = client messages
				// 2 = client and server messages
				$mail->SMTPDebug = 0;
				$mail->Port = 465;
				$mail->SMTPAuth = true;
				$mail->Username = "service@aplikasiku.online";
				$mail->Password = "Asbak425##";
				$mail->SetFrom("service@aplikasiku.online","Admin");
				$mail->Subject = "Mengatur ulang kata sandi";
				$mail->MsgHTML("Kata sandi baru Anda : ".$new_pass);
				$mail->AddAddress($value->email,$value->nama);
				$mail->Send();
				$data_update = array(
					'pass' => $new_pass
				);
				$this->Main_model->updateData('user',$data_update,array('id'=>$value->user_id));
				$this->Main_model->log_activity($value->user_id,'Reset password','Reset password user ('.$value->nama.' - via mobile apps)');
				$hasil['status'] = 'Password telah berhasil diatur ulang';
				$this->response($hasil, 200);
			}
		}
		else{
			$hasil['status'] = 'Username/ Email yang Anda masukkan tidak terdaftar';
			$this->response($hasil, 200);
		}
	}

	function index_put() {
	}

	function index_delete() {
    }
}