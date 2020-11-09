<?php
// get db connection details
include('dbConfig.php');

// check if the submit button was clicked
if(isset($_POST['submit'])){

	// check if the form fields are empty or not
	if(!empty($_POST['fullName']) && !empty($_POST['email']) && !empty($_POST['phoneNumber']) && !empty($_POST['country']) && !empty($_POST['age'])){

		// save the data inserted into variables
		$fullName = $_POST['fullName'];
		$email = $_POST['email'];
		$phoneNumber = $_POST['phoneNumber'];
		$country = $_POST['country'];
		$age = $_POST['age'];

		// insert the data into the db
		$sql = "INSERT INTO form (fullName, email, phoneNumber, country, age) VALUES ('$fullName', '$email', '$phoneNumber', '$country', '$age')";
		$results = mysqli_query($con, $sql);

		// send the user to success or alert them of error
		if($results){
			header("location: uploadSuccess.php");
		} else {
			?>
			<p>Something seems to have went wrong.</p>
			<?php
		}
	// if form fields are missing tell user
	} else {
		?>
		<p>All fields are required.</p>
		<?php
	}

	$file = $_FILES['file'];
	//print_r($file);

	// the information we are given when files are uploaded
	$fileName = $_FILES['file']['name'];
	$fileTmpName = $_FILES['file']['tmp_name'];
	$fileSize = $_FILES['file']['size'];
	$fileError = $_FILES['file']['error'];
	$fileType = $_FILES['file']['type'];

	// get the file name and extension type
	$fileExt = explode('.', $fileName);

	// lowercase the extension to avoid problems with uploading
	$fileActualExt = strtolower(end($fileExt));

	// specify allowed files types
	$allowed = array('jpg', 'jpeg', 'gif', 'png');

	// check if the file type is allowed
	if (in_array($fileActualExt, $allowed)) {
		// if there are no errors check file size and upload or provide error message
		if ($fileError === 0) {
			// if the file size is accepted, give it a unique id, move it into the assets folder, and go to success page
			if ($fileSize < 1000000){
				$fileNameNew = uniqid('', true).".".$fileActualExt; // ensure files don't have the same name
				$fileDestination = 'assets/'.$fileNameNew; // set the location for uploaded files
				move_uploaded_file($fileTmpName, $fileDestination); // put the files into the set location
				header("location: uploadSuccess.php"); // tell user files uploaded successfully
			// error messages to tell user what went wrong
			} else {
				?>
				<p>Sorry, the file you tried to upload is too big.</p>
				<?php
			}
		} else {
			?>
			<p>Sorry, there was an error uploading your file.</p>
			<?php
		}
	} else {
		?>
		<p>Please upload a .jpg, .jpeg, .gif, or .png file.</p>
		<?php
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>The Baking Box</title>
	<link rel="stylesheet" type="text/css" href="css/site.css">
	<script src="https://kit.fontawesome.com/26cc814c09.js" crossorigin="anonymous"></script>
</head>
<body>
	<div class="wrapper">
		<div class="logo">
			<a href="index.php"><img src="imgs/logo.png" alt="The Baking Box logo"></a>
		</div>
		<div class="content">
			<a href="login.php" id="login">Login</a>
			<div class="left">
				<h1>Our new site is lauching soon</h1>
				<span>In the mean time leave your infomation to stay in the loop</span>
			</div>
			<div class="right">
				<form action="index.php" method="post" enctype="multipart/form-data">
					<input type="text" name="fullName" placeholder="Full Name">
					<input type="text" name="email" placeholder="Email">
					<input type="text" name="phoneNumber" placeholder="Phone Number">
					<input type="text" name="country" placeholder="Country">
					<input type="text" name="age" placeholder="Age">
					<input type="file" name="file">
					<button type="submit" name="submit">Submit</button>
				</form>
			</div>
		</div>
		<div class="social">
			<a href="#"><i class="fas fa-envelope"></i></a>
			<a href="#"><i class="fab fa-facebook-f"></i></a>
			<a href="#"><i class="fab fa-instagram"></i></a>
			<a href="#"><i class="fab fa-pinterest-p"></i></a>
		</div>
		
		<div class="gallery">
			<div class="gallery-item">
				<img class="gallery-image" src="imgs/IMG_8154.jpg" alt="The Baking Box's Mint Brownies">
			</div>

			<div class="gallery-item">
				<img class="gallery-image" src="imgs/IMG_8156.jpg" alt="The Baking Box's Chocolate Chip Cookies">
			</div>

			<div class="gallery-item">
				<img class="gallery-image" src="imgs/IMG_8158.jpg" alt="The Baking Box's Chocolate Cupcakes">
			</div>

			<div class="gallery-item">
				<img class="gallery-image" src="imgs/IMG_8160.jpeg" alt="The Baking Box's Gingerbread Cookies">
			</div>

			<div class="gallery-item">
				<img class="gallery-image" src="imgs/IMG_8159.jpg" alt="The Baking Box's Vanilla Cupcakes">
			</div>

			<div class="gallery-item">
				<img class="gallery-image" src="imgs/IMG_8157.jpg" alt="The Baking Box's Nutella Stuffed Cookies">
			</div>

			<div class="gallery-item">
				<img class="gallery-image" src="imgs/IMG_8153.jpg" alt="The Baking Box's Biscoff Brownies">
			</div>
		</div>
	</div>
</body>
</html>