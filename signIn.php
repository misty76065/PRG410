<link href="styles.css" rel="stylesheet" type="text/css">

<div>
<?php
include("connection.php");
include("header.php");

?>
	</div>
<div class="wrapper">
<div class="signForm">
<h1>Sign In</h1>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="signIn" class="form2">
		<label>User Name</label> <input name="username" type="text" id="username" form="signIn"><br/>
		<label>Password</label> <input name="password" type="text" id="password" form="signIn"><br/>
		<input type="submit" value="Sign In" class="submit"> <br/>
	</form>
	
	<?php
	$secure_userpass=hash('sha256', $password);
	
	//see if the user is already signed in
	if(isset($_SESSION['signedIn'])&& $_SESSION['signedIn']==TRUE)
	{
		echo "Click here to <a href='logOut.php'>sign out <br></a>";
	}
	else{
		echo "Please Join Now <br/>";
	}

	//check sign in information
	if(isset($_POST['username'])and isset($_POST['password'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		//check database for match
		$query="SELECT * FROM users WHERE username = '$username' and password = '$secure_userpass'";
		$results = mysqli_query($connect, $query) or die(mysqli_error($connect));
		$count = mysqli_num_rows($results);
		//create sessions
		if ($count ==1){
			$_SESSION['signedIn'] = $_POST['username'];
		}
		else{
			echo "Your user name or password is incorrect, please trye again";
		}
		
	}
	//if they are already logged in
	if(isset($_SESSION['signedIn'])){
		$user = $_SESSION['signedIn'];
		header('Location:project.php');
	}
	else{
		echo "<a href='signUp.php'>click here </a> to register for an account.<br/>";
	}
	?>
  </div>
</div>
	</section>
	<?php
	include ("footer.php");
	?>