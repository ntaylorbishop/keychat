<html><body>
 <?php

 	$username=isset($_POST["Username"])?$_POST["Username"]:"";

  	$password=isset($_POST["Password"])?$_POST["Password"]:"";

  	/*connect to DB */
	include 'dbcon.php';
	
	/* check to see if user exists */
	$query1 = " select * from Users where userName = '".mysql_escape_string($username)."'";

    $check = mysql_query($query1);

    if (mysql_num_rows($check) == 0)
	   	/* make user */
		$query2="INSERT INTO Users(userName, password)VALUES('".mysql_escape_string($username)."'
		,'".mysql_escape_string($password)."')";

		$insertion = mysql_query($query2);

		/* confirm it worked */
		$query3 = " select * from Users where userName = '".mysql_escape_string($username)."'";

	    $confirm = mysql_query($query3);

	    if (mysql_num_rows($confirm) == 0)
	   		header('Location: http://chriskvamme/Keychat/error.html');
	    else
	   		include 'login.php';
    else
   		/* login */
		include 'login.php';

    mysql_close($con);


 ?>
</body></html>