<?php
try {
	$soapClientObj = new SoapClient("http://YourSite.com/Post/Send.asmx?wsdl");
 	$parameters['username'] = "****";
    $parameters['password'] = "****";
    $parameters['from'] = "1000****";
    $parameters['to'] = array("936*******","912*******");
    $parameters['text'] ="your message";
    $parameters['isflash'] = false;
    $parameters['udh'] = "";
    $parameters['recId'] = array(0);
    $parameters['status'] = array(0);
	print_r($soapClientObj->SendSms($parameters));
	// retval :
	// InvalidUserPass = 0
	// Successfull = 1
	// NoCredit = 2
	// DailyLimit = 3
	// SendLimit = 4
	// InvalidNumber = 5
	
	// Status :
	// Sent = 0
	// Failed = 1
} catch (SoapFault $fault) {
	echo  "$fault";
}


?>