
 <?php
 
if (isset($_POST['submit'])) { 
 include_once 'connect.php' ;


 
  $ime = mysqli_real_escape_string($dbc, $_POST['ime']);
  $prezime = mysqli_real_escape_string($dbc, $_POST['prezime']);
  $email = mysqli_real_escape_string($dbc, $_POST['email']);
  $uname = mysqli_real_escape_string($dbc, $_POST['uname']);
  $pass = mysqli_real_escape_string($dbc, $_POST['pass']);



	if(empty($ime) || empty($prezime) || empty($email) || empty($uname) || empty($pass)) {
	
		 header("location ../sign_up.php?signup=empty") ;
	exit(); 
}

	
	else {
			if (!preg_match("/^[a-zA-Z]*$", $ime) || !preg_match("/^[a-zA-Z]*$", $prezime)) {
				header("location ../sign_up.php?signup=invalid") ;
				exit();
			} else {
			
				if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
					header("location ../sign_up.php?signup=email") ;
				exit();
				} else {
					$sql="SELECT * FROM users WHERE user_uname='$uname'";
					$result=mysqli_query($dbc, $sql) ;
					$result_check=mysqli_num_rows($result) ;
					
					if($resultCheck > 0) {
						header("location ../sign_up.php?signup=usertaken") ;
				exit();
					} else {
						$hashedPWD=password_hash($pass, PASSWORD_DEFAULT);
						$sql="INSERT INTO users (user_ime, user_prezime, user_email, user_username, user_lozinka)
						VALUES ('$ime', '$prezime', '$email', '$uname','$hashedPWD');" ;
						mysqli_query($dbc, $sql);
						header("location ../sign_up.php?signup=success") ;
				exit();
					}
				} 
			}
	}
	} else {
	header("location ../sign_up.php");
	
	exit();  }
 ?>
 
 
<html>


<body>
<div>
		<main>
		<h2> Signup </h2>
				<form method="POST" action="form.php">
					<input type="text" name="ime"  placeholder="Ime">
					<input type="text" name="prezime" placeholder="Prezime">
					<input type="text" name="email"  placeholder="email">
					<input type="text" name="uname" placeholder="username">
					<input type="password" name="pass" placeholder="password">
					<button type="submit" name="submit"> Prijava </button>
					
				</form>
				<a href="form.php"> Sign in </a>
	
	</main>
</div>
</html>
