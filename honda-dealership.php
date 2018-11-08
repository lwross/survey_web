<?php
$postcode = strtoupper($_REQUEST['postcode']);
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, "http://v0.postcodeapi.com.au/suburbs/$postcode.json");
$result = curl_exec($ch);
curl_close($ch);


$obj = json_decode($result);
//var_dump($obj[0]);

$lat = $obj[0]->latitude;
$long = $obj[0]->longitude;


$ch2 = curl_init();
curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch2, CURLOPT_URL, "https://www.honda.com.au/content/honda/en/finddealerapi/jcr:content/find.dealerV2.json/$lat,$long");

$result2 = curl_exec($ch2);
curl_close($ch2);
$obj2 = json_decode($result2);
//var_dump($obj2->dealers[0]->dealerName);

$dealerName = $obj2->dealers[0]->dealerName;
$dealerPhone = $obj2->dealers[0]->dealerAddresses[0]->phoneNumber;
$dealerSuburb = $obj2->dealers[0]->suburb;

$dealerPhone = substr($dealerPhone, 11);

print "Your nearest Honda dealership is $dealerName in $dealerSuburb.  You can call them on $dealerPhone";

print "Alrighty. Well it's been great to meet you.  Keep an eye on your inbox for the brochure as promised.  Your nearest Honda dealership is $dealerName in $dealerSuburb.  Feel free to give call them on $dealerPhone to organise a test drive";
