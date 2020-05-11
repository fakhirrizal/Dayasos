<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

    function __construct() {
        parent::__construct();
	}
    public function home()
	{
		$data['parent'] = 'home';
		$data['child'] = '';
		$data['grand_child'] = '';
		$data['events'] = $this->Main_model->getSelectedData('jadwal_kegiatan a', 'a.*')->result_array();
		$this->load->view('spv/template/header',$data);
		$this->load->view('spv/app/home',$data);
		$this->load->view('spv/template/footer',$data);
	}
	public function about()
	{
		$data['parent'] = 'versioning_aplikasi';
		$data['child'] = '';
		$data['grand_child'] = '';
		$this->load->view('spv/template/header',$data);
		$this->load->view('spv/app/about',$data);
		$this->load->view('spv/template/footer');
	}
	public function helper()
	{
		$data['parent'] = 'helper';
		$data['child'] = '';
		$data['grand_child'] = '';
		$this->load->view('spv/template/header',$data);
		$this->load->view('spv/app/helper',$data);
		$this->load->view('spv/template/footer');
	}
	public function profile()
	{
		$data['parent'] = '';
		$data['child'] = '';
		$data['grand_child'] = '';
		$this->load->view('spv/template/header',$data);
		$this->load->view('spv/app/profile',$data);
		$this->load->view('spv/template/footer');
	}
	public function password_setting()
	{
		$data['parent'] = '';
		$data['child'] = '';
		$data['grand_child'] = '';
		$this->load->view('spv/template/header',$data);
		$this->load->view('spv/app/password_setting',$data);
		$this->load->view('spv/template/footer');
	}
	public function profile_update()
	{
		$nmfile = "file_".time(); // nama file saya beri nama langsung dan diikuti fungsi time
		$config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]).'/data_upload/photo_profile/'; // path folder
		$config['allowed_types'] = 'jpg|png|jpeg|bmp'; // type yang dapat diakses bisa anda sesuaikan
		$config['max_size'] = '3072'; // maksimum besar file 3M
		$config['max_width']  = '5000'; // lebar maksimum 5000 px
		$config['max_height']  = '5000'; // tinggi maksimu 5000 px
		$config['file_name'] = $nmfile; // nama yang terupload nantinya

		$this->upload->initialize($config);

		if(isset($_FILES['foto']['name']))
		{
			if(!$this->upload->do_upload('foto'))
			{
				echo'';
			}
			else
			{
				$gbr = $this->upload->data();
				$this->Main_model->updateData("user",array('photo'=>$gbr['file_name']),array('id'=>$this->session->userdata('id')));
			}
		}else{echo'';}

		$this->db->trans_start();
		$data_update0 = array(
			'fullname' => $this->input->post('fullname')
		);
		$this->Main_model->updateData('user',$data_update0,array('id'=>$this->session->userdata('id')));

		$this->db->trans_complete();
		$this->Main_model->log_activity($this->session->userdata('id'),"Updating profile's data","Update profile data",$this->session->userdata('location'));
		$this->session->set_flashdata('sukses','<div class="alert alert-success fade show" role="alert"><div class="alert-icon"><i class="flaticon2-checkmark"></i></div><div class="alert-text"><strong>Yeah! </strong>data telah berhasil diubah.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
		echo "<script>window.location='".base_url()."spv_side/profil'</script>";
	}
	public function password_update()
	{
		$cek = $this->Main_model->getSelectedData('user a', 'a.*', array('a.pass'=>$this->input->post('old'),'a.id'=>$this->session->userdata('id')))->result();
		if($cek==NULL){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning fade show" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text"><strong>Oops! </strong>Kata sandi tidak valid.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."spv_side/pengaturan_kata_sandi/'</script>";
		}
		else{
			$this->db->trans_start();
			$data_update0 = array(
				'pass' => $this->input->post('p1')
			);
			$this->Main_model->updateData('user',$data_update0,array('id'=>$this->session->userdata('id')));

			$this->db->trans_complete();
			$this->Main_model->log_activity($this->session->userdata('id'),"Updating password's data","Update password data",$this->session->userdata('location'));
			if($this->db->trans_status() === false){
				$this->session->set_flashdata('gagal','<div class="alert alert-warning fade show" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text"><strong>Oops! </strong>data gagal diubah.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
				echo "<script>window.location='".base_url()."spv_side/pengaturan_kata_sandi/'</script>";
			}
			else{
				$this->session->set_flashdata('sukses','<div class="alert alert-success fade show" role="alert"><div class="alert-icon"><i class="flaticon2-checkmark"></i></div><div class="alert-text"><strong></i>Yeah! </strong>data telah berhasil diubah.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
				echo "<script>window.location='".base_url()."spv_side/pengaturan_kata_sandi'</script>";
			}
		}
	}
	/* Menu setting and user's permission */
	public function ajax_function()
	{
	}
}