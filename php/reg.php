<?php
	error_reporting(E_ALL ^ E_DEPRECATED);
	$c = mysql_connect("localhost", "phpuser", "password");
	if (!$c)
		die("Connection failed");
	mysql_select_db("keychat");

	if (!isset($_POST['username']) || !isset($_POST['password']))
		die("YO, YOU FORGOT THE DATA, BITCH");

	$username = mysql_real_escape_string($_POST["username"]);
	$password = mysql_real_escape_string($_POST["password"]);

	$check = mysql_query("select * from users where username = '$username'");

	if (!mysql_num_rows($check)) {
		$insertion = mysql_query("INSERT INTO users (username, password) VALUES ('$username','$password')");
		$user_id = mysql_insert_id();

		if (!$insertion) {
			die("DATABASE ERROR, BITCH");
		} else {
			session_start();
			$_SESSION["user_id"] = $user_id;
			$r = mysql_query("UPDATE users SET isonline=true WHERE id='$user_id'");
			header('Location: http://127.0.0.1/basic-chat.html');
		}
	} else {
		die("YOU ALREADY REGISTERED, BITCH!");
	}
?>
