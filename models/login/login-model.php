<?php    
    class LoginModel extends MainModel {
        public function __construct($controller = null ){
            $this->setTable('register');
            parent::__construct($controller);
        }

        function getUser($email){
            $query = "
            SELECT
                *
            FROM
                register";

            if($email){
                $query .= " WHERE email = '$email'";
            }
            
            // echo $query;
            return $this->db->exec($query);
        }
    }