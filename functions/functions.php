<?php

function remove($str) {
    $str = str_replace('.', '', $str);
    $str = str_replace('-', '', $str);
    return $str;
}


function tratamentoCPF($str){
	if(strlen($str) != 11)
		return false;
	else{
		$flag = true;
		for($i = 0; $i < strlen($str); $i++){
			if(($str[$i] < 48) AND ($str[$i] > 57)){
				$flag = false;
				break;
			}
		}
	}

	if($flag)
		return true;
	else
		return false;

}


function tratamentoData($str){
	if((strlen($str) == 10) OR (strlen($str) == 8)){
		if(($str[2] != '/') OR ($str[4] != '/')){
			$str[2] = '/';
			$str[5] = '/';
		}
	}
	return $str;
}

function returnCharCol($val){
	switch($val){
		case 1:
	        return 'A';
	    case 2:
	        return 'B';
	    case 3:
	        return 'C'; 
	    case 4:
	        return 'D';
	    case 5:
	        return 'E';
	    case 6:
	        return 'F';	
	    case 7:
	        return 'G';	
	    case 8:
	        return 'H';
	    case 9:
	        return 'I';	
	    case 10:
	        return 'J';	   
	    case 11:
	        return 'K';	
	    case 12:
	        return 'L';
	    case 13:
	        return 'M';	 
	    case 14:
	        return 'N';	
	    case 15:
	        return 'O';	                       	                             	                        	        	           
	}
}

?>