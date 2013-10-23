<?php

$con = mysqli_connect('localhost','phpuser','password','KeyChat');

if (!$con)
  {
	  die('Could not connect: ' . mysqli_error($con));
  }

  $user_id = $_SESSION["user_id"];
  $reciever_id = isset($_POST["receiver_id"])?$_POST["receiver_id"]:"";


  $reciever_Query = " select * from Conversations where (( userone ='".mysql_escape_string($receiver_id)."' && usertwo '".mysql_escape_string($user_id)."' ) OR (userone ='".mysql_escape_string($receiver_id)."' && usertwo '".mysql_escape_string($user_id)."'));";
  $loginresult = mysql_query($loginquery);

  if (mysql_num_rows($loginresult) == 0)
  {
  	#no current conversation between the two users
  	#break?
  }
 
 
  $row = mysqli_fetch_array($result)
  $conversation_id = $row['id']
  $coverstionMessages = " select * from Messages where convo_id = '".mysql_escape_string($conversation_id)."' ORDER BY messageDateTime;";
  



?>

