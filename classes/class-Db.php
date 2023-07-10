<?php

class Db
{
	
	public
		$host      = null, // Database host
		$db_name   = null, // Database name
		$password  = null, // Database user password
		$user      = null, // Database user
		$charset   = null, // Database charset
		$pdo       = null, // DB connection
		$error     = null, // Configure the error
		$debug     = true, // Show all errors		
		$last_id   = null, // Last ID entered
		$prepare   = null,
		$port	   = null;

	private $hoje;
	
	public function __construct($parametros = null){
		
		$this->hoje = date('Y-m-d H:m:s');
			
		$this->db_name    = !empty($parametros['db_name'])?$parametros['db_name'] : DB_NAME;
        $this->host       = !empty($parametros['host'])?$parametros['host'] : HOSTNAME;
        $this->port       = !empty($parametros['port'])?$parametros['port'] : DB_PORT;
        $this->user       = !empty($parametros['user'])?$parametros['user'] : DB_USER;
        $this->password   = !empty($parametros['password'])? $parametros['password'] : DB_PASSWORD;
        $this->charset    = !empty($parametros['charset'])?$parametros['charset'] : DB_CHARSET;
        $this->debug      = !empty($parametros['debug'])?$parametros['debug'] : DEBUG;
				
		$this->connect();
	} 
	
	protected function connect() {					
		$pdo_details  = DB_DRIVER.":"."host=".$this->host.";dbname=".DB_NAME;		
		try {
			$this->pdo = new PDO($pdo_details, $this->user, $this->password, array(PDO::ATTR_PERSISTENT => true));
			$this->pdo->setAttribute(PDO::ATTR_AUTOCOMMIT,1);

		}catch(PDOException $e){
			$this->error = $e->getMessage();
			die(' Error DB - DB: '.$this->db_name." HOST: ".$this->host." USER: ".$this->user." PASS: ".$this->password." PORT: ".$this->port." Error: ".$this->error." ".$pdo_details);
		} 
	} 
	
	public function getDbName(){
		return $this->db_name;
	}

	public function query($stmt, $data_array = null) {				
		$query      = $this->pdo->prepare($stmt);		
		$check_exec = $query->execute($data_array);
						
		if($check_exec){			
			if(empty($query->rowCount())){				
				return false;
			}else{				
				return $query;
			}
		}else{			
			$error       = $query->errorInfo();
			$this->error = $error[2];			
			return false;
		}
	}
	
	public function insert( $table ) {		
		$cols = array();		
		$place_holders = '(';	
		$values = array();
		
		$j = 1;
		$data = func_get_args();	
		if ( ! isset( $data[1] ) || ! is_array( $data[1] ) ) {
			return;
		}		
		
		for ( $i = 1; $i < count( $data ); $i++ ) {			
			foreach ( $data[$i] as $col => $val ) {				
				if ( $i === 1 ){
					$cols[] = "$col";
				}
				if ( $j <> $i ) {					
					$place_holders .= '), (';
				}
				
				$place_holders .= '?, ';			
				$values[] = $val;
				$j = $i;
			}			
			$place_holders = substr( $place_holders, 0, strlen( $place_holders ) - 2 );
		}
		
		$cols = implode(', ', $cols);			
		$stmt = "INSERT INTO $table ( $cols ) VALUES $place_holders) ";
					
		$insert = $this->query( $stmt, $values );				
		if($insert){			
			if($this->pdo->lastInsertId()){				
				$this->last_id = $this->pdo->lastInsertId();
			}			
			return $this->last_id;
		}		
		return;
	} 
	
	public function update( $table, $where_field, $where_field_value, $values ){	
		if (empty($table) || empty($where_field) || empty($where_field_value)){
			return;
		}
		
		$stmt = " UPDATE `$table` SET ";		
		$set = array();
				
		if(is_array($where_field) && is_array($where_field_value)){		
			$where  = " WHERE ";
			$where .= implode(' and ', $where_field);
			exit;
		}elseif(!is_array($where_field) && is_array($where_field_value)){
			$where  = " WHERE $where_field in (";
			$where .= implode(',', $where_field_value).')'; 
		}else{
			$where = " WHERE `$where_field` = ? ";	
		}

		
		if(!is_array($values)){
			return;
		}
		
		foreach($values as $column => $value){
			$set[] = " `$column` = ?";
		}		
		
		$set = implode(', ', $set);			
		$values = array_values($values);		
		if(!is_array($where_field_value)){
			$values[] = $where_field_value;
		}		
		
		$stmt .= $set . $where;		
		$update = $this->query($stmt,$values);	
		if ($update){			
			return $update;
		}		
		return;
	} 	

	function exec($stmt, $data_array = null ){	
		$exec = $this->query($stmt, $data_array);						
		if($exec){					
			$return = $exec->fetchAll(PDO::FETCH_ASSOC);			
			return json_encode($return);
		}else{
			return false;
		}
	}
}