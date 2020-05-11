<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    public function laporan_kegiatan()
	{
		$data['parent'] = 'master_kegiatan';
		$data['child'] = 'laporan_kegiatan';
		$data['grand_child'] = '';
		$this->load->view('spv/template/header',$data);
		$this->load->view('spv/report/laporan_kegiatan',$data);
		$this->load->view('spv/template/footer',$data);
	}
	public function json_laporan_kegiatan()
	{
		$get_data1 = $this->Main_model->getSelectedData('laporan_kegiatan a', 'a.*,b.kegiatan,c.fullname', '', '', '', '', '', array(
            array(
                'table' => 'jadwal_kegiatan b',
				'on' => 'a.id_kegiatan=b.id_jadwal_kegiatan',
				'pos' => 'LEFT'
            ),
            array(
                'table' => 'user c',
				'on' => 'a.created_by=c.id',
				'pos' => 'LEFT'
            )
        ))->result();
		$data_tampil = array();
		$no = 1;
		foreach ($get_data1 as $key => $value) {
			$isi['number'] = $no++.'.';
			$isi['unit'] = $value->unit;
			$isi['kegiatan'] = $value->kegiatan;
			$isi['pelapor'] = $value->fullname;
			$isi['tanggal_lapor'] = $this->Main_model->convert_datetime($value->created_at);
			$return_on_click = "return confirm('Anda yakin?')";
			$isi['action'] =	'
				<span class="dropdown">
					<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="false">
					<i class="la la-ellipsis-h"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="display: none; position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 5px, 0px);" x-out-of-boundaries="">
						<a class="dropdown-item" href="'.site_url('spv_side/detail_laporan_kegiatan/'.md5($value->id_laporan_kegiatan)).'"><i class="la la-edit"></i> Detil Data</a>
						<a class="dropdown-item" onclick="'.$return_on_click.'" href="'.site_url('spv_side/hapus_laporan_kegiatan/'.md5($value->id_laporan_kegiatan)).'"><i class="la la-trash"></i> Hapus Data</a>
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
    public function tambah_laporan_kegiatan()
	{
		$data['parent'] = 'master_kegiatan';
		$data['child'] = 'laporan_kegiatan';
		$data['grand_child'] = '';
		$data['keg'] = $this->Main_model->getSelectedData('jadwal_kegiatan a', 'a.*')->result();
		$this->load->view('spv/template/header',$data);
		$this->load->view('spv/report/tambah_laporan_kegiatan',$data);
		$this->load->view('spv/template/footer');
    }
    public function simpan_laporan_kegiatan()
	{
        $this->db->trans_start();
		$datakeg = $this->Main_model->getSelectedData('jadwal_kegiatan a', 'a.*', array('a.id_jadwal_kegiatan'=>$this->input->post('id_kegiatan')))->row();
        $get_last_id = $this->Main_model->getLastID('laporan_kegiatan','id_laporan_kegiatan');

        $data_insert1 = array(
            'id_laporan_kegiatan' => $get_last_id['id_laporan_kegiatan']+1,
            'unit' => $this->input->post('unit'),
            'id_kegiatan' => $this->input->post('id_kegiatan'),
            'keterangan' => $this->input->post('ket'),
            'created_by' => $this->session->userdata('id'),
            'created_at' => date('Y-m-d H:i:s')
        );
        $this->Main_model->insertData('laporan_kegiatan',$data_insert1);
		// print_r($data_insert1);
		$count = count($_FILES['files']['name']);
		
		for($i=0;$i<$count;$i++){
		
			if(!empty($_FILES['files']['name'][$i])){
		
			$_FILES['file']['name'] = $_FILES['files']['name'][$i];
			$_FILES['file']['type'] = $_FILES['files']['type'][$i];
			$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
			$_FILES['file']['error'] = $_FILES['files']['error'][$i];
			$_FILES['file']['size'] = $_FILES['files']['size'][$i];
	
			$konfig['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]).'/data_upload/laporan_kegiatan/'; // path folder
			$konfig['allowed_types'] = 'jpg|png|jpeg|bmp'; // type yang dapat diakses bisa anda sesuaikan
			$konfig['max_size'] = '5000';
			$konfig['file_name'] = $_FILES['files']['name'][$i];
	
			$this->upload->initialize($konfig);
		
				if($this->upload->do_upload('file')){
					$uploadData = $this->upload->data();
					$upload = base_url().'data_upload/laporan_kegiatan/'.$uploadData['file_name'];
					$bin_string = file_get_contents($upload);
					$hex_string = base64_encode($bin_string);
					$this->Main_model->insertData("foto_laporan_kegiatan",array('id_laporan_kegiatan'=>$get_last_id['id_laporan_kegiatan']+1,'file'=>$hex_string,'extension'=>$uploadData['file_ext'],'keterangan'=>$this->input->post('keterangan_foto')[$i]));
				}
			}
	
		}

        $this->Main_model->log_activity($this->session->userdata('id'),'Adding data',"Menambahkan data laporan kegiatan (".$datakeg->kegiatan.")",$this->session->userdata('location'));
        $this->db->trans_complete();
        if($this->db->trans_status() === false){
            $this->session->set_flashdata('gagal','<div class="alert alert-warning fade show" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text"><strong>Oops! </strong>Data gagal ditambahkan.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
            echo "<script>window.location='".base_url()."spv_side/tambah_laporan_kegiatan/'</script>";
        }
        else{
            $this->session->set_flashdata('sukses','<div class="alert alert-success fade show" role="alert"><div class="alert-icon"><i class="flaticon2-checkmark"></i></div><div class="alert-text"><strong></i>Yeah! </strong>Data telah berhasil ditambahkan.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
            echo "<script>window.location='".base_url()."spv_side/laporan_kegiatan'</script>";
        }
	}
	public function detail_laporan_kegiatan()
	{
		$data['parent'] = 'master_kegiatan';
		$data['child'] = 'laporan_kegiatan';
		$data['grand_child'] = '';
		$data['keg'] = $this->Main_model->getSelectedData('jadwal_kegiatan a', 'a.*')->result();
		$this->load->view('spv/template/header',$data);
		$this->load->view('spv/report/detail_laporan_kegiatan',$data);
		$this->load->view('spv/template/footer');
    }
    public function hapus_laporan_kegiatan()
	{
		$this->db->trans_start();
		$_id = '';
		$name = '';
		$get_data = $this->Main_model->getSelectedData('laporan_kegiatan a', 'a.*,b.kegiatan', array('md5(a.id_laporan_kegiatan)'=>$this->uri->segment(3)), '', '', '', '', array(
            'table' => 'jadwal_kegiatan b',
            'on' => 'a.id_kegiatan=b.id_jadwal_kegiatan',
            'pos' => 'LEFT'
        ))->row();
		$_id = $get_data->id_laporan_kegiatan;
		$name = $get_data->kegiatan;

		$q_d = "DELETE a.*,b.* FROM laporan_kegiatan a LEFT JOIN foto_laporan_kegiatan b ON a.id_laporan_kegiatan=b.id_laporan_kegiatan WHERE a.id_laporan_kegiatan='".$_id."'";
		$this->db->query($q_d);

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus data laporan kegiatan (".$name.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning fade show" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text"><strong>Oops! </strong>Data gagal dihapus.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."spv_side/laporan_kegiatan/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success fade show" role="alert"><div class="alert-icon"><i class="flaticon2-checkmark"></i></div><div class="alert-text"><strong></i>Yeah! </strong>Data telah berhasil dihapus.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>' );
			echo "<script>window.location='".base_url()."spv_side/laporan_kegiatan/'</script>";
		}
	}
}