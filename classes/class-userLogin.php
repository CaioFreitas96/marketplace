<?php

class UserLogin{

	public    
        $logged_in, 
        $userdata, 
        $login_error;
       
	protected        
        $user_model;
	
		

	public function check_userlogin(){	
		if(!isset($_SESSION['userdata'])){	
			$this->logout(true);		
		}
	}

	
	protected function logout( $redirect = false ){				
		$_SESSION['userdata'] = null;
		
		unset( $_SESSION['userdata'] );
       	unset( $_SESSION['goto_url'] );
		
		
		session_regenerate_id();	
		if($redirect === true){			
			$this->goto_login();
		}
	}

	protected function goto_login(){       
		if ( defined( 'HOME_URI' ) ){
			$login_uri = HOME_URI.'login/';			
			echo '<meta http-equiv="Refresh" content="0; url=' . $login_uri . '">';
			echo '<script type="text/javascript">window.location.href = "' . $login_uri . '";</script>';
			header('location: ' . $login_uri);
		}
		return;
	}

	function session($email){	
			
		$_SESSION['userdata'] = $email;
		$this->logged_in = true;
		$this->userdata	 = 	$email;	
		if(isset($_SESSION['goto_url'])){
			$this->goto_page($_SESSION['goto_url']);
		}else{
			$this->goto_page('/home/index/');
		}
	}

	
	final protected function goto_page( $page_uri = null ){
		$page_uri  = urldecode( $page_uri);
		if ( $page_uri ){			
			echo '<meta http-equiv="Refresh" content="0; url=' . $page_uri . '">';
			echo '<script type="text/javascript">window.location.href = "' . $page_uri . '";</script>';
			header('location: ' . $page_uri);		
		}
	}
}