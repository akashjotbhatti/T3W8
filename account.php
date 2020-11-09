<?php
// start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>The Baking Box | Admin</title>
	<link rel="stylesheet" type="text/css" href="css/site.css">
</head>
<body>
	<a href="logout.php" id="logout">Logout</a>

	<?php
	// connect to db
	include('dbConfig.php');

	// get details from db to display on screen
	$sql = "SELECT * FROM form";
	$results = mysqli_query($con, $sql);

	foreach($results as $user){
	?>
		<div class="profile-card" data-id="<?=$user["id"]?>">
			<div class="details">
				<span id="bold"><?=$user["fullName"]?></span><br />
				<span><?=$user["email"]?></span><br />
				<span><?=$user["phoneNumber"]?></span><br />
				<span><?=$user["country"]?></span><br />
				<span><?=$user["age"]?></span><br />
			</div>
		</div>	
	<?php
	}
	?>

</body>
</html>