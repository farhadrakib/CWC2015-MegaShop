<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . '/controllers/test/Toast.php');

class Unit_testing extends Toast {
    
	function Unit_testing()
	{
	   parent::Toast(__FILE__);
	}	
	

	function test_register_token()
	{
		$my_var = 2 + 2;
		$this->_assert_equals($my_var, 4);
	
	}

}
