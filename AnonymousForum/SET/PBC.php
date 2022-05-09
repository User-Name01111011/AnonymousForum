<?php
	include "../linkDB.php";
	include "../jsonDecode.php";

	if( property_exists( $data, 'uid' ) && property_exists( $data, 'type') && property_exists( $data, 'pid') ){
		$sql = "select * from user_relation_info where pid = $data->pid and uid = $data->uid and type = \"$data->type\"";
		$result = mysqli_query($link, $sql);

		if($row = mysqli_fetch_array($result) ){//对此pid进行过此操作
			echo "{\"state\": false }";
			die();
		}

		$sql = "insert into user_relation_info (uid, pid, type) values($data->uid, $data->pid, \"$data->type\")";
		$result = mysqli_query($link, $sql);
		$sql = "UPDATE essay SET $data->type = $data->type + '1' WHERE (pid = $data->pid)";
		$result = mysqli_query($link, $sql);
		if($result){
			echo "{\"state\": true }";
		}else{
			echo "{\"state\": \"error\"}";
		}
	}else{
		die( 'error: insert reply ,lack pid || floor || text' );
	}

	mysqli_close($link);
?>