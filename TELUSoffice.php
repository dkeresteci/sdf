
<?php
include 'geodistance.php';
// $string = file_get_contents("js/TELUSoffices.json");
// $data=json_decode($string, true);

// $arr = $data["offices"];


function findTELUSOffice($lat, $lng, $data_array, $k){
	//Returns the first TELUS office which is within k(m) distance from lat/lng points
	
	foreach($data_array as $office){
		$dist = distance($lat, $lng, $office["lat"], $office["lng"], "K");
		
		if($dist*1000 < $k){
			return $office;
		}
	}

	return null; 
};

//$ans = findTELUSOffice(43.6472892, -79.3811998, $arr, 500);

//print_r($ans);

?>