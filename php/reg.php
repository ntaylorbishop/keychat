<html><body>
 <?php

 	$username=isset($_POST["username"])?$_POST["username"]:"";

  	$password=isset($_POST["password"])?$_POST["password"]:"";

	$con = mysql_connect("Keychat", "phpuser", "password");
		if(!$con)
		{
			die('Could not connect: ' . mysql_error());
		}
		mysql_select_db("Keychat", $con)
			or die("Unable to connect to the database : " . mysql_error());

		$query="INSERT INTO Users(userName, password)VALUES('".mysql_escape_string($username)."'
		,'".mysql_escape_string($password)."')";

	$result = mysql_query($query);


	$query2 = " select * from Users where userName = '".mysql_escape_string($username)."'";

    $result2 = mysql_query($query2);

    if (mysql_num_rows($result2) == 0)
   		header('Location: http://Keychat/error.html');
    else
   		header('Location: http://Keychat/success.html');
	
    mysql_close($con);


 ?>
</body></html>