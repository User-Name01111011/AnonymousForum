<?php
	include "../linkDB.php";
	include "../jsonDecode.php";

	if( property_exists( $data, 'email' ) && property_exists( $data, 'pwd' ) ){
		$sql = "INSERT INTO user (password, email) VALUES ('$data->pwd','$data->email')";
		$result = mysqli_query( $link, $sql );
		echo '{"uid":' . mysqli_insert_id( $link ) . '}';
	}

	mysqli_close($link);
?>