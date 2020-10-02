<?php

	include("../functions/functions.php");
	include("../PHPExcel-1.8/Classes/PHPExcel/IOFactory.php");

	$name_table = $_POST['nome_banco'];
	$colunas = $_POST['colunas'];
	$output = "<label class='text-warning'>Dados não Inseridos</label><br /><table class='table table-bordered'>";

	$connect = mysqli_connect();
	$query_id = "query";
	$ggQuery_id = mysqli_query($connect, $query_id);
	$row_cnt = mysqli_num_rows($ggQuery_id);

	if($row_cnt > 0){
		$valor = mysqli_fetch_object($ggQuery_id);
		$contador = $valor->id + 1;
	}else{
		$contador = 1;
	}

	$value = explode(".", $_FILES["excel"]["name"]);
	$extension = strtolower(array_pop($value));
	$allowed_extension = array("xls", "xlsx", "csv"); 

	if(in_array($extension, $allowed_extension)) {
		$file = $_FILES["excel"]["tmp_name"];
		$objPHPExcel = PHPExcel_IOFactory::load($file);
	  	foreach ($objPHPExcel->getWorksheetIterator() as $worksheet){
	   		$highestRow = $worksheet->getHighestRow();
	   		for($row=2; $row<=$highestRow; $row++){
	   			$arr = Array();
	   			$val = Array();
			    $output .= "<tr>";
			    for($names = 0; $names < $colunas; $names++){
			    	$name = $worksheet->getCellByColumnAndRow($names, 1)->getValue();
			    	$$name = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow($names, $row)->getValue());
			    	array_push($arr, $name);
			    	if($name == 'cpf'){
			    		$$name = remove($$name);
			    		if(!tratamentoCPF($$name)){
			    			$$name = "NULL";
			    		}
				    }

				    if(($name == 'data_nascimento') OR ($name == 'data_distribuicao')){
				    	$$name = tratamentoData($$name);
				 	}

				    array_push($val, $$name);


				}
				$query = "INSERT INTO $name_table("; 
				$max = sizeof($arr); 
				for($i = 0; $i < $max; $i++) { 
					if($i != $max - 1) {
						$query .= "$arr[$i], "; 
					}
					else {
						$query .= "$arr[$i]) VALUES ("; 
					}
				}
				for($i = 0; $i < $max; $i++) { 
					if($val[$i] != " "){
						if($val[$i] != "NULL"){
							$query .= "\""; 
							$query .= "$val[$i]";
							$query .= "\""; 
						}
						else{
							$query .= 'NULL';
						}
					}else{
						$query .= "\""; 
						$query .= "\""; 
					}
					if($i != $max - 1)
						$query .= ", "; 
					else 
						$query .= ")"; 
				}
				    
				$inserido = mysqli_query($connect, $query);
			    if(!$inserido){
			    	$query_increment = "ALTER TABLE beneficiados_completo AUTO_INCREMENT = $contador";
			    	mysqli_query($connect, $query_increment);
			    	for($i = 0; $i < 9; $i++) { 
			    		if(($i == 2) || ($i == 5) || ($i == 7) || ($i == 8))  
					   		$output .= '<td>'.$val[$i].'</td>';
					}
					   	$output .= '</tr>';
					   	unset($arr);
					   	unset($val);
			    }else{
			    	$contador ++;
			    }
				unset($arr);
				unset($val);
   			}
		} 
			$output .= '</table>';
			header('Location: ../index.php?sucesso&id=1');	
		}else{
  			$output = '<label class="text-danger">Invalid File</label>'; //if non excel file then
 		}
?>
