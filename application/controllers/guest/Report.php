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
		$this->load->view('guest/template/header',$data);
		$this->load->view('guest/report/laporan_kegiatan',$data);
		$this->load->view('guest/template/footer',$data);
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
			$isi['action'] =	'
				<span class="dropdown">
					<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="false">
					<i class="la la-ellipsis-h"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="display: none; position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 5px, 0px);" x-out-of-boundaries="">
						<a class="dropdown-item" href="'.site_url('guest_side/detail_laporan_kegiatan/'.md5($value->id_laporan_kegiatan)).'"><i class="la la-edit"></i> Detil Data</a>
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
}