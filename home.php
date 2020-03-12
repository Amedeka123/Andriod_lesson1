<?php 
 session_start();
 	if(!isset($_SESSION["id"])){

 		header("location:index.php");
 		die("Your name to login first");
 	}
 	$conn = mysqli_connect("localhost", "root", "", "nsrotution");
 	$id = $_SESSION["id"];
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title><?php echo $_SESSION["username"]; ?></title>
 </head>
 <body>
 	<?php echo $_SESSION["id"];?><br />
 	<?php echo $_SESSION["username"];?><br />
 	<?php echo $_SESSION["fname"];?><br />
 	<?php echo $_SESSION["lname"];?><br />
 	<form action="#" method="POST">
 		<input type="submit" name="signout" value="signout">
 	</form>
 	<?php if (isset($_POST["signout"])) {

 		session_destroy();

 		header("location:index.php");
 		
 	} ?>
 	<form action="#" method="POST">
 		<input type="submit" name="Delete" value="Delete">
 	</form>
 	<?php 
 		if(isset($_POST["Delete"])){

           mysqli_query($conn, "UPDATE users SET active='no' WHERE id = '$id'");

           session_destroy();

           header("location:index.php");

 			echo "account is delete";
 	}
 	 ?>
 </body>
 </html>
 