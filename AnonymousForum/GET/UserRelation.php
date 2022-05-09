<?php
	include "../linkDB.php";
	include "../jsonDecode.php";

	if( property_exists( $data, 'uid' ) && property_exists( $data, 'page' ) && property_exists( $data, 'type' ) ){
		$sql = "select pid from user_relation_info where uid = $data->uid and type = \"$data->type\" order by id desc limit $data->page,10";
		$result = mysqli_query($link, $sql);
		echo "{\"userData\":[";
		while($row = mysqli_fetch_array($result)){
			$sql = "select * from essay where pid = $row[pid]";
			$result_2 = mysqli_query($link, $sql);
			$row_2 = mysqli_fetch_array($result_2);
			echo str_replace("\n", "\\n","{\"pid\": $row_2[pid], \"title\": \"$row_2[title]\", \"content\": \"$row_2[content]\", \"praise\": $row_2[praise], \"bad\": $row_2[bad], \"collection\": $row_2[collection], \"cid\": \"$row_2[cid]\", \"create_time\": \"$row_2[create_time]\"");
			$sql = "select COUNT(*) FROM building where pid = $row_2[pid]";
			$result_3 = mysqli_query( $link, $sql );
			$row_3 = mysqli_fetch_array( $result_3);
			$replyCount = $row_3[0];
			echo ", \"replyCount\": $replyCount},";
		}
		echo "{}]}";
	}else{
		echo "error: lack uid or page or type";
	}

	mysqli_free_result($result);
	mysqli_close($link);
?>