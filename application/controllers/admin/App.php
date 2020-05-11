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
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/app/home',$data);
		$this->load->view('admin/template/footer',$data);
	}
	public function guest_book()
	{
		$data['parent'] = 'guest_book';
		$data['child'] = '';
		$data['grand_child'] = '';
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/app/guest_book',$data);
		$this->load->view('admin/template/footer');
	}
	public function json_guest_book()
	{
		$get_data1 = $this->Main_model->getSelectedData('tamu a', 'a.*')->result();
		$data_tampil = array();
		$no = 1;
		foreach ($get_data1 as $key => $value) {
			$isi['number'] = $no++.'.';
			$isi['nama'] = $value->nama;
			$isi['email'] = $value->email;
			$isi['ip'] = $value->ip;
			$isi['device'] = $value->device;
			$isi['os'] = $value->os;
			$isi['browser'] = $value->browser;
			$isi['date'] = $this->Main_model->convert_datetime($value->created_at);
			$data_tampil[] = $isi;
		}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data_tampil),
			"iTotalDisplayRecords" => count($data_tampil),
			"aaData"=>$data_tampil);
		echo json_encode($results);
	}
	public function log_activity()
	{
		$data['parent'] = 'log_activity';
		$data['child'] = '';
		$data['grand_child'] = '';
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/app/log_activity',$data);
		$this->load->view('admin/template/footer');
	}
	public function json_log_activity()
	{
		$get_data1 = $this->Main_model->getSelectedData('activity_logs a', 'a.*,b.fullname', '', "a.activity_time DESC",'','','',array(
			'table' => 'user b',
			'on' => 'a.user_id=b.id',
			'pos' => 'LEFT'
		))->result();
		$data_tampil = array();
		$no = 1;
		foreach ($get_data1 as $key => $value) {
			$pecah_datetime = explode(' ',$value->activity_time);
			$isi['number'] = $no++.'.';
			$isi['tipe'] = $value->activity_type;
			$isi['aktifitas'] = $value->activity_data;
			$isi['pengguna'] = $value->fullname;
			$isi['date'] = $this->Main_model->convert_tanggal($pecah_datetime[0]).' '.$pecah_datetime[1];
			$return_on_click = "return confirm('Anda yakin?')";
			$isi['action'] =	'
				<span class="dropdown">
					<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="false">
					<i class="la la-ellipsis-h"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="display: none; position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 5px, 0px);" x-out-of-boundaries="">
						<a class="dropdown-item detaildata" id="'.md5($value->activity_id).'"><i class="la la-mail-forward"></i> Detil Data</a>
						<a class="dropdown-item" onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_aktifitas/'.md5($value->activity_id)).'"><i class="la la-trash"></i> Hapus Data</a>
					</div>
				</span>
								';
			$data_tampil[] = $isi;
		}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data_tampil),
			"iTotalDisplayRecords" => count($data_tampil),
			"aaData"=>$data_tampil);
		echo json_encode($results);
	}
	public function deleted_log()
	{
		$this->db->trans_start();
		$user_id = '';
		$get_data = $this->Main_model->getSelectedData('activity_logs a', 'a.*',array('md5(a.activity_id)'=>$this->uri->segment(3)))->row();
		$user_id = $get_data->activity_id;

		$this->Main_model->deleteData('activity_logs',array('activity_id'=>$user_id));

		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning fade show" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text"><strong>Oops! </strong>Data gagal dihapus.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/log_activity/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success fade show" role="alert"><div class="alert-icon"><i class="flaticon2-checkmark"></i></div><div class="alert-text"><strong></i>Yeah! </strong>Data telah berhasil dihapus.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/log_activity/'</script>";
		}
	}
	public function cleaning_log()
	{
		$this->db->trans_start();
		$this->Main_model->cleanData('activity_logs');
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning fade show" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text"><strong>Oops! </strong>Data gagal dihapus.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/log_activity/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success fade show" role="alert"><div class="alert-icon"><i class="flaticon2-checkmark"></i></div><div class="alert-text"><strong></i>Yeah! </strong>Data telah berhasil dihapus.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/log_activity/'</script>";
		}
	}
	public function about()
	{
		$data['parent'] = 'versioning_aplikasi';
		$data['child'] = '';
		$data['grand_child'] = '';
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/app/about',$data);
		$this->load->view('admin/template/footer');
	}
	public function helper()
	{
		$data['parent'] = 'helper';
		$data['child'] = '';
		$data['grand_child'] = '';
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/app/helper',$data);
		$this->load->view('admin/template/footer');
	}
	public function profile()
	{
		$data['parent'] = '';
		$data['child'] = '';
		$data['grand_child'] = '';
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/app/profile',$data);
		$this->load->view('admin/template/footer');
	}
	public function password_setting()
	{
		$data['parent'] = '';
		$data['child'] = '';
		$data['grand_child'] = '';
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/app/password_setting',$data);
		$this->load->view('admin/template/footer');
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
		echo "<script>window.location='".base_url()."admin_side/profil'</script>";
	}
	public function password_update()
	{
		$cek = $this->Main_model->getSelectedData('user a', 'a.*', array('a.pass'=>$this->input->post('old'),'a.id'=>$this->session->userdata('id')))->result();
		if($cek==NULL){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning fade show" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text"><strong>Oops! </strong>Kata sandi tidak valid.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/pengaturan_kata_sandi/'</script>";
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
				echo "<script>window.location='".base_url()."admin_side/pengaturan_kata_sandi/'</script>";
			}
			else{
				$this->session->set_flashdata('sukses','<div class="alert alert-success fade show" role="alert"><div class="alert-icon"><i class="flaticon2-checkmark"></i></div><div class="alert-text"><strong></i>Yeah! </strong>data telah berhasil diubah.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
				echo "<script>window.location='".base_url()."admin_side/pengaturan_kata_sandi'</script>";
			}
		}
	}
	/* Menu setting and user's permission */
	public function ajax_function()
	{
		if($this->input->post('modul')=='modul_detail_log_aktifitas'){
			$data['data_utama'] = $this->Main_model->getSelectedData('activity_logs a', 'a.*,b.fullname', array('md5(a.activity_id)'=>$this->input->post('id')), "",'','','',array(
				'table' => 'user b',
				'on' => 'a.user_id=b.id',
				'pos' => 'LEFT'
			))->result();
			$this->load->view('admin/app/ajax_detail_log_aktifitas',$data);
		}
	}
}