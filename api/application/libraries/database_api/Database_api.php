<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class Database_api {

        private $_inserted_id = FALSE;
        public $debug = FALSE;
       
        
        public function __construct() {
                 
        }
        
		public function insert_data ( $collection , $values = array() ) {
		
		       if (empty($collection)) {
			    return "Collection name is Emprty"; 
			   }
			   $CI = &get_instance();
			   $is_insert = $CI->cimongo->insert ($collection , $values);
			   
			   if ($is_insert) {
			   
                  	$data['message'] = "Value Inserted";		   
			        $insert_id = $CI->cimongo->insert_id();
					$data['id'] = $insert_id->{'$id'};
					$data['success'] = 1;
					
			   } else {
			        
			        $data['success'] = 0 ; 
			        $data['message'] = "Something went wrong . Vlaue is not inserted";
			   }
			   
			   return $data; 
		}
		
		public function count_data ( $collection , $data = array()){
		
		        $CI = &get_instance();
				$count = $CI->cimongo->where($data)->count_all_results ($collection);
				return $count;
		
		}
		
		public function select_data ( $collection , $where_clause = array() ) {
		        $CI = &get_instance();
		        $data = $CI->cimongo->where($where_clause)->get ($collection);
		        return $data->result_array();      
		}
		
		public function select_data_limit ($collection ,$field ,$limit) {
		
		        $CI = &get_instance();
		        $data = $CI->cimongo->get_where($collection ,'_id', $limit ,false);
		        return $data->result_array();
		}
		
		public function delete_data_id ( $collection , $id) {
		        $CI = &get_instance();
				$id = new MongoId($id);
                $is_delete = $CI->cimongo->where(array('_id'=> $id))->delete($collection);
				
				if ($is_delete) {
				
				    return TRUE; 
				} else {
				
				    return FALSE;
				}
		}
		
		public function update_data ($collection , $update_data , $id) {
		        $CI = &get_instance();
				$id = new MongoId($id);
		        $is_update = $CI->cimongo->where(array('_id'=> $id))->update($collection , $update_data , array());
				
				if ($is_update) {
				
				    return TRUE; 
				} else {
				
				    return FALSE;
				} 
		}
		
		public function delete_data_value ( $collection , $data) {
		        $CI = &get_instance();
                $is_delete = $CI->cimongo->where($data)->delete($collection);
				
				if ($is_delete) {
				
				    return TRUE; 
				} else {
				
				    return FALSE;
				}
		}
}
