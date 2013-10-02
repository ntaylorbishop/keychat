<?php 
	
    $loginquery = " select * from Users where userName = '".mysql_escape_string($username)."' and password = '".mysql_escape_string($password)."'";
   	$loginresult = mysql_query($loginquery);


	if (mysql_num_rows($loginresult) == 0)
   		echo "<html><body> Failure logging in </body></html>";
   else
   		session_start();
		$sid = session_id();
		$_SESSION["userName"] = $username;
   		echo "<html><body> Success logging in </body></html>";
	
   mysql_close($con);

 ?>