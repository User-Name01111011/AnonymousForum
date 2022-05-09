<?php
	include "../linkDB.php";
	include "../jsonDecode.php";

	if( property_exists( $data, 'cid' ) && property_exists( $data, 'page' )){
		$data->page = $data->page * 10;

		if($data->cid == '0'){
			$sql = "select * from essay order by pid desc limit $data->page, 10";
		}else{
			$sql = "select * from essay where cid = '$data->cid' order by pid desc limit $data->page, 10";
		}
		$result = mysqli_query($link, $sql);

		echo "{\"building\":[";
		while( $row = mysqli_fetch_array( $result ) ){
			echo str_replace("\n", "\\n","{\"pid\": $row[pid], \"title\": \"$row[title]\", \"content\": \"$row[content]\", \"praise\": $row[praise], \"bad\": $row[bad], \"collection\": $row[collection], \"cid\": \"$row[cid]\", \"create_time\": \"$row[create_time]\"");
			$sql = "select COUNT(*) FROM building where pid = $row[pid]";
			$result_2 = mysqli_query( $link, $sql );
			$row_2 = mysqli_fetch_array( $result_2);
			$replyCount = $row_2[0];
			echo ", \"replyCount\": $replyCount},";
		}
		echo '{}]';

		$sql = "select count(pid) from essay";
		$result = mysqli_query( $link, $sql );
		$row = mysqli_fetch_array( $result );
		echo ", \"count\": $row[0]}";
	}else{
		die( 'error: insert essay ,lack cid' );
	}

	mysqli_free_result($result);
	mysqli_close($link);
?>