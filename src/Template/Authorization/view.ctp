<?php 

// $objPHPExcel = new PHPExcel(); //nueva instancia

$objPHPExcel = $this->PhpExcel;

$bordes = $this->PhpExcel->PHPExcel_Style(); //nuevo estilo
 
$bordes->applyFromArray(
  array('borders' => array(
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    )
));

// $fila = 1;

// foreach ($people_locations as $people_location) {
// 	$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $people_location->person->rut);
//   $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Kiuvox');
 
//   //Establecer estilo
//   $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:B$fila");

//   $file+=1;
// }

$objWriter = $this->PhpExcel->PHPExcel_Writer_Excel2007($objPHPExcel); //Escribir archivo
 
//// nombre del archivo
header('Content-Disposition: attachment; filename="kiuvox.xlsx"');
//**********************************************************************
 
//forzar a descarga por el navegador
$objWriter->save('php://output');
?>

