<?php
    require_once("../PHPExcel-1.8/Classes/PHPExcel/IOFactory.php");
    require_once("../functions/functions.php");

    $file = $_FILES["excel"]["tmp_name"];
    $objPHPExcel = PHPExcel_IOFactory::load($file);
    $objExcel = new PHPExcel(); 
    $objPHPExcel->setActiveSheetIndex(0);
    $rowCount = 1; 
    //declaramos uma variavel para monstarmos a tabela

    $objExcel->getActiveSheet()->SetCellValue('A'.$rowCount, 'data_distribuicao');
    $objExcel->getActiveSheet()->SetCellValue('B'.$rowCount, 'local'); 
    $objExcel->getActiveSheet()->SetCellValue('C'.$rowCount, 'nome'); 
    $objExcel->getActiveSheet()->SetCellValue('D'.$rowCount, 'raca');  
    $objExcel->getActiveSheet()->SetCellValue('E'.$rowCount, 'data_nascimento'); 
    $objExcel->getActiveSheet()->SetCellValue('F'.$rowCount, 'rg'); 
    $objExcel->getActiveSheet()->SetCellValue('G'.$rowCount, 'orgao_expedidor'); 
    $objExcel->getActiveSheet()->SetCellValue('H'.$rowCount, 'cpf'); 
    $objExcel->getActiveSheet()->SetCellValue('I'.$rowCount, 'contato'); 
    $objExcel->getActiveSheet()->SetCellValue('J'.$rowCount, 'sexo'); 
    $objExcel->getActiveSheet()->SetCellValue('K'.$rowCount, 'endereco'); 
    $objExcel->getActiveSheet()->SetCellValue('L'.$rowCount, 'bairro'); 
    $objExcel->getActiveSheet()->SetCellValue('M'.$rowCount, 'renda_familiar'); 
    $objExcel->getActiveSheet()->SetCellValue('N'.$rowCount, 'composicao_familiar'); 
    $objExcel->getActiveSheet()->SetCellValue('O'.$rowCount, 'beneficios'); 
    $rowCount++;
    //varremos o excel com o foreach para pegar os dados
    foreach ($objPHPExcel->getWorksheetIterator() as $worksheet){
        $highestRow = $worksheet->getHighestRow();
        for($row=1; $row<=$highestRow; $row++){
            if(($worksheet->getCellByColumnAndRow(1, $row)->getValue() != "") AND (($worksheet->getCellByColumnAndRow(1, $row)->getValue() != "DATA") AND ($worksheet->getCellByColumnAndRow(2, $row)->getValue() != "DATA"))){
                for($names = 1; $names <= 15; $names++){
                    if(($names == 1) || ($names == 5)){
                        $date = PHPExcel_Style_NumberFormat::toFormattedString($worksheet->getCellByColumnAndRow($names, $row)->getValue(), "DD/MM/YYYY");
                        $objExcel->getActiveSheet()->SetCellValue(returnCharCol($names).$rowCount, strval(utf8_decode($date)));

                    }else{
                        if(strval($worksheet->getCellByColumnAndRow($names, $row)->getValue()) != " "){
                            $var = strval($worksheet->getCellByColumnAndRow($names, $row)->getValue());
                            $objExcel->getActiveSheet()->SetCellValue(returnCharCol($names).$rowCount, $var);
                        }else{
                        	$objExcel->getActiveSheet()->SetCellValue(returnCharCol($names).$rowCount, '');
                        }
                    }
                    //echo strval($worksheet->getCellByColumnAndRow($names, $row)->getValue());
                }
                $rowCount++;       
            }
        }  
    }
    // Definimos o nome do arquivo que será exportado  
    $objWriter = new PHPExcel_Writer_Excel2007($objExcel); 
    //$objWriter->save('some_excel_file.xlsx'); 
    header('Content-type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="file.xls"');
    $objWriter->save('php://output');

    exit;
?>