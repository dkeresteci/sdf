<?php

//Load PEM Certificate from directory not accessible from the web (For security)
$cert = "cert.pem";

//Load your message from the URL phpFile.php?msg=<MESSAGE>
if (!empty($_REQUEST['num'])) {
    $phoneNum=$_REQUEST['num'];
} else {
    $phoneNum = "14388311786";
}

//Load your phone number
//$phoneNum = "4388311786";

//URL for SMS WSDL, here I am using the sms_send_service
//Check https://partners.telus.com for the full list
$url = "http://webservices.telus.com/parlayx_terminal_location_service_2_3.wsdl";

//Create a new SoapClient with the URL and Local Cert
$client = new SoapClient($url, array('local_cert' => $cert));

//Create Associative Array.
//It's best to load the WSDL using SoapUI to learn which variables you want to set with this array
//The minimum requirements for an SMS are "addresses" and "message"
$address = "tel:" . $phoneNum;
$request_accuracy = 100;
$accepted_accuracy = 1000;
$tolerance = "DelayTolerant";
$params = array('address' => $address, 'requestedAccuracy' => $request_accuracy, 'acceptableAccuracy' => $accepted_accuracy, 'tolerance' => $tolerance);

//Load the sendSms function, the name of this I learned from loading the WSDL in SoapUI
//Pass the parameters in the associative array
//Store the XML response in a variable

$response = $client->getLocation($params);

$json_resp = json_encode($response);

//Dump the variable to see the response
//print_r($response);
print($json_resp)
?>