<?php 
	$con = mysql_connect("Keychat", "phpuser", "password");
	if(!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("Keychat", $con)
		or die("Unable to connect to the database : " . mysql_error());

 ?>