<?php
class MVC{
	
	private 
		$controller,	
		$action,
		$parameters;	
	
	
	public function __construct(){						
		$this->get_url_data();	
		
		
		
		
		
		
		if (!$this->controller){	
			if(isset($this->controller->logged_in) && $this->controller->logged_in){
				require_once ABSPATH . '/controllers/home-controller.php';
				$this->controller = new HomeController();			
				$this->controller->index();	
			}else{
				require_once ABSPATH . '/controllers/login-controller.php';
				$this->controlador = new LoginController();				
				$this->controlador->index();
			}						
			
			return;
		}
		
		// Se o arquivo do controlador não existir, não faremos nada
		if(!file_exists(ABSPATH.'/controllers/'.$this->controller.'.php')){
			echo "PAGE NOT FOUND";
			return;
		}

		

		// Inclui o arquivo do controlador
		require_once ABSPATH.'/controllers/'.$this->controller.'.php';		
		$this->controller = preg_replace('/[^a-zA-Z]/i','',$this->controller);

		
		
		if(!class_exists($this->controller)){
			echo "CLASS/PAGE NOT FOUND";
			return;
		}		

		
		
				
		$this->parameters['action'] = $this->action;
		$this->controller           = new $this->controller( $this->parameters );	
		$this->action               = preg_replace( '/[^a-zA-Z]/i', '', $this->action );
		$this->controller->action   = $this->action;		
		$this->controller->{$this->action}($this->parameters);			
		return;
	} 

	
	public function get_url_data (){
		$uri = ltrim($_SERVER['REQUEST_URI'], '/');		
				
		if(isset($uri) && !empty($uri)){
			$_GET['path'] = $uri;					
			
			$path = $_GET['path'];			
			$path = rtrim($path, '/');
			$path = filter_var($path, FILTER_SANITIZE_URL);		
			$path = explode('/', $path);						
					
			// Configura as propriedades
			$this->controller = chk_array($path, 0);			
			$this->controller .= '-controller';
						
					
			$this->action        = chk_array($path, 1);
			if(!isset($this->action) || empty($this->action)){
				$this->action = "index";
			}					
			
			// Configura os parâmetros
			if (chk_array($path, 2)){
				unset($path[0]);
				unset($path[1]);				
				$this->parameters = array_values($path);
			}			
		}			
		
		if(DEBUG){
			// DEBUG
			echo '<code style="position:absolute; right:0;">';
			echo 'HORA DO SERVIDOR '.date('d/m/Y H:m:s').'<br>';
			echo $this->controller . '<br>';
			echo $this->action        . '<br>';
			print_r( $this->parameters );
			echo '</code>';
		}
		
	} 
} 