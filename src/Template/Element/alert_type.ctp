<?php 
	$type = "";

	switch($typeID){
		case 1:
			$type = "Intento de ingreso";
			break;
		case 2:
			$type = "Tiempo de permanencia";
			break;
	}
?>

<?= '<span class="label label-danger">'.$type.'</span>' ?>