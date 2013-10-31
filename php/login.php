<?php
	$c = mysql_connect("localhost", "phpuser", "password");
	if (!$c)
		die("DATABASE ERROR, BITCH");
	mysql_select_db("keychat");

	$username = mysql_real_escape_string($_POST['user']);
	$password = mysql_real_escape_string($_POST['pwd']);

	$loginquery = "select * from users where username = '$username' and password = '$password'";
	$loginresult = mysql_query($loginquery);

	if (mysql_num_rows($loginresult) == 0) {
		die("YO, COULDN't LOG IN, BITCH!");
	} else {
		session_start();
		$_SESSION["user_id"] = $loginresult['id'];
		$loginquery = "UPDATE users SET isonline='1' WHERE id='$user_id'";
		mysql_query($loginquery);
		header('Location: http://127.0.0.1/basic-chat.html');
	}
?>
