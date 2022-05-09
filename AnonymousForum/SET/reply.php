<?php
	include "../linkDB.php";
	include "../jsonDecode.php";

	if( property_exists( $data, 'pid' ) && property_exists( $data, 'floor') && property_exists( $data, 'text') && property_exists( $data, 'uid') ){
		$sql = "select floor from building where pid = $data->pid order by id desc limit 1";
		$result = mysqli_query($link, $sql);

		$reply = mysqli_fetch_array($result);
		if(!$reply){$reply[0] = 1;}
		else{$reply[0]++;}

		$sql = "INSERT INTO building (floor, pid, content, reply) VALUES ($reply[0], $data->pid, \"$data->text\", $data->floor)";

		$result = mysqli_query($link, $sql);
		if($result){
			$sql = "insert into user_relation_info (uid, pid, type) values($data->uid, $data->pid, \"reply\")";
			echo "{\"state\": true }";
		}else{
			echo "{\"state\": false}";
		}
	}else{
		die( 'error: insert reply ,lack pid || floor || text' );
	}

	mysqli_close($link);
?>