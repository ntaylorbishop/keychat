<?php

$con = mysqli_connect('localhost','phpuser','password','KeyChat');

if (!$con)
  {
	  die('Could not connect: ' . mysqli_error($con));
  }

  $user_id = $_SESSION["user_id"];
  $receiver = isset($_POST["receiver"])?$_POST["receiver"]:"";


  $reciever_Query = " select user_id from Users where username ='".mysql_escape_string($receiver).'"';
  $loginresult = mysql_query($loginquery);

  if (mysql_num_rows($loginresult) == 0)
  {
  	$createConversation = " insert into Conversations (userone) VALUES ('".mysql_escape_string($user_id)."');";
  }
  else
  {
  	$row = mysqli_fetch_array($result)
  	$reciever_id = $row['id']
  	$createConversation = " insert into Conversations (userone, usertwo) VALUES ( '".mysql_escape_string($reciever_id)"' , '".mysql_escape_string($user_id)."');";
  }



?>

