<?php
// start session
session_start();

// create empty variable to add to later
$errorMessage = '';

if(isset($_POST['username'])){

	// get db details and connect
	include("dbConfig.php");

	//set data from the form into variables
	$username = mysqli_real_escape_string($con, $_POST['username']);
	$password = mysqli_real_escape_string($con, $_POST['password']);

	$sql = "SELECT * FROM users WHERE username = '$username'";
	$results = mysqli_query($con, $sql);
	$user = mysqli_fetch_assoc($results);

	// check if entered data is correct
	//if ($username == $username && password_verify($password, $password)) {
	if ($user) {
		//start and set session
		session_start();
		$_SESSION["userid"] = $user["id"];
		header("location: account.php");
	} else {
		// add message to variable set earlier 
		$errorMessage = "That username or password combination was incorrect. <br /> Please try again.";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>The Baking Box | Login</title>
	<link rel="stylesheet" type="text/css" href="css/site.css">
</head>
<body>
	<div id="wrapper">
		<h1>Login</h1>
		<form action="login.php" method="post">
			<!-- place error message here -->
			<?php if ($errorMessage != ''): ?>
			    <div class="alert">
			        <?php echo $errorMessage; ?>
			    </div>
			<?php endif; ?>
			<input type="text" name="username" placeholder="Username">
			<input type="password" name="password" placeholder="Password">
			<button type="submit" name="submit">Login</button>
		</form>
	</div>
</body>
</html>