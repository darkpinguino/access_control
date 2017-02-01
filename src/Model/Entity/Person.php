<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Person Entity.
 *
 * @property int $id
 * @property string $rut
 * @property string $name
 * @property string $lastname
 * @property int $phone
 * @property int $company_id
 * @property \App\Model\Entity\Company $company
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \App\Model\Entity\SensorData[] $sensor_data
 */
class Person extends Entity
{

	/**
	 * Fields that can be mass assigned using newEntity() or patchEntity().
	 *
	 * Note that when '*' is set to true, this allows all unspecified fields to
	 * be mass assigned. For security purposes, it is advised to set '*' to false
	 * (or remove it), and explicitly make individual fields accessible as needed.
	 *
	 * @var array
	 */
	protected $_accessible = [
		'*' => true,
		'id' => false,
	];

	protected function _getFullName()
	{
		return $this->_properties['name'] . '  ' .
			$this->_properties['lastname'];
	}

	protected function _getFullRut()
  {
  	$rut = $this->_properties['rut'];
    $x = 2;
    $sum = 0;
    for ($i=strlen($rut)-1; $i >= 0; $i--){
       if ($x>7){
        $x=2;
      }
      $sum = $sum +($rut[$i]*$x);
      $x++;
    }
    $vn = bcmod($sum, 11);
    $vn = 11 - $vn;
 
		switch ($vn) {
			case 10:
			  $vn="K";
				break;
			case 11:
			  $vn="0";
				break;
		}

    return $rut.'-'.$vn;
  }
}
