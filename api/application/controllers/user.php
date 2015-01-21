<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
    
	function __construct() {
        parent::__construct();
		$this->load->model('user_model');
	
	}	
	public function register_token()
	{
	    echo $this->user_model->register_token();	
	}
	
	public function add_user ()
	{
	   $obj = json_decode(file_get_contents('php://input'));
	   $login_token = $obj->{'register_token'};
	   $data['first_name'] = $obj->{'first_name'};
	   $data['last_name'] = $obj->{'last_name'};
	   $data['email'] = $obj->{'email'};
	   $data['passsword'] = $obj->{'password'};
	   $data['phone'] = $obj->{'phone'};
       
       $data['address1'] = $obj->{'address1'}; 
       $data['address2'] = $obj->{'address2'};
       $data['city'] = $obj->{'city'};
       $data['country'] = $obj->{'country'};
	   
	   echo $this->user_model->add_user ($data , $login_token);
	   
	}
	
	public function update_basic_info ()
	{
	   $obj = json_decode(file_get_contents('php://input'));
	   $user_token = $obj->{'user_token'};
	   $data['first_name'] = $obj->{'first_name'};
	   $data['last_name'] = $obj->{'last_name'};
	   $data['email'] = $obj->{'email'};
	   $data['password'] = $obj->{'password'};
	   $data['phone'] = $obj->{'phone'};
	   
	   echo $this->user_model->update_basic_info ($data , $user_token);
	}
	
	public function update_address () 
	{  
	   $obj = json_decode(file_get_contents('php://input'));
	   $user_token = $obj->{'user_token'};
	   $data['address1'] = $obj->{'address1'};
	   $data['address2'] = $obj->{'address2'};
	   $data['city'] = $obj->{'city'};
	   $data['country'] = $obj->{'country'};
	   
	   echo $this->user_model->update_address ($data , $user_token);
	
	
	}
	
	public function login ()
	{
	   $obj = json_decode(file_get_contents('php://input')); 
	   $data['email'] = $obj->{'email'};
	   $data['passsword'] = $obj->{'password'};
	   
	   echo $this->user_model->user_login ($data);
	
	}

	public function logout ()
	{
	   $obj = json_decode(file_get_contents('php://input')); 
	   $data['user_token'] = $obj->{'user_token'};
	   
	   echo $this->user_model->logout ($data);
	  
	}
	
	public function get_user_info ()
	{
	   $obj = json_decode(file_get_contents('php://input')); 
	   $data['user_token'] = $obj->{'user_token'};
	
	   echo $this->user_model->get_user_info( $data );
	}
	
	public function check_email_exist ()
	{
	   $obj = json_decode(file_get_contents('php://input')); 
	   $data['email'] = $obj->{'email'};
	   
	   echo $this->user_model->check_email( $data );
	
	}
}
