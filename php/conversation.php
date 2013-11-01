<?php
	error_reporting(E_ALL ^ E_DEPRECATED);
	function start_conversation() {
		if (!isset($_POST["their_username"]))
			die("INVALID REQUEST MOTHERFUCKER");

		$their_username = mysql_real_escape_string($_POST["their_username"]);
		$r = mysql_query("select id,isonline from users where username ='$their_username'");
		if (!mysql_num_rows($r))
			die("USERNAME DOES NOT EXIST MOTHERFUCKER");

		$o = mysql_result($r, 0);

		if (!$o['isonline'])
			die("USER IS NOT ONLINE, YO");

		$their_id = $o['id'];

		$r = mysql_query("INSERT INTO conversations (userone,usertwo) VALUES ('$their_id','$user_id')");
		$convo_id = mysql_insert_id();

		$response = array(
			"id" => $convo_id
		);

		echo json_encode($response);
	}

	function long_poll_for_conversations() {
		while (!connection_aborted()) {
			$r = mysql_query("SELECT * FROM conversations WHERE usertwo='$user_id' and conversation_rec='false'");
			if (mysql_num_rows($r))
				break;
			sleep(1);
		}

		$o = mysql_result($r, 0);
		$convo_id = $o['id'];
		mysql_query("UPDATE conversations SET conversation_rec='true' WHERE id='$convo_id'");

		$response = array(
			"convo_id" => $convo_id,
			"their_username" => $o['userone']
		);

		echo json_encode($response);
	}

	session_start();
	if (!isset($_SESSION["user_id"]))
		die("YOU ARE NOT LOGGED IN, BITCH");

	$user_id = $_SESSION["user_id"];
	$con = mysql_connect('localhost','phpuser','password');
	if (!$con)
		die('Could not connect: '.mysql_error($con));
	mysql_select_db("keychat");

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		start_conversation();
	} else if ($_SERVER['REQUEST_METHOD'] == "GET") {
		long_poll_for_conversation();
	} else {
		/* return error */
		die();
	}
?>

