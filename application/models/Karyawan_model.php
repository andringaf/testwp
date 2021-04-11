<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class Karyawan_model extends CI_Model {

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		
		parent::__construct();
		
	}
	
	public function data() {
		$ci =& get_instance();       
        $ci->curl->create(url_api("user-service/user/list/0/10")); 

        // Option
       
        $this->curl->option(CURLOPT_HTTPHEADER, array(            
            'Authorization: Bearer ' .$this->session->userdata('token'),
        ));    
              
        // Execute - returns responce
        $result = $this->curl->execute();
        $data = json_decode($result,TRUE);
        return $data;
	
	}
    public function detail($id) {
        $ci =& get_instance();       
        $ci->curl->create(url_api("user-service/user/".$id)); 

        // Option
       
        $this->curl->option(CURLOPT_HTTPHEADER, array(            
            'Authorization: Bearer ' .$this->session->userdata('token'),
        ));    
              
        // Execute - returns responce
        $result = $this->curl->execute();
        $data = json_decode($result,TRUE);
        return $data;
    
    }
    public function create_karyawan($data) {
        $ci =& get_instance();        
        $jsonDataEncoded = json_encode($data);   
        $ci->curl->create(url_api("user-service/user/")); 
        // Option
        $this->curl->option(CURLOPT_HTTPHEADER, array(    
            'Content-type: application/json; Charset=UTF-8',          
            'Authorization: Bearer ' .$this->session->userdata('token'),
        ));    

        // Post - If you do not use post, it will just run a GET request
        $this->curl->post($jsonDataEncoded);  
              
        // Execute - returns responce
        $result = $this->curl->execute();
        $data = json_decode($result,TRUE);
        return ($data);
    
    }
    public function seacrh_data($key) {
        $ci =& get_instance();        
        $jsonDataEncoded = json_encode(['keyword'=> $key]);  
        $ci->curl->create(url_api("user-service/user/search")); 

        // Option
        $this->curl->option(CURLOPT_HTTPHEADER, array(  
            'Content-type: application/json; Charset=UTF-8',          
            'Authorization: Bearer ' .$this->session->userdata('token'),
        ));    

        // Post - If you do not use post, it will just run a GET request
        $this->curl->post($jsonDataEncoded);  
              
        // Execute - returns responce
        $result = $this->curl->execute();
        $data = json_decode($result,TRUE);
        return $data;
        
    }
    public function data_divisi() {
        $ci =& get_instance();       
        $ci->curl->create(url_api("hrd-service/divisi/list/0/10")); 

        // Option
       
        $this->curl->option(CURLOPT_HTTPHEADER, array(            
            'Authorization: Bearer ' .$this->session->userdata('token'),
        ));    
              
        // Execute - returns responce
        $result = $this->curl->execute();
        $data = json_decode($result,TRUE);
        return $data;
    
    }
    public function data_jabatan() {
        $ci =& get_instance();       
        $ci->curl->create(url_api("hrd-service/jabatan/list/0/10")); 

        // Option
       
        $this->curl->option(CURLOPT_HTTPHEADER, array(            
            'Authorization: Bearer ' .$this->session->userdata('token'),
        ));    
              
        // Execute - returns responce
        $result = $this->curl->execute();
        $data = json_decode($result,TRUE);
        return $data;
    
    }
    

}
