<html><body> 
 <?php
	//phpinfo();
  	$username=isset($_POST["user"])?$_POST["user"]:"";

  	$password=isset($_POST["pwd"])?$_POST["pwd"]:"";

  	/*connect to DB */
	include 'dbcon.php';
	
	/* check to see if user exists */
	$query1 = " select * from users where username = '".mysql_escape_string($username)."'";

    $check = mysql_query($query1);

    if (mysql_num_rows($check) == 0){
	echo "doesn't exist...  ";
	/* make user */
	$query2 = "INSERT INTO users(username, password)VALUES";
	$query2 = $query2 . "('".mysql_escape_string($username)."','".mysql_escape_string($password)."')";

	$insertion = mysql_query($query2);

	/* confirm it worked */
	$query3 = " select * from users where username = '".mysql_escape_string($username)."'";

	$confirm = mysql_query($query3);

	if (mysql_num_rows($confirm) == 0)
	   	echo "error registering";	
		
	else
	   	//include 'login.php';*/
		echo "You have been succesfully registered";
	}
		
    else
   	/* login */
	//include 'login.php';
	echo "You already exist so we will log you in";

    mysql_close($con);

 ?>
</body></html>
