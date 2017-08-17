<?php
$combination = strtoupper($_REQUEST['combination']);
//$combination = 'LWR';
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, "https://api.kiwiplates.nz/api//combination/$combination/?vehicleTypeId=1");
$result = curl_exec($ch);
curl_close($ch);

$obj = json_decode($result);
//var_dump($obj->Data->Available);

if ($obj->Data->Available) {
	print "Congratulations $combination is available!  Would you like to purchase this?";
} else {

	$ch2 = curl_init();
	curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch2, CURLOPT_URL, "https://api.kiwiplates.nz/api//suggest?&startIndex=0&endIndex=8&leetSpeakAlt=true&popularNos=false&rangeOfNumbers=true&permutations=true&viewAll=false&combination=$combination");
	$result2 = curl_exec($ch2);
	curl_close($ch2);
	$obj2 = json_decode($result2);
	print "Sorry $combination is not available.  Here are some alternatives: ";
	//print_r($obj2->Data);
	$suggestions = "";
	foreach ($obj2->Data as $arr) {
		//print_r($arr->suggestions);
		//print "xxxxxxxxx\n";
		foreach ($arr->suggestions as $suggestion) {
			$suggestions .= $suggestion->Combination . ", ";
		}


	}
	$suggestions = substr($suggestions, 0, -2);
	print $suggestions;
	print ".  Please respond with your prefered alternative to proceed.";
}