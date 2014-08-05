<?php
include 'TELUSoffice.php';


//Load in the TELUS Office Location Data
$string = file_get_contents("js/TELUSoffices.json");
$data=json_decode($string, true);
$arr = $data["offices"];

//Load PEM Certificate from directory not accessible from the web (For security)

//ON XAMPP (localhost)
//$cert = "cert.pem";

//ON AWS (Ubuntu)
$cert = "/var/ssl/cert.pem";

//Load your message from the URL phpFile.php?msg=<MESSAGE>
if (!empty($_REQUEST['num'])) {
    $phoneNum=$_REQUEST['num'];
} else {
    $phoneNum = "14388311786";
}


//URL for terminal location WSDL
$url = "http://webservices.telus.com/parlayx_terminal_location_service_2_3.wsdl";

//Create a new SoapClient with the URL and Local Cert
$client = new SoapClient($url, array('local_cert' => $cert));

//Create Associative Array.
$address = "tel:" . $phoneNum;
$request_accuracy = 100;
$accepted_accuracy = 1000;
$tolerance = "DelayTolerant";
$params = array('address' => $address, 'requestedAccuracy' => $request_accuracy, 'acceptableAccuracy' => $accepted_accuracy, 'tolerance' => $tolerance);

//Load the getLocation function, the name of this I learned from loading the WSDL in SoapUI
//Pass the parameters in the associative array
//Store the XML response in a variable

$response = $client->getLocation($params);

$result = $response -> result;

//Store the info from the response we want
$lat = $result -> latitude;
$lng = $result -> longitude;
$accuracy = $result -> accuracy;
$timestamp = $result -> timestamp;

//Find the closest TELUS Office - if there is one nearby
//If not at a TELUS office it returns null
$office = findTELUSOffice($lat, $lng, $arr, 500);

//Add the timestamp and accuray on the the end of the office data; 
$office["timestamp"] = $timestamp;
$office["accuracy"] = $accuracy; 

$json_resp = json_encode($office);

//Dump the variable to see the response
//print_r($response);
print_r($json_resp);

?>