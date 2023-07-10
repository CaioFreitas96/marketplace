<?php    
    class SalesModel extends MainModel {
        public function __construct($controller = null ){
            $this->setTable('sales');
            parent::__construct($controller);
        }  
        
        function getProduct($id = null){
            $query = "
            SELECT
                *
            FROM
                product";
            
            if($id){
                $query .= " WHERE id = $id";
            }

            $query .= " ORDER BY id DESC";
    
            return $this->db->exec($query);
        }
    }