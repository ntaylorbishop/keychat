<html><body>
 <?php

 	$username=isset($_POST["Username"])?$_POST["Username"]:"";

  	$password=isset($_POST["Password"])?$_POST["Password"]:"";

  	$email=isset($_POST["Email"])?$_POST["Email"]:"";


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
   		header('Location: http://chriskvamme/Keychat/error.html');
    else
   		header('Location: http://chriskvamme/Keychat/success.html');
	
    mysql_close($con);


 ?>
</body></html>