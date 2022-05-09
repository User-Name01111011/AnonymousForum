<?php
	include "../linkDB.php";

	$sql = "select * from category";
	$result = mysqli_query( $link, $sql );

	if( !$result ){
		die( 'error' . mysqli_error( $link ) );
	}
	
	echo "{\"category\":[";
	while( $row = mysqli_fetch_array( $result  ) ){
		echo "{\"id\": $row[id], \"name\": \"$row[name]\" , \"introduce\": \"$row[introduce]\"},";
	}
	echo "{}]}";
?>