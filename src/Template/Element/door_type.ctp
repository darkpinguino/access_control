<?php 
	$type = "";
	$class = "";

	switch($typeID){
		case 1:
			$type = "Entrada";
			$class = "label-success";
			break;
		case 2:
			$type = "Salida";
			$class = "label-warning";
			break;
		case 3:
			$type = "Entrada/Salida";
			$class = "label-danger";
			break;
	}
?>

<?= '<span class="label label-success">'.$type.'</span>' ?>