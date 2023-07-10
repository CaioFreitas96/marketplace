<?php

class SalesController extends MainController{   
    public $module_name = 'sales'; 
    function __construct($parameters = null){           
        parent::__construct($parameters,$this->module_name);
    }

    public function index(){               
        $product = json_decode($this->model->getProduct());	  
        require ABSPATH . '/views/sales/sales-view.php';
    } 
    
    function sales(){
        try{
                 
            if(!isset($_POST["id_product"]) || empty($_POST["id_product"])){
                $response['cod'] = 1;
                $response['input'] = $_POST;
                $response['output'] = null;
                $response['message'] = "inform the product";
                throw new Exception(json_encode($response),1);
            }

            if(!isset($_POST["amount"]) || empty($_POST["amount"])){
                $response['cod'] = 1;
                $response['input'] = $_POST;
                $response['output'] = null;
                $response['message'] = "inform the amount";
                throw new Exception(json_encode($response),1);
            }else{
                if(is_numeric($_POST['amount'])){
                    $amount = $_POST["amount"];
                }else{
                    $response['cod'] = 1;
                    $response['input'] = $_POST;
                    $response['output'] = null;
                    $response['message'] = "amount not is numeric";
                    throw new Exception(json_encode($response),1);
                }               
            }

            $get_product = json_decode($this->model->getProduct($_POST["id_product"]));         
            if(!isset($get_product) || empty($get_product)){
                $response['cod'] = 1;
                $response['input'] = $_POST;
                $response['output'] = $get_product;
                $response['message'] = "Erro product";
                throw new Exception(json_encode($response),1);
            }else{
                $sales = $this->calculateTax($get_product,$amount);
            }

          
            if($sales){
                $response['cod'] = 0;
                $response['input'] = $_POST;
                $response['output'] = $sales;
                $response['message'] = "Success";
                throw new Exception(json_encode($response),1);
            }else{
                $response['cod'] = 1;
                $response['input'] = $_POST;
                $response['output'] = $this->model->info;
                $response['message'] = "Error calculate tax";
                throw new Exception(json_encode($response),1);
            }          
            
        }catch(Exception $e) {          
            echo $e->getMessage();
        }     
    }

    function confirmSales(){
        try{
                 
            if(!isset($_POST["id_product"]) || empty($_POST["id_product"])){
                $response['cod'] = 1;
                $response['input'] = $_POST;
                $response['output'] = null;
                $response['message'] = "inform the product";
                throw new Exception(json_encode($response),1);
            }

            if(!isset($_POST["amount"]) || empty($_POST["amount"])){
                $response['cod'] = 1;
                $response['input'] = $_POST;
                $response['output'] = null;
                $response['message'] = "inform the amount";
                throw new Exception(json_encode($response),1);
            }else{
                if(is_numeric($_POST['amount'])){
                    $amount = $_POST["amount"];
                }else{
                    $response['cod'] = 1;
                    $response['input'] = $_POST;
                    $response['output'] = null;
                    $response['message'] = "amount not is numeric";
                    throw new Exception(json_encode($response),1);
                }               
            }

                                  
            $save = $this->model->save($_POST);
            if($save){
                $response['cod']  = 0;
                $response['input']   = $save;
                $response['output']  = $sales;
                $response['message'] = "Success";
                throw new Exception(json_encode($response),1);
            }else{
                $response['cod']     = 1;
                $response['input']   = $_POST;
                $response['output']  = $this->model->info;
                $response['message'] = "Error calculate tax";
                throw new Exception(json_encode($response),1);
            }          
            
        }catch(Exception $e) {          
            echo $e->getMessage();
        }     
    }

    function calculateTax($product, $amount){
        $sales['product'] =  $product[0]->name;
        $sales['amount']  =  $amount;
        $value = $product[0]->value * $amount;
        $tax   = ($product[0]->tax * $value) / 100;
       
        $sales['value']   = funcValor($value,"C",2);
        $sales['tax']     =funcValor($tax,"C",2);
        return $sales;
    }
    
   
} 