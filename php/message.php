<?php
	error_reporting(E_ALL ^ E_DEPRECATED);
	function send_message($user_id) {
		if (!isset($_POST["convo_id"]) || !isset($_POST["text"]))
			die("INVALID REQUEST MOTHERFUCKER");

		$convo_id = mysql_real_escape_string($_POST["convo_id"]);
		$message_text = mysql_real_escape_string($_POST["text"]);
		$r = mysql_query("SELECT id FROM conversations WHERE id='$convo_id'");
		if (!mysql_num_rows($r))
			die("CONVERSATION DOES NOT EXIST MOTHERFUCKER");

		$r = mysql_query("INSERT INTO messages (convo_id,fromuser,message) VALUES ('$convo_id','$user_id','$message_text')");
	}

	function long_poll_for_messages($user_id) {
		session_write_close();
		while (true) {
			if (connection_aborted())
				die();
			$r = mysql_query("SELECT m.id,m.message,m.fromuser,c.id as convo_id,c.userone,c.usertwo,u.username FROM messages m, conversations c, users u WHERE m.convo_id=c.id and (userone='$user_id' or usertwo='$user_id') and fromuser!='$user_id' and (userone=u.id or usertwo=u.id) and (u.id!='$user_id')");
			if (mysql_num_rows($r))
				break;
			sleep(1);
		}

		$o = mysql_fetch_assoc($r);
		$mid = $o['id'];
		mysql_query("DELETE FROM messages WHERE id='$mid'");

		$response = array(
			"convo_id" => $o['convo_id'],
			"their-username" => $o['username'],
			"text" => $o['message']
		);

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

	if ($_SERVER['REQUEST_METHOD'] == "POST")
		send_message($user_id);
	else if ($_SERVER['REQUEST_METHOD'] == "GET")
		long_poll_for_messages($user_id);
	else
		die("INVALID METHOD, BITCH");
?>
