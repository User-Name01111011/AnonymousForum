<?php
	include "../linkDB.php";
	include "../jsonDecode.php";

	if( property_exists( $data, 'id' ) ){
		$id = $data->id;
		$sql = "select uid,praise_sum,state from user where uid = $id";
	}
	if( property_exists( $data,'email') ){
		$email = $data->email;
		$sql = "select email,praise_sum,state from user where email = '$email'";
	}

	if( property_exists( $data,'pwd') ){
		$pwd =$data->pwd;
		if( property_exists( $data, 'id' ) ){
			$sql = "select * from user where uid = $id and password = \"$pwd\"";
		}elseif( property_exists( $data,'email') ){
			$sql = "select * from user where email = \"$email\" and password = \"$pwd\"";
		}
	}

	if( !isset( $sql ) ){
		die( '$sql undefine' );
	}
	$result = mysqli_query($link, $sql);
	
	if( !$result ){
		die( 'error' . mysqli_error( $link ) );
	}

	if( $row = mysqli_fetch_array( $result ) ){
		if( isset( $row[ 'password' ] ) ){
			echo "{ \"state\" : 0, \"uid\" : $row[uid]}";//登陆成功
		}else{
			echo "{ \"state\" : 2 ,\"userInfo\":{\"praise_sum\": $row[praise_sum],\"state\": \"$row[state]\"}}";//账号存在
		}
	}else{
		if( isset( $pwd ) ){
			echo '{ "state" : 1 }';//密码错误
		}else{
			echo '{ "state" : 3 }';//账号不存在
		}
	}

	mysqli_free_result($result);
	mysqli_close($link);
?>