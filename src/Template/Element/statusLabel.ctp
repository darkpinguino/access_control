<?php 
	$status = "";
	$class = "";

	switch($statusID){
		case 1:
			$status = "Permitido";
			$class = "label-success";
			break;
		case 2:
			$status = "Pendiente";
			$class = "label-warning";
			break;
		case 3:
			$status = "Denegado";
			$class = "label-danger";
			break;
	}
?>

<?= '<span class="label '.$class.'">'.$status.'</span>' ?>
