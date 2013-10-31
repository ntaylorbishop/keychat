<?php
	$c = mysql_connect("localhost", "phpuser", "password");
	if (!$c) {
		echo "Database connection failed!\n";
		die();
	}
	mysql_select_db("keychat");

	$username = mysql_real_escape_string($_POST['user']);
	$password = mysql_real_escape_string($_POST['pwd']);

	$loginquery = "select * from users where username = '$username' and password = '$password'";
	$loginresult = mysql_query($loginquery);

	if (mysql_num_rows($loginresult) == 0) {
   		echo "<html><body> Failure logging in </body></html>";
	} else {
		session_start();
		$_SESSION["user_id"] = $loginresult['id'];
		echo "<html><body> Success logging in </body></html>";
		$loginquery = "UPDATE users SET isonline='1' WHERE id='$user_id'";
		mysql_query($loginquery);
	}
?>
