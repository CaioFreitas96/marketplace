<?php

function chk_array($array, $key){		
	if(isset($array[$key]) && !empty($array[$key])){		
		return $array[$key];
	}
	
	return null;
} 

function convertDate($date, $mask = 0){
	$array = explode(" ",$date);
	$arr1 = explode('/', $array[0]);
	$arr2 = explode('-', $array[0]);
	
	if(count($arr1) == 3){			
		if(1 == $mask){
			$date = trim($arr1[2]).trim($arr1[1]).trim($arr1[0]);
		}else{
			$date = trim($arr1[2]).'-'.trim($arr1[1]).'-'.trim($arr1[0]);			
		}
	}elseif(3 == count($arr2)){
		$date = trim($arr2[2]).'/'.trim($arr2[1]).'/'.trim($arr2[0]);
	}elseif(isset( $date[7] )){
		$ano = substr($date, 0, 4);
		$mes = substr($date, 4, 2);
		$dia = substr($date, 6, 2);
		$date = $ano.'-'.$mes.'-'.$dia;
	}else{
		$date = false;
	}

	$date = $date." ".$array[1];	
	return $date;
}

function getDataAtual($date = null, $format = 'd/m/Y'){ // informar o formato yyyy-mm-dd
	if($date){
		$arr1 = explode('/', $date);		
		if(count($arr1) != 3 && $format == 'd/m/Y'){
			$date = convertDate($date);
		}
		$current_date = DateTime::createFromFormat($format, $date);
	}else{
		$current_date = new DateTime();
	}
	
	if($current_date){
		return $current_date;
	}else{
		return false;
	}
}

function funcValor($aValor, $aTipo, $a_dec = 2) { // valores com mascara e sem mascara
	switch ($aTipo):
	   	case 'C':// com mascara
			$aValor = (float)$aValor;
			$valor = number_format(round($aValor, $a_dec), $a_dec, ',', '.');
		break;
 	   	case 'S':// sem mascara
			$valor = str_replace(',', '.', str_replace('.', '', $aValor));
		break;
	   	case 'A':// arrendonda
			$aValor = (float)$aValor;
			$valor = round($aValor, $a_dec);
		  	$valor = number_format($valor, $a_dec, '.', '');
		 	 break;
	   	case 'D':// Decimais sem arredonda,sem mascara
			$posPonto = strpos($aValor, '.');
		  	if ($posPonto > 0):
				$valor = substr($aValor, 0, $posPonto) . '.' . substr($aValor, $posPonto + 1, $a_dec);
		  	else:
				$valor = $aValor;
		  	endif;
		break;
	endswitch;
 
	return $valor;
 }

function autoLoad($class_name){		
    $file = ABSPATH.DS.'classes/class-'.$class_name.'.php';		
    if(!file_exists($file)){
        echo '<br>'.$class_name.'<br>';			
        return;
    } 
    require_once $file;		
}

spl_autoload_register('autoLoad'); 