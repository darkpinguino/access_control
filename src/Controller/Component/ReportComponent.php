<?php 
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\I18n\Date;
use Cake\I18n\Time;

class ReportComponent extends Component
{
  public function getReportDataRequest($data)
    {
    	if ($data['fullRange'] == 1) {
    		$dates[0] = new date('0000-00-00');
    		$dates[1] = new date();
    		$dates[1]->modify('+1 day');
    	} else {
    		$dates = $this->getRangeDate($data['range-report']);
    	}
    	
    	$enclosures_id = $data['enclosures_id'];
    	$profiles_id = $data['profile_id'];
    	$people_id = $data['person_id'];
        $vehicle_id = $data['vehicle_id'];

    	$dataArray = [
    		'dates' => $dates,
    		'enclosures_id' => $enclosures_id,
    		'profiles_id' => $profiles_id,
    		'people_id' => $people_id,
            'vehicle_id' => $vehicle_id
    	];

    	return $dataArray;
    }

    public function getRangeDate($dateRange)
    {
    	$dates = explode(' - ', $dateRange);

    	$dates[0] = new Date($dates[0]);
    	$dates[1] = new Date($dates[1]);
    	$dates[1]->modify('+1 day');

    	return $dates;
    }
}

 ?>