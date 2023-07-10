<?php

class HomeModel extends MainModel {
    public function __construct($controller = null ){		
		parent::__construct($controller);
	}

	function getProduct(){
		$query = "
		SELECT
			*
		FROM
			product";

		return $this->db->exec($query);
	}

	function getSales(){
		$query = "
		SELECT
			*
		FROM
			sales";

		return $this->db->exec($query);
	}

	function getSalesProduct(){
		$query = "
		SELECT
			s.amount,
			s.id_product,
			p.name,
			p.value,
			p.tax
		FROM
			sales s
		INNER JOIN
			product p
		ON
			(s.id_product = p.id)";

		return $this->db->exec($query);
	}
}