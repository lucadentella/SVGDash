<?php

	$value = $_GET["value"];	
	$root = $_SERVER["DOCUMENT_ROOT"];
	
	$svg_template = simplexml_load_file("$root/template.svg");
	
	$result = $svg_template->xpath("//*[@id='temp_level']");
	if(count($result) == 1) $temp_level = $result[0];
	else exit("Unable to find a node with temp_level ID");
	
	$result = $svg_template->xpath("//*[@id='temp_value']");
	if(count($result) == 1) $temp_value = $result[0];
	else exit("Unable to find a node with temp_value ID");
	
	$temp_level['height'] = $value * 5;
	$temp_value[0] = $value;
	
	if($value < 15) {
		$temp_level['style']="fill:#0000ff;stroke:none";
		$temp_value['style'] = "font-size:72px;fill:#0000ff";
	} elseif($value < 25) {
		$temp_level['style']="fill:#00ff00;stroke:none";
		$temp_value['style'] = "font-size:72px;fill:#00ff00";
	} else {
		$temp_level['style']="fill:#ff0000;stroke:none";
		$temp_value['style'] = "font-size:72px;fill:#ff0000";
	}
	
	header("Content-type: image/svg+xml");
	echo $svg_template->asXML();
?>
029996789

blocco 800846484
fax 0234889236
fax 0234884732

cod blocco er1958
fotocopia cdc fronte retro
dichiarazione di non riconoscimento e transazioni 18/01
data firma recapito telefonico

