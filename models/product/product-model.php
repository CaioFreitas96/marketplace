<?php    
    class ProductModel extends MainModel {
        public function __construct($controller = null ){
            $this->setTable('product');
            parent::__construct($controller);
        }      
    }