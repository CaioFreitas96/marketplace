<?php    
    class RegisterModel extends MainModel {
        public function __construct($controller = null ){
            $this->setTable('register');
            parent::__construct($controller);
        }      
    }
