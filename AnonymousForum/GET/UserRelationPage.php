<?php
	include "../linkDB.php";
	include "../jsonDecode.php";

	if( property_exists( $data, 'uid' ) ){
		$sql = "select count(*) from user_relation_info where uid = $data->uid , type = 'essay'"
		$result = mysqli_query($link, $sql);
		$row = mysqli_fetch_array($result);
		echo "{\"essay\":$row[0],";
		$sql = "select count(*) from user_relation_info where uid = $data->uid , type = 'collection'"
		$result = mysqli_query($link, $sql);
		$row = mysqli_fetch_array($result);
		echo "\"collection\": $row[0] }";
	}else{
		echo "UserRelationPage error: lack uid";
	}

	mysqli_free_result($result);
	mysqli_close($link);
?>