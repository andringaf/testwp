<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 * 
 * @extends CI_Controller
 */
class Karyawan extends CI_Controller {

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->model('user_model');
		$this->load->model('karyawan_model', 'karyawan');
		$this->load->library('form_validation');
		
	}
	
	
	public function index() {
		$data = [];
		if (!empty($this->input->post('keyword'))) {
			$data['keyword']= $this->input->post('keyword');
			$curl_data = $this->karyawan->seacrh_data($this->input->post('keyword'));
		}else{
			$curl_data = $this->karyawan->data();
		}
		if ($curl_data['msg'] == 'SUCCESS' ) {
			$data['data'] =  $curl_data['data'];
		}
		$this->load->view('header');
		$this->load->view('karyawan/data_karyawan', $data);
		$this->load->view('footer');
	}
	public function detail() {
		$data = [];
		$id = $this->input->post('id');
		$curl_data = $this->karyawan->detail($id);
		echo json_encode($curl_data);
	}
	public function create_karyawan(){
		$data = [];
		$data_divisi = $this->karyawan->data_divisi();
		$divisi = $this->option($data_divisi['divisi'],'divisi_id','name');
		$data_jabatan = $this->karyawan->data_jabatan();
		$jabatan = $this->option($data_jabatan['jabatan'],'jabatan_id','name');
		$data['divisi'] = $divisi;
		$data['jabatan'] = $jabatan;
		$this->load->view('header');
		$this->load->view('karyawan/create_karyawan', $data);
		$this->load->view('footer');
	}
	public function save_karyawan(){
		$data = [];
		$curl_data = $this->karyawan->create_karyawan($this->input->post());
		if ($curl_data['msg'] == 'SUCCESS' ) {
			redirect('karyawan','refresh');
		}else{
			dd($curl_data['msg']);
		}
	}
	public function option($data, $key,$value){
		$opt = [];
		if (!empty($data)) {
			# code...
			foreach ($data as $v) {
				$opt[$v[$key]] = $v[$value];
			}
		}
		return $opt;
	}
	
	
	
}
