<?php

class RegisterController extends MainController{
    public $module_name = 'register';
    function __construct($parameters = null){
              
        parent::__construct($parameters,$this->module_name, false);
    }
    
    public function index(){        
              
        
        require ABSPATH . '/views/register/form-view.php';
    } 

    public function register(){           
        try{

            if(!isset($_POST["name"]) || empty($_POST["name"])){
                $response['cod'] = 1;
                $response['input'] = $_POST;
                $response['output'] = null;
                $response['message'] = "inform the name";
                throw new Exception(json_encode($response),1);
            }

            if(!isset($_POST["last_name"]) || empty($_POST["last_name"])){
                $response['cod'] = 1;
                $response['input'] = $_POST;
                $response['output'] = null;
                $response['message'] = "inform the last name";
                throw new Exception(json_encode($response),1);
            }

            if(!isset($_POST["email"]) || empty($_POST["email"])){
                $response['cod'] = 1;
                $response['input'] = $_POST;
                $response['output'] = null;
                $response['message'] = "inform the e-mail";
                throw new Exception(json_encode($response),1);
            }

            if(!isset($_POST["password"]) || empty($_POST["password"])){
                $response['cod'] = 1;
                $response['input'] = $_POST;
                $response['output'] = null;
                $response['message'] = "inform the password";
                throw new Exception(json_encode($response),1);
            }

            if(!isset($_POST["check_password"]) || empty($_POST["check_password"])){
                $response['cod'] = 1;
                $response['input'] = $_POST;
                $response['output'] = null;
                $response['message'] = "inform the repeat password";
                throw new Exception(json_encode($response),1);
            }

            if($_POST["password"] != $_POST["check_password"]){
                $response['cod'] = 1;
                $response['input'] = $_POST;
                $response['output'] = null;
                $response['message'] = "different password";
                throw new Exception(json_encode($response),1);
            }else{
                unset($_POST["check_password"]);
                $_POST['password'] = md5($_POST['password']);
            }
            
            $this->model->setTable("register");
            $save = $this->model->save($_POST);
            if($save){
                $response['cod'] = 0;
                $response['input'] = $_POST;
                $response['output'] = null;
                $response['message'] = "Success";
                throw new Exception(json_encode($response),1);
            }else{
                $response['cod'] = 1;
                $response['input'] = $_POST;
                $response['output'] = $this->model->info;
                $response['message'] = "Error saving to database";
                throw new Exception(json_encode($response),1);
            }          
            
        }catch(Exception $e) {          
            echo $e->getMessage();
        }        
    } 
    
} 