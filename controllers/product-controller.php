<?php

class ProductController extends MainController{
    public $module_name = 'product';
    function __construct($parameters = null){              
        parent::__construct($parameters,$this->module_name, false);
    }
    
    public function index(){          
        
        require ABSPATH . '/views/product/index-view.php';
    } 

    public function register(){           
        try{

            if(!isset($_POST["name"]) || empty($_POST["name"])){
                $response['cod'] = 1;
                $response['input'] = $_POST;
                $response['output'] = null;
                $response['message'] = "inform the name of product";
                throw new Exception(json_encode($response),1);
            }

            if(!isset($_POST["type"]) || empty($_POST["type"])){
                $response['cod'] = 1;
                $response['input'] = $_POST;
                $response['output'] = null;
                $response['message'] = "inform the type";
                throw new Exception(json_encode($response),1);
            }

            if(!isset($_POST["value"]) || empty($_POST["value"])){
                $response['cod'] = 1;
                $response['input'] = $_POST;
                $response['output'] = null;
                $response['message'] = "inform the type";
                throw new Exception(json_encode($response),1);
            }

            if(!isset($_POST["tax"]) || empty($_POST["tax"])){
                $response['cod'] = 1;
                $response['input'] = $_POST;
                $response['output'] = null;
                $response['message'] = "inform the tax percentage";
                throw new Exception(json_encode($response),1);
            }  
          
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