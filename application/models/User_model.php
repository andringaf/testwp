<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class User_model extends CI_Model {

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		
		parent::__construct();
		
	}
	
	public function resolve_user_login($username, $password) {
		$ci =& get_instance();        
        $jsonDataEncoded = json_encode(['nik'=> $username,'password' => $password]);  
        $ci->curl->create(url_api("user-service/user/login")); 

        // Option
        $this->curl->option(CURLOPT_HTTPHEADER, array(            
            'Content-type: application/json; Charset=UTF-8'
        ));    

        // Post - If you do not use post, it will just run a GET request
        $this->curl->post($jsonDataEncoded);  
              
        // Execute - returns responce
        $result = $this->curl->execute();
        $data = json_decode($result,TRUE);
        return $data;
		
	}
	public function resolve_user_logout() {
        $ci =& get_instance();        
        $jsonDataEncoded = json_encode(['user_id' =>$this->session->userdata('user_id')]);  
        $ci->curl->create(url_api("user-service/user/logout")); 

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
        return( $data);
	}

}
