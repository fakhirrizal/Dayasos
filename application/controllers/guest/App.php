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
		$this->load->view('guest/template/header',$data);
		$this->load->view('guest/app/home',$data);
		$this->load->view('guest/template/footer',$data);
	}
	public function about()
	{
		$data['parent'] = 'versioning_aplikasi';
		$data['child'] = '';
		$data['grand_child'] = '';
		$this->load->view('guest/template/header',$data);
		$this->load->view('guest/app/about',$data);
		$this->load->view('guest/template/footer');
	}
	public function helper()
	{
		$data['parent'] = 'helper';
		$data['child'] = '';
		$data['grand_child'] = '';
		$this->load->view('guest/template/header',$data);
		$this->load->view('guest/app/helper',$data);
		$this->load->view('guest/template/footer');
	}
}