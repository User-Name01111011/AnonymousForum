<?php
	header("content-type:text/html;charset=utf-8");
	$link = mysqli_connect("localhost",'admin','char_000414yu');
	mysqli_query($link,'SET NAMES UTF8');
	//mysqli_select_db($link,'anonymousforum');
	$result = mysqli_query($link,"use anonymousforum;");
?>