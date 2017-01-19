<?php 
	$access = "";

	if ($accessID) {
		$access = "Vehicular";
	} else {
		$access = "Peatonal";
	}
?>

<?= '<span class="label label-success">'.$access.'</span>' ?>