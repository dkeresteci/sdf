<?php

//Load PEM Certificate from directory not accessible from the web (For security)
//ON XAMPP (localhost)
 $cert = "cert.pem";

//ON AWS (Ubuntu)
//$cert = "/var/ssl/cert.pem";

//Load your message from the URL phpFile.php?msg=<MESSAGE>
if (!empty($_REQUEST['msg'])) {
    $message=$_REQUEST['msg'];
} else {
    $message = "Message is empty";
}

//Load your phone number
if (!empty($_REQUEST['num'])) {
    $phoneNum=$_REQUEST['num'];
} else {
    $phoneNum = "14388311786";
}



//URL for SMS WSDL, here I am using the sms_send_service
//Check https://partners.telus.com for the full list
$url = "http://webservices.telus.com/parlayx_sms_send_service_2_3.wsdl";

//Create a new SoapClient with the URL and Local Cert
$client = new SoapClient($url, array('local_cert' => $cert));

//Create Associative Array.
//It's best to load the WSDL using SoapUI to learn which variables you want to set with this array
//The minimum requirements for an SMS are "addresses" and "message"
$address = "tel:" . $phoneNum;
$params = array('addresses' => $address, 'message' => $message);

//Load the sendSms function, the name of this I learned from loading the WSDL in SoapUI
//Pass the parameters in the associative array
//Store the XML response in a variable
$response = $client->sendSms($params);

$json_resp = json_encode($response);
print($json_resp);
?>