<?php
$postcode = strtoupper($_REQUEST['postcode']);
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, "http://v0.postcodeapi.com.au/suburbs/$postcode.json");
$result = curl_exec($ch);
curl_close($ch);


$obj = json_decode($result);
var_dump($obj[0]);

$lat = $obj[0]->latitude;
$long = $obj[0]->longitude;


$ch2 = curl_init();
curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch2, CURLOPT_URL, "https://www.honda.com.au/content/honda/en/finddealerapi/jcr:content/find.dealerV2.json/$lat,$long");

$result2 = curl_exec($ch2);
curl_close($ch2);
$obj2 = json_decode($result2);
var_dump($result2);
exit;
print "Oops! combination $postcode is unavailable.  Here are some alternatives: ";

$suggestions = "";
foreach ($obj2->Data as $arr) {

    if ("Framed" != $arr->CombinationGroup) {
        foreach ($arr->suggestions as $suggestion) {
            $suggestions .= $suggestion->Combination . ", ";
        }
    }


}
$suggestions = substr($suggestions, 0, -2);
print $suggestions;
print ".  Please respond with your prefered alternative to proceed.";
