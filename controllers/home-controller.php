<?php

class HomeController extends MainController{
	function __construct($parameters = null){
		$this->setModulo('home');
		$this->setView('home');
		parent::__construct($parameters);		
	}

	function index(){		
		$product = json_decode($this->model->getProduct());		
		$sales   = json_decode($this->model->getSales());	
		$full    = json_decode($this->model->getSalesProduct());	
		$info    = $this->fullCalculateTax($full);				
			
		require_once ABSPATH . '/views/'.$this->name_view.'/index.php';		
	}

	function fullCalculateTax($product){
        if(isset($product) && !empty($product)){
            foreach ($product as $key => $value) {
                $calculate[$value->id_product]['value'] += ($value->value * $value->amount);
				$calculate[$value->id_product]['tax'] = $value->tax;
				$info['amount'] += $value->amount;
            }
						
			foreach ($calculate as $key => $value) {
				$info['full_value'] += $value['value'];					
				$info['tax']   += ($value['tax'] * $value['value']) / 100;				
			}
			$info['full_value'] = funcValor($info['full_value'],"C",2);
			$info['tax']   = funcValor($info['tax'],"C",2);			
        }else{
            $info['value'] = 0;
			$info['tax']   = 0;
			$info['amount'] = 0;
        }			
		
		return $info;		
    }	
}
?>
