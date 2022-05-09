<?php
	include "../linkDB.php";
	include "../jsonDecode.php";

	if( property_exists( $data, 'pid' ) && property_exists( $data, 'page' ) ){
		$start = ($data->page - 1) *10 ;
		$sql = "select * FROM building where pid = $data->pid LIMIT $start, 10 ";
		$result = mysqli_query($link, $sql);
		echo "{\"floors\":[";
		while( $row = mysqli_fetch_array( $result) ){
			echo str_replace("\n", "\\n","{ \"floor\": $row[floor], \"praise\": $row[praise], \"bad\": $row[bad], \"content\": \"$row[content]\", \"reply\": $row[reply], \"create_time\": \"$row[create_time]\" },");
		}
		echo "{}]}";
		
	}else{
		die( 'error: select building ,lack title || content || cid' );
	}

	mysqli_free_result($result);
	mysqli_close($link);
?>