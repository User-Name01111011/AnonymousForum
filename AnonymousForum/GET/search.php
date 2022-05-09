<?php
	include "../linkDB.php";
	include "../jsonDecode.php";

	if( property_exists( $data, 'cid' ) || property_exists( $data, 'title' ) || property_exists( $data, 'pid' ) ){
		echo "{";
		if( property_exists( $data, 'cid' ) ){
			if( property_exists( $data, 'title' ) ){
				foreach( $data->title as $key => $value){
					$sql = "select * from essay where cid = \"$data->cid\" and title like \"%$value%\" order by create_time desc";
					$result = mysqli_query($link, $sql);

					echo "\"native\":[";
					while($row = mysqli_fetch_array($result)){
						echo "{\"pid\": $row[pid], \"title\": \"$row[title]\", \"content\": \"$row[content]\", \"praise\": $row[praise], \"bad\": $row[bad], \"collection\": $row[collection], \"cid\": \"$row[cid]\", \"create_time\": \"$row[create_time]\"},";
					}
					echo "{}],";
				}
			}
		}

		echo "\"whole\":[";
		if( property_exists( $data, 'pid' ) ){
			$sql = "select * from essay where pid = $data->pid";
			$result = mysqli_query($link, $sql);

			$row = mysqli_fetch_array($result);
			echo "{\"pid\": $row[pid], \"title\": \"$row[title]\", \"content\": \"$row[content]\", \"praise\": $row[praise], \"bad\": $row[bad], \"collection\": $row[collection], \"cid\": \"$row[cid]\", \"create_time\": \"$row[create_time]\"},";
		}

		if( property_exists( $data, 'title' ) ){
			foreach( $data->title as $key => $value){
				$sql = "select * from essay where title like \"%$value%\" order by create_time desc";
				$result = mysqli_query($link, $sql);

				while($row = mysqli_fetch_array($result)){
					echo "{\"pid\": $row[pid], \"title\": \"$row[title]\", \"content\": \"$row[content]\", \"praise\": $row[praise], \"bad\": $row[bad], \"collection\": $row[collection], \"cid\": \"$row[cid]\", \"create_time\": \"$row[create_time]\"},";
				}
				echo "{}]";
			}
		}
		echo "}";

		mysqli_free_result($result);
		mysqli_close($link);
	}
?>