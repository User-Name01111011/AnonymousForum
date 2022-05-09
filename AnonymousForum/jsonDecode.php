<?php
	$json = file_get_contents("php://input");
	if(ini_get("magic_quotes_gpc")=="1"){
		$json=stripslashes($json_string);
	}
	$data = json_decode( $json );
?>