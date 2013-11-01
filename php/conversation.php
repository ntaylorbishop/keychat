<?php
	error_reporting(E_ALL ^ E_DEPRECATED);
	function start_conversation($user_id) {
		if (!isset($_POST["their_username"]))
			die("INVALID REQUEST MOTHERFUCKER");

		$their_username = mysql_real_escape_string($_POST["their_username"]);
		$r = mysql_query("select id,isonline from users where username ='$their_username'");
		if (!mysql_num_rows($r))
			die("USERNAME DOES NOT EXIST MOTHERFUCKER");

		$o = mysql_fetch_assoc($r, 0);

		if (!$o['isonline'])
			die("USER IS NOT ONLINE, YO");

		$their_id = $o['id'];

		$r = mysql_query("INSERT INTO conversations (userone,usertwo) VALUES ('$user_id','$their_id')");
		$convo_id = mysql_insert_id();

		$response = array(
			"id" => $convo_id,
			"their-username" => $their_username
		);

		echo json_encode($response);
	}

	function long_poll_for_conversations($user_id) {
		session_write_close();
		while (true) {
			if(connection_aborted())
				die();
			$r = mysql_query("SELECT *,c.id AS tbl_convo_id FROM conversations c,users u WHERE c.userone=u.id and usertwo='$user_id' and conversation_rec='false'");
			if (mysql_num_rows($r))
				break;
			sleep(1);
		}

		$o = mysql_fetch_assoc($r, 0);
		$convo_id = $o['tbl_convo_id'];
		mysql_query("UPDATE conversations SET conversation_rec='true' WHERE id='$convo_id'");

		$response = array(
			"id" => $convo_id,
			"their-username" => $o['username']
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
		start_conversation($user_id);
	} else if ($_SERVER['REQUEST_METHOD'] == "GET") {
		long_poll_for_conversations($user_id);
	} else {
		die("SOMETHING TERRIBLE HAPPENED, BITCH!");
	}
?>

