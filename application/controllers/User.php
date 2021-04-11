<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 * 
 * @extends CI_Controller
 */
class User extends CI_Controller {

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
		$this->load->model('karyawan_model');
		$this->load->library('form_validation');
		
	}
	
	
	public function index() {
		$this->karyawan_model->data();
		dd($this->session->all_userdata());
	}
	
	public function login() {
		
		// create the data object
		$data = new stdClass();
		
		// set validation rules
		$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == false) {
			
			// validation not ok, send validation errors to the view
			$this->load->view('header');
			$this->load->view('user/login/login');
			$this->load->view('footer');
			
		} else {
			
			// set variables from the form
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$resolve_user =  $this->user_model->resolve_user_login($username, $password);
			if ($resolve_user['msg'] == 'SUCCESS') {
				// set session user datas
				$this->session->set_userdata('user_id',(string)$resolve_user['karyawan_id']);
				$this->session->set_userdata('username',(string)$resolve_user['name']);
				$this->session->set_userdata('token',(string)$resolve_user['token']);
				$this->session->set_userdata('logged_in',(bool)true);
				$this->session->set_userdata('is_confirmed',(bool)true);
				$this->session->set_userdata('is_admin',(bool)true);
				
				// user login ok
				$this->load->view('header');
				$this->load->view('user/login/login_success', $data);
				$this->load->view('footer');
				
			} else {
				
				// login failed
				$data->error = 'Wrong username or password.';
				
				// send error to the view
				$this->load->view('header');
				$this->load->view('user/login/login', $data);
				$this->load->view('footer');
				
			}
			
		}
		
	}
	
	/**
	 * logout function.
	 * 
	 * @access public
	 * @return void
	 */
	public function logout() {
		// create the data object
		$data = new stdClass();
		$resolve_user = $this->user_model->resolve_user_logout();
		if ($resolve_user == 'OK') {
		
			// remove session datas
			foreach ($_SESSION as $key => $value) {
				unset($_SESSION[$key]);
			}
			
			// user logout ok
			redirect('user/login');
			
		} else {
			
			// remove session datas
			foreach ($_SESSION as $key => $value) {
				unset($_SESSION[$key]);
			}
			
			// user logout ok
			redirect('user/login');
			
		}
		
	}
	
}
