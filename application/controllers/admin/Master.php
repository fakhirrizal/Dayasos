<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {
	function __construct() {
		parent::__construct();
	}
	/* Administrator */
	public function administrator_data()
	{
		$data['parent'] = 'master_admin';
		$data['child'] = '';
		$data['grand_child'] = '';
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/administrator_data',$data);
		$this->load->view('admin/template/footer');
	}
	public function json_admin()
	{
		$get_data1 = $this->Main_model->getSelectedData('user a', 'a.*',array("a.is_active" => '1','a.deleted' => '0','b.role_id' => '1'),'','','','',array(
			'table' => 'user_to_role b',
			'on' => 'a.id=b.user_id',
			'pos' => 'LEFT'
		))->result();
		$data_tampil = array();
		$no = 1;
		foreach ($get_data1 as $key => $value) {
			if($value->id==$this->session->userdata('id')){
				echo'';
			}else{
				$isi['number'] = $no++.'.';
				$isi['nama'] = $value->fullname;
				$isi['username'] = $value->username;
				$isi['total_login'] = number_format($value->total_login,0).'x';
				$pecah_tanggal = explode(' ',$value->last_activity);
				$isi['last_activity'] = $this->Main_model->convert_tanggal($pecah_tanggal[0]).' '.substr($pecah_tanggal[1],0,5);
				$return_on_click = "return confirm('Anda yakin?')";
				$isi['action'] =	'
					<span class="dropdown">
						<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="false">
						<i class="la la-ellipsis-h"></i>
						</a>
						
						<div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="display: none; position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 5px, 0px);" x-out-of-boundaries="">
							<a class="dropdown-item" href="'.site_url('admin_side/ubah_data_admin/'.md5($value->id)).'"><i class="la la-edit"></i> Ubah Data</a>
							<a class="dropdown-item" onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_data_admin/'.md5($value->id)).'"><i class="la la-trash"></i> Hapus Data</a>
							<hr>
							<a class="dropdown-item" href="'.site_url('admin_side/atur_ulang_kata_sandi_admin/'.md5($value->id)).'"><i class="la la-refresh"></i> Atur Ulang Sandi</a>
						</div>
					</span>
									';
				$data_tampil[] = $isi;
			}
		}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data_tampil),
			"iTotalDisplayRecords" => count($data_tampil),
			"aaData"=>$data_tampil);
		echo json_encode($results);
	}
	public function add_administrator_data()
	{
		$data['parent'] = 'master_admin';
		$data['child'] = '';
		$data['grand_child'] = '';
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/add_administrator_data',$data);
		$this->load->view('admin/template/footer');
	}
	public function save_administrator_data()
	{
		$cek_ = $this->Main_model->getSelectedData('user a', 'a.*',array('a.username'=>$this->input->post('un')))->row();
		if($cek_==NULL){
			$this->db->trans_start();
			$get_user_id = $this->Main_model->getLastID('user','id');

			$data_insert1 = array(
				'id' => $get_user_id['id']+1,
				'username' => $this->input->post('un'),
				'pass' => $this->input->post('ps'),
				'fullname' => $this->input->post('nama'),
				'is_active' => '1',
				'created_by' => $this->session->userdata('id'),
				'created_at' => date('Y-m-d H:i:s')
			);
			$this->Main_model->insertData('user',$data_insert1);
			// print_r($data_insert1);

			$data_insert2 = array(
				'user_id' => $get_user_id['id']+1,
				'role_id' => '1'
			);
			$this->Main_model->insertData('user_to_role',$data_insert2);
			// print_r($data_insert2);

			$this->Main_model->log_activity($this->session->userdata('id'),'Adding data',"Menambahkan data Admin (".$this->input->post('nama').")",$this->session->userdata('location'));
			$this->db->trans_complete();
			if($this->db->trans_status() === false){
				$this->session->set_flashdata('gagal','<div class="alert alert-warning fade show" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text"><strong>Oops! </strong>Data gagal ditambahkan.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
				echo "<script>window.location='".base_url()."admin_side/tambah_data_admin/'</script>";
			}
			else{
				$this->session->set_flashdata('sukses','<div class="alert alert-success fade show" role="alert"><div class="alert-icon"><i class="flaticon2-checkmark"></i></div><div class="alert-text"><strong></i>Yeah! </strong>Data telah berhasil ditambahkan.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
				echo "<script>window.location='".base_url()."admin_side/administrator'</script>";
			}
		}else{
			$this->session->set_flashdata('gagal','<div class="alert alert-warning fade show" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text"><strong>Oops! </strong>Username telah digunakan.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/tambah_data_admin/'</script>";
		}
	}
	public function edit_administrator_data()
	{
		$data['parent'] = 'master_admin';
		$data['child'] = '';
		$data['grand_child'] = '';
		$data['data_utama'] = $this->Main_model->getSelectedData('user a', 'a.*', array('md5(a.id)'=>$this->uri->segment(3),'a.deleted'=>'0'))->row();
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/edit_administrator_data',$data);
		$this->load->view('admin/template/footer');
	}
	public function update_administrator_data()
	{
		$this->db->trans_start();
		if($this->input->post('ps')=='' OR $this->input->post('ps')==NULL){
			$data_insert1 = array(
				'fullname' => $this->input->post('nama')
			);
		}else{
			$data_insert1 = array(
				'pass' => $this->input->post('ps'),
				'fullname' => $this->input->post('nama')
			);
		}
		$this->Main_model->updateData('user',$data_insert1,array('md5(id)'=>$this->input->post('user_id')));
		// print_r($data_insert1);

		$this->Main_model->log_activity($this->session->userdata('id'),'Updating data',"Mengubah data Admin (".$this->input->post('nama').")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning fade show" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text"><strong>Oops! </strong>Data gagal diubah.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/ubah_data_admin/".$this->input->post('user_id')."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success fade show" role="alert"><div class="alert-icon"><i class="flaticon2-checkmark"></i></div><div class="alert-text"><strong></i>Yeah! </strong>Data telah berhasil diubah.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/administrator/'</script>";
		}
	}
	public function reset_password_administrator_account()
	{
		$this->db->trans_start();
		$user_id = '';
		$name = '';
		$get_data = $this->Main_model->getSelectedData('user a', 'a.*',array('md5(a.id)'=>$this->uri->segment(3)))->row();
		$user_id = $get_data->id;
		$name = $get_data->fullname;

		$this->Main_model->updateData('user',array('pass'=>'12345'),array('id'=>$user_id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Updating data","Mengatur ulang kata sandi (".$name.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning fade show" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text"><strong>Oops! </strong>Data gagal diubah.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/administrator/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success fade show" role="alert"><div class="alert-icon"><i class="flaticon2-checkmark"></i></div><div class="alert-text"><strong></i>Yeah! </strong>Data telah berhasil diubah.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/administrator'</script>";
		}
	}
	public function delete_administrator_data()
	{
		$this->db->trans_start();
		$user_id = '';
		$name = '';
		$get_data = $this->Main_model->getSelectedData('user a', 'a.*',array('md5(a.id)'=>$this->uri->segment(3)))->row();
		$user_id = $get_data->id;
		$name = $get_data->fullname;

		$this->Main_model->deleteData('user_to_role',array('user_id'=>$user_id));
		$this->Main_model->deleteData('user',array('id'=>$user_id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus data akun Admin (".$name.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning fade show" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text"><strong>Oops! </strong>Data gagal dihapus.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/administrator/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success fade show" role="alert"><div class="alert-icon"><i class="flaticon2-checkmark"></i></div><div class="alert-text"><strong></i>Yeah! </strong>Data telah berhasil dihapus.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/administrator/'</script>";
		}
	}
	/* Member */
	public function member_data()
	{
		$data['parent'] = 'master_member';
		$data['child'] = '';
		$data['grand_child'] = '';
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/member_data',$data);
		$this->load->view('admin/template/footer');
	}
	public function json_member()
	{
		$get_data1 = $this->Main_model->getSelectedData('user a', 'a.*',array("a.is_active" => '1','a.deleted' => '0','b.role_id' => '2'),'','','','',array(
			'table' => 'user_to_role b',
			'on' => 'a.id=b.user_id',
			'pos' => 'LEFT'
		))->result();
		$data_tampil = array();
		$no = 1;
		foreach ($get_data1 as $key => $value) {
			$isi['number'] = $no++.'.';
			$isi['nama'] = $value->fullname;
			$isi['username'] = $value->username;
			$isi['total_login'] = number_format($value->total_login,0).'x';
			$pecah_tanggal = explode(' ',$value->last_activity);
			$isi['last_activity'] = $this->Main_model->convert_tanggal($pecah_tanggal[0]).' '.substr($pecah_tanggal[1],0,5);
			$return_on_click = "return confirm('Anda yakin?')";
			$isi['action'] =	'
				<span class="dropdown">
					<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="false">
					<i class="la la-ellipsis-h"></i>
					</a>
					
					<div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="display: none; position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 5px, 0px);" x-out-of-boundaries="">
						<a class="dropdown-item" href="'.site_url('admin_side/ubah_data_petugas/'.md5($value->id)).'"><i class="la la-edit"></i> Ubah Data</a>
						<a class="dropdown-item" onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_data_petugas/'.md5($value->id)).'"><i class="la la-trash"></i> Hapus Data</a>
						<hr>
						<a class="dropdown-item" href="'.site_url('admin_side/atur_ulang_kata_sandi_petugas/'.md5($value->id)).'"><i class="la la-refresh"></i> Atur Ulang Sandi</a>
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
	public function add_member_data()
	{
		$data['parent'] = 'master_member';
		$data['child'] = '';
		$data['grand_child'] = '';
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/add_member_data',$data);
		$this->load->view('admin/template/footer');
	}
	public function save_member_data()
	{
		$cek_ = $this->Main_model->getSelectedData('user a', 'a.*',array('a.username'=>$this->input->post('un')))->row();
		if($cek_==NULL){
			$this->db->trans_start();
			$get_user_id = $this->Main_model->getLastID('user','id');

			$data_insert1 = array(
				'id' => $get_user_id['id']+1,
				'username' => $this->input->post('un'),
				'pass' => $this->input->post('ps'),
				'fullname' => $this->input->post('nama'),
				'is_active' => '1',
				'created_by' => $this->session->userdata('id'),
				'created_at' => date('Y-m-d H:i:s')
			);
			$this->Main_model->insertData('user',$data_insert1);
			// print_r($data_insert1);

			$data_insert2 = array(
				'user_id' => $get_user_id['id']+1,
				'role_id' => '2'
			);
			$this->Main_model->insertData('user_to_role',$data_insert2);
			// print_r($data_insert2);

			$data_insert3 = array(
				'user_id' => $get_user_id['id']+1,
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'no_hp' => $this->input->post('no_hp'),
				'email' => $this->input->post('email'),
				'nip' => $this->input->post('nip'),
				'jabatan' => $this->input->post('jabatan')
			);
			$this->Main_model->insertData('petugas',$data_insert3);
			// print_r($data_insert3);

			$this->Main_model->log_activity($this->session->userdata('id'),'Adding data',"Menambahkan data Petugas (".$this->input->post('nama').")",$this->session->userdata('location'));
			$this->db->trans_complete();
			if($this->db->trans_status() === false){
				$this->session->set_flashdata('gagal','<div class="alert alert-warning fade show" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text"><strong>Oops! </strong>Data gagal ditambahkan.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
				echo "<script>window.location='".base_url()."admin_side/tambah_data_petugas/'</script>";
			}
			else{
				$this->session->set_flashdata('sukses','<div class="alert alert-success fade show" role="alert"><div class="alert-icon"><i class="flaticon2-checkmark"></i></div><div class="alert-text"><strong></i>Yeah! </strong>Data telah berhasil ditambahkan.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
				echo "<script>window.location='".base_url()."admin_side/data_petugas'</script>";
			}
		}else{
			$this->session->set_flashdata('gagal','<div class="alert alert-warning fade show" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text"><strong>Oops! </strong>Username telah digunakan.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/tambah_data_petugas/'</script>";
		}
	}
	public function edit_member_data()
	{
		$data['parent'] = 'master_member';
		$data['child'] = '';
		$data['grand_child'] = '';
		$data['data_utama'] = $this->Main_model->getSelectedData('user a', 'a.id,a.fullname,a.username,b.*', array('md5(a.id)'=>$this->uri->segment(3),'a.deleted'=>'0'), '', '', '', '', array(
			'table' => 'petugas b',
			'on' => 'a.id=b.user_id',
			'pos' => 'LEFT'
		))->row();
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/edit_member_data',$data);
		$this->load->view('admin/template/footer');
	}
	public function update_member_data()
	{
		$this->db->trans_start();
		if($this->input->post('ps')=='' OR $this->input->post('ps')==NULL){
			$data_insert1 = array(
				'fullname' => $this->input->post('nama')
			);
		}else{
			$data_insert1 = array(
				'pass' => $this->input->post('ps'),
				'fullname' => $this->input->post('nama')
			);
		}
		$this->Main_model->updateData('user',$data_insert1,array('md5(id)'=>$this->input->post('user_id')));
		// print_r($data_insert1);

		$data_insert2 = array(
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'no_hp' => $this->input->post('no_hp'),
			'email' => $this->input->post('email'),
			'nip' => $this->input->post('nip'),
			'jabatan' => $this->input->post('jabatan')
		);
		$this->Main_model->updateData('petugas',$data_insert2,array('md5(user_id)'=>$this->input->post('user_id')));
		// print_r($data_insert2);

		$this->Main_model->log_activity($this->session->userdata('id'),'Updating data',"Mengubah data Petugas (".$this->input->post('nama').")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning fade show" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text"><strong>Oops! </strong>Data gagal diubah.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/ubah_data_petugas/".$this->input->post('user_id')."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success fade show" role="alert"><div class="alert-icon"><i class="flaticon2-checkmark"></i></div><div class="alert-text"><strong></i>Yeah! </strong>Data telah berhasil diubah.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_petugas/'</script>";
		}
	}
	public function reset_password_member_account()
	{
		$this->db->trans_start();
		$user_id = '';
		$name = '';
		$get_data = $this->Main_model->getSelectedData('user a', 'a.*',array('md5(a.id)'=>$this->uri->segment(3)))->row();
		$user_id = $get_data->id;
		$name = $get_data->fullname;

		$this->Main_model->updateData('user',array('pass'=>'12345'),array('id'=>$user_id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Updating data","Mengatur ulang kata sandi (".$name.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning fade show" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text"><strong>Oops! </strong>Data gagal diubah.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_petugas/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success fade show" role="alert"><div class="alert-icon"><i class="flaticon2-checkmark"></i></div><div class="alert-text"><strong></i>Yeah! </strong>Data telah berhasil diubah.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_petugas'</script>";
		}
	}
	public function delete_member_data()
	{
		$this->db->trans_start();
		$user_id = '';
		$name = '';
		$get_data = $this->Main_model->getSelectedData('user a', 'a.*',array('md5(a.id)'=>$this->uri->segment(3)))->row();
		$user_id = $get_data->id;
		$name = $get_data->fullname;

		$this->Main_model->deleteData('petugas',array('user_id'=>$user_id));
		$this->Main_model->deleteData('user_to_role',array('user_id'=>$user_id));
		$this->Main_model->deleteData('user',array('id'=>$user_id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus data akun Petugas (".$name.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning fade show" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text"><strong>Oops! </strong>Data gagal dihapus.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_petugas/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success fade show" role="alert"><div class="alert-icon"><i class="flaticon2-checkmark"></i></div><div class="alert-text"><strong></i>Yeah! </strong>Data telah berhasil dihapus.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_petugas/'</script>";
		}
	}
	/* Kegiatan */
	public function jadwal_kegiatan()
	{
		$data['parent'] = 'master_kegiatan';
		$data['child'] = 'jadwal_kegiatan';
		$data['grand_child'] = '';
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/jadwal_kegiatan',$data);
		$this->load->view('admin/template/footer');
	}
	public function json_jadwal_kegiatan()
	{
		$get_data1 = $this->Main_model->getSelectedData('jadwal_kegiatan a', 'a.*')->result();
		$data_tampil = array();
		$no = 1;
		foreach ($get_data1 as $key => $value) {
			$isi['number'] = $no++.'.';
			$isi['kegiatan'] = $value->kegiatan;
			$isi['tgl'] = $this->Main_model->convert_tanggal(date('Y-m-d', strtotime($value->tanggal)));
			$isi['lokasi'] = $value->lokasi;
			$return_on_click = "return confirm('Anda yakin?')";
			$isi['action'] =	'
				<span class="dropdown">
					<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="false">
					<i class="la la-ellipsis-h"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="display: none; position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 5px, 0px);" x-out-of-boundaries="">
						<a class="dropdown-item" href="'.site_url('admin_side/ubah_jadwal_kegiatan/'.md5($value->id_jadwal_kegiatan)).'"><i class="la la-edit"></i> Ubah Data</a>
						<a class="dropdown-item" onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_jadwal_kegiatan/'.md5($value->id_jadwal_kegiatan)).'"><i class="la la-trash"></i> Hapus Data</a>
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
	public function timeline_kegiatan()
	{
		$data['parent'] = 'master_kegiatan';
		$data['child'] = 'timeline_kegiatan';
		$data['grand_child'] = '';
		$data['events'] = $this->Main_model->getSelectedData('jadwal_kegiatan a', 'a.*')->result_array();
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/timeline_kegiatan',$data);
		$this->load->view('admin/template/footer');
	}
	public function tambah_jadwal_kegiatan()
	{
		$data['parent'] = 'master_kegiatan';
		$data['child'] = 'jadwal_kegiatan';
		$data['grand_child'] = '';
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/tambah_jadwal_kegiatan',$data);
		$this->load->view('admin/template/footer');
	}
	public function simpan_data_timeline()
	{
		$this->db->trans_start();
		$hex_string = '';
		$nmfile = "file_".time(); // nama file saya beri nama langsung dan diikuti fungsi time
		$config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]).'/data_upload/surat/'; // path folder
		$config['allowed_types'] = 'jpg|png|jpeg|bmp'; // type yang dapat diakses bisa anda sesuaikan
		$config['max_size'] = '3072'; // mActionmum besar file 3M
		$config['max_width']  = '5000'; // lebar mActionmum 5000 px
		$config['max_height']  = '5000'; // tinggi mActionmu 5000 px
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
				$upload = base_url().'data_upload/surat/'.$gbr['file_name'];
				$bin_string = file_get_contents($upload);
				$hex_string = base64_encode($bin_string);
			}
		}else{echo'';}
		if($this->input->post('from')=='jadwal_kegiatan'){
			$data_insert1 = array(
				'direktorat' => $this->input->post('direktorat'),
				'subdirektorat' => $this->input->post('subdirektorat'),
				'kegiatan' => $this->input->post('kegiatan'),
				'tanggal' => $this->input->post('tanggal'),
				'tanggal_selesai' => $this->input->post('tanggal'),
				'lokasi' => $this->input->post('lokasi'),
				'peserta' => $this->input->post('peserta'),
				'surat' => $hex_string,
				'created_by' => $this->session->userdata('id'),
				'created_at' => date('Y-m-d H:i:s')
			);
		}else{
			$data_insert1 = array(
				'direktorat' => $this->input->post('direktorat'),
				'subdirektorat' => $this->input->post('subdirektorat'),
				'kegiatan' => $this->input->post('kegiatan'),
				'tanggal' => $this->input->post('tanggal'),
				'tanggal_selesai' => $this->input->post('tanggal_selesai'),
				'lokasi' => $this->input->post('lokasi'),
				'peserta' => $this->input->post('peserta'),
				'surat' => $hex_string,
				'color' => $this->input->post('color'),
				'created_by' => $this->session->userdata('id'),
				'created_at' => date('Y-m-d H:i:s')
			);
		}
		$this->Main_model->insertData('jadwal_kegiatan',$data_insert1);
		// print_r($data_insert1);

		$this->Main_model->log_activity($this->session->userdata('id'),'Adding data',"Menambah data jadwal kegiatan (".$this->input->post('kegiatan').")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			if($this->input->post('from')=='beranda'){
				$this->session->set_flashdata('gagal','<div class="alert alert-warning fade show" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text"><strong>Oops! </strong>Data gagal diubah.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
				echo "<script>window.location='".base_url()."admin_side/beranda/'</script>";
			}elseif($this->input->post('from')=='timeline_kegiatan'){
				$this->session->set_flashdata('gagal','<div class="alert alert-warning fade show" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text"><strong>Oops! </strong>Data gagal diubah.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
				echo "<script>window.location='".base_url()."admin_side/timeline_kegiatan/'</script>";
			}else{
				$this->session->set_flashdata('gagal','<div class="alert alert-warning fade show" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text"><strong>Oops! </strong>Data gagal diubah.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
				echo "<script>window.location='".base_url()."admin_side/tambah_jadwal_kegiatan/'</script>";
			}
		}
		else{
			if($this->input->post('from')=='beranda'){
				$this->session->set_flashdata('sukses','<div class="alert alert-success fade show" role="alert"><div class="alert-icon"><i class="flaticon2-checkmark"></i></div><div class="alert-text"><strong></i>Yeah! </strong>Data telah berhasil diubah.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
				echo "<script>window.location='".base_url()."admin_side/beranda/'</script>";
			}elseif($this->input->post('from')=='timeline_kegiatan'){
				$this->session->set_flashdata('sukses','<div class="alert alert-success fade show" role="alert"><div class="alert-icon"><i class="flaticon2-checkmark"></i></div><div class="alert-text"><strong></i>Yeah! </strong>Data telah berhasil diubah.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
				echo "<script>window.location='".base_url()."admin_side/timeline_kegiatan/'</script>";
			}else{
				$this->session->set_flashdata('sukses','<div class="alert alert-success fade show" role="alert"><div class="alert-icon"><i class="flaticon2-checkmark"></i></div><div class="alert-text"><strong></i>Yeah! </strong>Data telah berhasil diubah.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
				echo "<script>window.location='".base_url()."admin_side/jadwal_kegiatan/'</script>";
			}
		}
	}
	public function perbarui_data_timeline()
	{
		$this->db->trans_start();
		if ($this->input->post('delete')!=NULL AND $this->input->post('id')!=NULL){
			$id = $this->input->post('id');
			
			$sql = "DELETE FROM jadwal_kegiatan WHERE id_jadwal_kegiatan = $id";
			$this->db->query($sql);
		
		}elseif ($this->input->post('title')!=NULL AND $this->input->post('color')!=NULL AND $this->input->post('id')!=NULL){
		
			$id = $this->input->post('id');
			$title = $this->input->post('title');
			$direktorat = $this->input->post('direktorat');
			$subdirektorat = $this->input->post('subdirektorat');
			$tanggal = $this->input->post('tanggal');
			$lokasi = $this->input->post('lokasi');
			$peserta = $this->input->post('peserta');
			$color = $this->input->post('color');
			
			$sql = "UPDATE jadwal_kegiatan SET direktorat = '$direktorat', subdirektorat = '$subdirektorat', kegiatan = '$title', tanggal = '$tanggal', tanggal_selesai = '$tanggal', lokasi = '$lokasi', peserta='$peserta', color = '$color' WHERE id_jadwal_kegiatan = $id ";

			$this->db->query($sql);

		}else{
			echo'';
		}
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			if($this->input->post('from')=='beranda'){
				$this->session->set_flashdata('gagal','<div class="alert alert-warning fade show" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text"><strong>Oops! </strong>Data gagal diubah.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
				echo "<script>window.location='".base_url()."admin_side/timeline_kegiatan/'</script>";
			}elseif($this->input->post('from')=='timeline_kegiatan'){
				$this->session->set_flashdata('gagal','<div class="alert alert-warning fade show" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text"><strong>Oops! </strong>Data gagal diubah.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
				echo "<script>window.location='".base_url()."admin_side/timeline_kegiatan/'</script>";
			}else{
				echo'';
			}
		}
		else{
			if($this->input->post('from')=='beranda'){
				$this->session->set_flashdata('sukses','<div class="alert alert-success fade show" role="alert"><div class="alert-icon"><i class="flaticon2-checkmark"></i></div><div class="alert-text"><strong></i>Yeah! </strong>Data telah berhasil diubah.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
				echo "<script>window.location='".base_url()."admin_side/timeline_kegiatan/'</script>";
			}elseif($this->input->post('from')=='timeline_kegiatan'){
				$this->session->set_flashdata('sukses','<div class="alert alert-success fade show" role="alert"><div class="alert-icon"><i class="flaticon2-checkmark"></i></div><div class="alert-text"><strong></i>Yeah! </strong>Data telah berhasil diubah.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
				echo "<script>window.location='".base_url()."admin_side/timeline_kegiatan/'</script>";
			}else{
				echo'';
			}
		}
	}
	public function ubah_jadwal_kegiatan()
	{
		$data['parent'] = 'master_kegiatan';
		$data['child'] = 'jadwal_kegiatan';
		$data['grand_child'] = '';
		$data['data_utama'] = $this->Main_model->getSelectedData('jadwal_kegiatan a', 'a.*', array('md5(a.id_jadwal_kegiatan)'=>$this->uri->segment(3)))->row();
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/ubah_jadwal_kegiatan',$data);
		$this->load->view('admin/template/footer');
	}
	public function perbarui_jadwal_kegiatan()
	{
		$this->db->trans_start();
		$nmfile = "file_".time(); // nama file saya beri nama langsung dan diikuti fungsi time
		$config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]).'/data_upload/surat/'; // path folder
		$config['allowed_types'] = 'jpg|png|jpeg|bmp'; // type yang dapat diakses bisa anda sesuaikan
		$config['max_size'] = '3072'; // mActionmum besar file 3M
		$config['max_width']  = '5000'; // lebar mActionmum 5000 px
		$config['max_height']  = '5000'; // tinggi mActionmu 5000 px
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
				$upload = base_url().'data_upload/surat/'.$gbr['file_name'];
				$bin_string = file_get_contents($upload);
				$hex_string = base64_encode($bin_string);
				$this->Main_model->updateData('jadwal_kegiatan',array('surat'=>$hex_string),array('md5(id_jadwal_kegiatan)'=>$this->input->post('id')));
			}
		}else{echo'';}
		$data_insert1 = array(
			'direktorat' => $this->input->post('direktorat'),
			'subdirektorat' => $this->input->post('subdirektorat'),
			'kegiatan' => $this->input->post('kegiatan'),
			'tanggal' => $this->input->post('tanggal'),
			'tanggal_selesai' => $this->input->post('tanggal'),
			'lokasi' => $this->input->post('lokasi'),
			'peserta' => $this->input->post('peserta')
		);
		$this->Main_model->updateData('jadwal_kegiatan',$data_insert1,array('md5(id_jadwal_kegiatan)'=>$this->input->post('id')));
		// print_r($data_insert1);

		$this->Main_model->log_activity($this->session->userdata('id'),'Updating data',"Mengubah data jadwal kegiatan (".$this->input->post('kegiatan').")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning fade show" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text"><strong>Oops! </strong>Data gagal diubah.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/ubah_jadwal_kegiatan/".$this->input->post('id')."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success fade show" role="alert"><div class="alert-icon"><i class="flaticon2-checkmark"></i></div><div class="alert-text"><strong></i>Yeah! </strong>Data telah berhasil diubah.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/jadwal_kegiatan/'</script>";
		}
	}
	public function hapus_jadwal_kegiatan()
	{
		$this->db->trans_start();
		$_id = '';
		$name = '';
		$get_data = $this->Main_model->getSelectedData('jadwal_kegiatan a', 'a.*',array('md5(a.id_jadwal_kegiatan)'=>$this->uri->segment(3)))->row();
		$_id = $get_data->id_jadwal_kegiatan;
		$name = $get_data->kegiatan;

		$this->Main_model->deleteData('jadwal_kegiatan',array('id_jadwal_kegiatan'=>$_id));
		$q_d = "DELETE a.*,b.* FROM laporan_kegiatan a LEFT JOIN foto_laporan_kegiatan b ON a.id_laporan_kegiatan=b.id_laporan_kegiatan WHERE a.id_kegiatan='".$_id."'";
		$this->db->query($q_d);

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus data jadwal kegiatan (".$name.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning fade show" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text"><strong>Oops! </strong>Data gagal dihapus.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/jadwal_kegiatan/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success fade show" role="alert"><div class="alert-icon"><i class="flaticon2-checkmark"></i></div><div class="alert-text"><strong></i>Yeah! </strong>Data telah berhasil dihapus.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."admin_side/jadwal_kegiatan/'</script>";
		}
	}
	/* Other Function */
	public function ajax_page()
	{
	}
	public function ajax_function()
	{
	}
}