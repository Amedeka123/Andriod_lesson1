<?php session_start(); 

if(isset($_SESSION["id"])){

 	header("location:home.php");
 	
}

	// how to connect to your sever and access database by mySQL
$conn = mysqli_connect("localhost", "root", "", "nsrotution");

if(!$conn){
	echo "unable connect";
}


 ?>
<?php  ?>
<!DOCTYPE html>
<html>
<head>
	<title>NsroTution</title>
</head>
	<body>	
		
		<form action="#" method="POST">
	 		<input type="text" name="username" placeholder="please Enter username"><br/>
	        <br>
	        <input type="password" name="password" placeholder="password"><br />
	        <br>
			<input type="submit" name="signin" value="sign In"><br />
			<br>
		</form>	
 


       <form action="#" method="POST">
	        <input type="text" name="username" placeholder="userName"><br/>
	        <br>
	        <input type="text" name="fname" placeholder="FirstName"><br />
	        <br>
	        <input type="text" name="lname" placeholder="LastName"><br />
	        <br>
	        <input type="password" name="password" placeholder="password"><br />
	        <br>
	        <input type="password" name="repeatpassword" placeholder=" repeatpassword"><br />
	        <br>
			<input type="submit" name="signup" value="sign Up"><br /><br>
			<br>
		</form>

	</body><?php  ?>
</html>
<?php  
		// sign up codes.	
	if (isset($_POST["signup"])) { // triger if
		$username = $_POST["username"];
		$fname = $_POST["fname"];
		$lname = $_POST["lname"];
		$password = $_POST["password"];
		$repeatpassword = $_POST["repeatpassword"];
		
				// username,password and should not be empty.
		if ($username != "" AND $password != "" AND $repeatpassword != "") {

				// confirming of password
			
			if ($repeatpassword === $password ) {
		 

				// query username from mySQL database
		      $query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' AND active='yes'");
		     	
		      $numOfRow = mysqli_num_rows($query);
		      	// checking wealther user exit or not
		      if($numOfRow != 0){

		      	echo 'username Already Exist';
		     }else{
		     	//echo 'Account created';
		     	$enc_pass = md5($password);

		     	mysqli_query($conn,"INSERT INTO users(username,fname,lname,password)
		     	 VALUES('$username','$fname','$lname','$enc_pass')");
		     }


			}else{
				echo '<span style="color:red" >password does not match!</span>';
			}
		}else{
			echo '<span style="color:red" >please no field should be empty!</span>';
		}
		
	}
	
		
 	if(isset($_POST["signin"])){

		$username = $_POST["username"];
		$password = $_POST["password"];

		if($username != ""){
			if($password != ""){
				$enc_password=md5($password);
				$query = mysqli_query($conn,"SELECT * FROM users WHERE username='$username' AND password='$enc_password' AND active = 'yes'");
				$numOfRow = mysqli_num_rows($query);
				if($numOfRow != 0){
					$fetch = mysqli_fetch_assoc($query);
					$_SESSION["id"] = $fetch["id"];
					$_SESSION["username"]=$fetch["username"];
					$_SESSION["fname"] = $fetch["fname"];
					$_SESSION["lname"] = $fetch["lname"];
					header("location:home.php");
	
				}else{
					echo "password amd username does not match";	
				}
			}else{
				echo "Enter password";
			}

		}else{
			echo"Enter username";
		}
	}
?>