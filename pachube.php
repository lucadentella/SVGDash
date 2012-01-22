<?php

define("API_KEY", "Mqe8o_23LogI5by7rjWcUci3bBtF-51o2t10IxkPu6E90FqQfHB0wSzTC8OaiV428bPM-7W6mGpnRW_jpE1OPGlSu414XgXr-a52blZolFFb4iyGomnMiXNgOHAe3ovt");
define("FEED_ID", 29689);
define("DATASTREAM_ID", 0);
define("ELEMENT_POSITION", 2);
define("AUTOREFRESH", true);
define("AUTOREFRESHTIME", 30);

define("DEBUG", true);

if(AUTOREFRESH) {
	header('Refresh: ' . AUTOREFRESHTIME);
	if(DEBUG) echo "Refreshing page every " . AUTOREFRESHTIME . " seconds<br>";
} else
	if(DEBUG) echo "Autorefresh disabled<br>";

$feed_url = "http://api.pachube.com/v2/feeds/" . FEED_ID . ".csv?datastreams=" . DATASTREAM_ID;
if(DEBUG) echo "Pachube URL: " . $feed_url . "<br>";

$curl_handle = curl_init($feed_url);
if($curl_handle == FALSE) die("Unable to initialize session with Pachube, " . curl_error($curl_handle));
if(DEBUG) echo "Session initialized<br>";

curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('X-PachubeApiKey: ' . API_KEY));
if(DEBUG) echo "Connection parameters set<br>";

$out = curl_exec($curl_handle);
if($out == FALSE) die("Unable to connect to Pachube, " . curl_error($curl_handle));
if(DEBUG) echo "Connection performed, raw response: " . $out . "<br>";

$http_code = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);
if(DEBUG) echo "HTTP result code: " . $http_code . "<br>";

if($http_code == "200") {
	$elements = explode(",", $out);
	$element = $elements[ELEMENT_POSITION];
} else {
	die("Unable to retrieve data from Pachube<br>");
}

if(DEBUG) echo "iFrame URL: thermometer.php?value=$element<br><br>";
echo "<iframe src='thermometer.php?value=$element' frameborder='0'></iframe>";
?>

