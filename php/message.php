<?php
	function send_message() {
		if (!isset($_POST["convo_id"]) || !isset($_POST["text"]))
			die("INVALID REQUEST MOTHERFUCKER");

		$convo_id = mysql_real_escape_string($_POST["convo_id"]);
		$message_text = mysql_real_escape_string($_POST["text"]);
		$r = mysql_query("SELECT id FROM conversations ='$their_username'");
		if (!mysql_num_rows($r))
			die("CONVERSATION DOES NOT EXIST MOTHERFUCKER");

		$o = mysql_result($r, 0);
		$r = mysql_query("INSERT INTO messages (convo_id,fromuser,text) VALUES ('$convo_id','$user_id','$message_text')");
	}

	function long_poll_for_messages() {
		while (!connection_aborted()) {
			$r = mysql_query("SELECT * FROM messages LEFT OUTER JOIN conversations WHERE (userone='$user_id' or usertwo='$user_id') and fromuser!='$user_id'");
			if (mysql_num_rows($r))
				break;
			sleep(1);
		}

		/* XXX: Actually write this part */

		echo json_encode($response);
	}

	session_start();
	$user_id = $_SESSION["user_id"];
	if (!isset($_SESSION["user_id"])) {
		die("YOU ARE NOT LOGGED IN, BITCH");
	}

	$con = mysql_connect('localhost','phpuser','password');
	if (!$con)
		die('Could not connect: ' . mysql_error($con));
	mysql_select_db("keychat");

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		send_message();
	} else if ($_SERVER['REQUEST_METHOD'] == "GET") {
		long_poll_for_messages();
	} else {
		/* return error */
		die();
	}
?>

