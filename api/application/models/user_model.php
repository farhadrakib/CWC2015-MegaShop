<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class User_model extends CI_Model {
 
   function __construct (){
     parent::__construct();
   
   }

/*
|--------------------------------------------------------------------------
| function get_login_token
|-------------------------------------------------------------------------- 
| It will return a value which is unique .
|
*/
   
   function generate_token () {
   
      $seed = 'JvKnrQWPsThuJteNQAuH';
      $hash = sha1(uniqid($seed . mt_rand(), true));
      $random_value = substr($hash, 0, 16);
	  
	  return $random_value;
   }
   
   function register_token () {
      
	  $token =  $this->user_model->generate_token(); 
	  $data  = array ( 'token' => $token );
      $check_token =  $this->database_api->insert_data( "register_form_token", $data );
	  if ($check_token['success'] == 1) {
        		
   	      $token_data['success'] = 1;
		  $token_data['message'] = "";
		  $token_data['register_token']  = $token;
		  return json_encode ($token_data);
		  
	  } else {
	  
          $token_data['success'] = 0;
		  $token_data['message'] = "Something went wrong";
		  return json_encode ($token_data);
	  }   	  
   }
   
   function add_user ($data , $login_token) {
   
      $login_token = array ( 'token' => $login_token);
	  $token = $this->database_api->count_data ( "register_form_token" , $login_token);
      if ($token > 0) {
	  
	      $delete = $this->database_api->delete_data_value ( "register_form_token" , $login_token);
		  $insert = $this->database_api->insert_data ( "user" , $data);
          if ( $insert['success'] == 1 ) {
		    
			    $response_data['success'] = 1;
		        $response_data['message'] = "User Registered";
				
			    return json_encode($response_data);		
		  } else {
		  
		        $response_data['success'] = 0;
		        $response_data['message'] = "User not Registered";
		        
				return json_encode($response_data);	
		  } 		  
	  } else {
	  
	      $response_data['success'] = 0;
		  $response_data['message'] = "Invalid Token";
		  return json_encode($response_data);
	  
	  }  
   }
   
   function user_login ($data) {
   
      $user_count = $this->database_api->count_data ( "user" , $data);
      
	  if ( $user_count == 1 ) {
	  
	       $user_data = $this->database_api->select_data ( "user" , $data ); 
		   $response_data['user_id'] = $user_data[0]{'_id'};
		   $this->database_api->delete_data_value ( "user_token" , $response_data); #delete data from user token collection of a specific user id
		   $token_data['user_token'] = $this->user_model->generate_user_token ();   # generate e unique user token 
		   $token_data['user_id'] = $response_data['user_id'];   
		   $this->database_api->insert_data ( "user_token" , $token_data);          # save the token and user_id into user_token collection 
		   $response['success'] = 1;
		   $response['message'] = "User Successfully Logged In";
		   $response['user_token'] = $token_data['user_token'];
				
		   return json_encode($response);
	        
	  } else {
	  
	            $response_data['success'] = 0;
				$response_data['message'] = "Invalid E-mail or Password Combination";
				
				return json_encode($response_data);
	  }
   }
   
   
   function generate_user_token () {
   
      $seed = 'JvKnrQWPsThuJteNQAuHsdfeerfsdfUFHG';
      $hash = sha1(uniqid($seed . mt_rand(), true));
      $random_value = substr($hash, 0, 32);
	  
	  return $random_value;
   }
   
   
   function update_address ($data , $user_token) {
   
       $token['user_token'] = $user_token; 
	   $count = $this->database_api->count_data ( "user_token" , $token);
	   if ( $count == 1 ) {
	   
	       $token_data = $this->database_api->select_data ( "user_token" , $user_token ); 
		   $user_id = $token_data[0]['user_id'];
	       $token_data = $this->database_api->update_data ( "user" , $data , $user_id) ; 
		   if ( $token_data ) {
		        
                $response['success'] = 1;
			    $response['message'] = "Basic Info Updated";  				
				 
				 return json_encode($response);
				 
		   } else {
		   
		        $response['success'] = 0;
			    $response['message'] = "Basic Info Updated";  				
				 
				return json_encode($response);

		   }	
	   } else {
	     
	        $response['success'] = 0;
			$response['message'] = "Invalid Token";
			
	        return json_encode($response);
	   } 
   }
   
   function update_basic_info ($data , $user_token) {
   
       $token['user_token'] = $user_token; 
	   $count = $this->database_api->count_data ( "user_token" , $token);
	   if ( $count == 1 ) {
	   
	       $token_data = $this->database_api->select_data ( "user_token" , $user_token ); 
		   $user_id = $token_data[0]['user_id'];
	       $token_data = $this->database_api->update_data ( "user" , $data , $user_id) ; 
		   if ( $token_data ) {
		        
                $response['success'] = 1;
			    $response['message'] = "Basic Info Updated";  				
				 
				 return json_encode($response);
				 
		   } else {
		   
		        $response['success'] = 0;
			    $response['message'] = "Basic Info Updated";  				
				 
				return json_encode($response);

		   }	
	   } else {
	     
	        $response['success'] = 0;
			$response['message'] = "Invalid Token";
			
	        return json_encode($response);
	   } 
   }
   
   
   function logout ($data) {
   
      $delete = $this->database_api->delete_data_value ( "user_token" , $data);
	  
	  if ( $delete ) {
	  
	       $response['success'] = 1;
		   $response['message'] = "User Logged Out";
		   
		   return json_encode($response);
	  
	  } else {
	  
	       $response['success'] = 0;
		   $response['message'] = "something went wrong.";
		   
		   return json_encode($response);
	      
	  }
 
   }
   
   function get_user_info ($data) {
   
      $count = $this->database_api->count_data ( "user_token" , $data);
	  
	  if ( $count == 1 ) {
	  
	       $token_data = $this->database_api->select_data ( "user_token" , $data ); 
		   $user_data['_id'] = $token_data[0]['user_id'];
	       $response = $this->database_api->select_data ( "user" , $user_data ) ; 
	       
		   
		   return json_encode($response);
	  
	  } else {
	  
	       $response['success'] = 0;
		   $response['message'] = "Invalid Token";
			
	       return json_encode($response);
		   
	  } 
   }
   
   function check_email( $data ) {
   
      $count = $this->database_api->count_data ( "user" , $data);
	  
	  if ( $count == 1 ) {
	  
	       $response['success'] = 0;
		   $response['message'] = "Email Already Taken"; 
	       
		   return json_encode($response);
	  
	  } else {
	  
	       $response['success'] = 1;
		   $response['message'] = "Email Available";
			
	       return json_encode($response);
		   
	  }
   }

}