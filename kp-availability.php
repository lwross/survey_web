<?php
$combination = $_REQUEST['combination'];
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, 'https://api.kiwiplates.nz/api//$combination/lwR/?vehicleTypeId=1');
$result = curl_exec($ch);
curl_close($ch);

$obj = json_decode($result);
//var_dump($obj->Data->Available);

if ($obj->Data->Available) {
	print "Congratulations LWR is available!";
} else {
	print "Sorry LWR is not available";
}