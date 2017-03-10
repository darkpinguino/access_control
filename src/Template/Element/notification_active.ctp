<?php 
	$message = "";
	$class = "";

	switch($active){
		case 0:
			$message = "Inactiva";
			$class = "label-success";
			break;
		case 1:
			$message = "Activa";
			$class = "label-danger";
			break;
	}
?>

<?= '<span class="label '.$class.'">'.$message.'</span>' ?>