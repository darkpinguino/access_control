<?php 
	$access = "";
	$class = "";

	switch($accessID){
		case 1:
			$access = "Personas";
			$class = "label-success";
			break;
		case 2:
			$access = "Vehiculos";
			$class = "label-warning";
			break;
		case 3:
			$access = "Personas/Vehiculos";
			$class = "label-danger";
			break;
	}
?>

<?= '<span class="label label-success">'.$access.'</span>' ?>