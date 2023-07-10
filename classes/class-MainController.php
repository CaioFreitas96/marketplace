<?php

class MainController extends UserLogin{	
		public 
			$title,
			$error,
			$action,
			$parameters = array(),			
			$model,
			$current_date,
			$login_required = true;				
		
		protected 			
			$name_view, 
			$module_name,
			$config_model,
			$app_nologin,
			$config_list;
				
		public function __construct ( $parameters = array(), $module_name = null, $login_required = true){
			
			$this->login_required  = $login_required;
			$this->parameters      = $parameters;	
			$this->current_date    = getDataAtual();		
			$this->load_model();	
			
			
			
			if($this->login_required){							
				$this->check_userlogin($parameters);
			}			
			
		
			if(isset($_POST['acess']) && $_POST['acess'] == 'integracao'){		
				$chk_user = json_decode($this->user_model->getUserByEmail($_POST['usuario_email']));		
				$_SESSION['userdata'] = $chk_user;
			}else{
				$chk_user = null;
			}
		} 				
		
		function setModulo($modulo){
			$this->module_name = $modulo;
		}

		function getModulo(){
			return $this->module_name;
		}

		function setView($view){
			$this->name_view = $view;
		}

		function viewPage($view){
			require_once ABSPATH . "/views/$this->name_view/$view ";
		}
		 
		public function load_model($model_name = false, $return = false){			
			if($model_name){
				$model_name = $model_name.'-model';
			}else{
				if(isset($this->module_name)){
					$model_name = $this->module_name.'/'.$this->module_name.'-model';
				}
			}
			
			if (!$model_name) return;
			
			$model_name =  strtolower( $model_name );	
			$model_path = ABSPATH . '/models/'.$model_name.'.php';					
			if(file_exists( $model_path )){				
				require_once $model_path;
				
				$model_name = explode('/', $model_name);				
				$model_name = end( $model_name );				
				$model_name = preg_replace( '/[^a-zA-Z0-9]/is', '', $model_name );						
				if ( class_exists( $model_name ) ){				
					if($return){						
						return new $model_name($this);
					}else{						
						$this->model =  new $model_name($this);
					}
				}				
				return;
			} 
		} 		

		function setSession($email){		
			$this->session($email);		
		}
	} 