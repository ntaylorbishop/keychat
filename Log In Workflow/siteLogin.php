<html><body>
 <?php
   $con = mysql_connect("localhost", "phpuser", "password");
   if (!$con)
   {
   		die('Could not connect : ' . mysql_error());
   }
   mysql_select_db("phptest", @con)
   		or die ("Unable to select database:" . mysql_error());
   $query = "select * from users where id= '" ;
   $query = $query . $_POST['id'] . "' and pw = '" . $_POST['pw'] . "'";

   $result = mysql_query($query);

   if (mysql_num_rows($result) == 0)
   		header('Location: http://localhost/error.html');
   else
   		header('Location: http://localhost/success.html');
	
   mysql_close($con);

 ?>
</body></html>