<?php 
	$profile = "";
	$class = "";

	switch($profileID){
		case 1:
			$profile = "Visita";
			break;
		case 2:
			$profile = "Emplaedo";
		case 3:
			$profile = "Contratista";
			break;
	}
?>

<?= '<span class="label label-success">'.$profile.'</span>' ?>
