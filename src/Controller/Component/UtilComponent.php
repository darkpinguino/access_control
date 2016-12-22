<?php 
namespace App\Controller\Component;

use Cake\Controller\Component;

class UtilComponent extends Component
{
  public function getError($errors) 
  {
  	$str_errors = "";

  	foreach ($errors as $error) {
  		foreach ($error as $error_text) {
  			$str_errors = $str_errors.$error_text." ";
  		}
  	}

  	return $str_errors;
  }
} 

?>