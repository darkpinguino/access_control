<?php 
	$text = '';
	$class = '';

	switch ($driver) {
		case 0:
			$text = 'Pasajero';
			$class = 'label-success';
			break;
		case 1;
			$text = 'Conductor';
			$class = 'label-primary';
			break;
	}

	echo '<span class="label '.$class.'">'.$text.'</span>'
 ?>