<html><body> 
 <?php

 	$c = mysql_connect("localhost", "phpuser", "password");
	if (!$c) {
		echo "Database connection failed!\n";
		die();
	}
	//phpinfo();
  	$username=isset($_POST["user"])?$_POST["user"]:"";

  	$password=isset($_POST["pwd"])?$_POST["pwd"]:"";

  	/*connect to DB */
	//include 'dbcon.php';

	/* check to see if user exists */
	$query1 = " select * from users where username = '".mysql_escape_string($username)."'";

    $check = mysql_query($query1);

    if (mysql_num_rows($check) == 0){
		/* make user */
		$query2 = "INSERT INTO users(username, password)VALUES";
		$query2 = $query2 . "('".mysql_escape_string($username)."','".mysql_escape_string($password)."')";

		$insertion = mysql_query($query2);
		$id = mysql_insert_id();

		if (mysql_num_rows($confirm) == 0)
		   	echo "error registering";	
			
		else {
			echo "You have been succesfully registered";
			session_start();
			$_SESSION["user_id"] = $loginresult['id'];
			echo "<html><body> Success logging in </body></html>";
			$loginquery = "UPDATE users SET isonline='1' WHERE id='$user_id'";
			mysql_query($loginquery);

		}

	}
		
    else {
    	echo "you already exist";
    }
   	

    mysql_close($con);

 ?>
</body></html>
