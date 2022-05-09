<?php
	include "../linkDB.php";
	include "../jsonDecode.php";

	if( property_exists( $data, 'title' ) && property_exists( $data, 'content') && property_exists( $data, 'cid') && property_exists( $data, 'uid' ) ){
		$sql = "INSERT INTO essay (title, content, cid, uid) VALUES (\"$data->title\", \"$data->content\", \"$data->cid\", \"$data->uid\")";
		$result = mysqli_query($link, $sql);
		if($result){
			$pid = mysqli_insert_id($link);
			if($data->uid >= 0){
				$sql = "insert into user_relation_info (uid, pid, type) values($data->uid, $pid, \"essay\")";
				$result = mysqli_query($link, $sql);
			}

			$sql = "select * from essay where pid = $pid";
			$result = mysqli_query($link, $sql);
			$row = mysqli_fetch_array($result);
			echo str_replace("\n", "\\n","{\"state\": true, \"details\":{\"pid\": $row[pid], \"title\": \"$row[title]\", \"content\": \"$row[content]\", \"praise\": $row[praise], \"bad\": $row[bad], \"collection\": $row[collection], \"cid\": \"$row[cid]\", \"create_time\": \"$row[create_time]\"}}");
		}else{
			echo "{'state': false}";
		}
	}else{
		die( 'error: insert essay ,lack title || content || cid' );
	}

	mysqli_close($link);
?>