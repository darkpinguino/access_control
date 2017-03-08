<?php 
	$action = "";
	$class = "";

	switch($actionID){
		case 0:
			$action = "Salida";
			$class = "label-danger";
			break;
		case 1:
			$action = "Entrada";
			$class = "label-success";
			break;
	}
?>

<?= '<span class="label '.$class.'">'.$action.'</span>' ?>
