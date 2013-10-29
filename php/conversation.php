<?php
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
		return null;
	}

	$user_id = $_SESSION["user_id"];
	if (!isset($_SESSION["user_id"])) {
		die("YOU ARE NOT LOGGED IN, BITCH");
	}

	$con = mysql_connect('localhost','phpuser','password');
	if (!$con)
		die('Could not connect: ' . mysql_error($con));

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		start_conversation();
	} else if ($_SERVER['REQUEST_METHOD'] == "GET") {
		long_poll_for_conversation();
	} else {
		/* return error */
		die();
	}
?>

