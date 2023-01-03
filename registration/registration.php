<!DOCTYPE html>
<html lang="en">
<head> 
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="registrationStylesheet.css">
<title> E3T - Registration page </title>
</head>
<body> 
<div id="container">
	<header>
		<h1> header </h1>
	</header>
	<div id="profileInfo">
		<div class="addImg">
			<p> Add a profile picture </p>
		</div>
		<div id="form">
			<form method="POST" action="registration.php">
				<p> <label for="dataFirstName"> First Name </label>
				<input type="text" name="dataFirstName">
				<label for="dataLastName"> Last Name </label>
				<input type="text" name="dataLastName">
				<label for="dataEmail"> Email address </label>
				<input type="email" name="dataEmail"> </p>
				<p> <label for="dataSpecialties"> Specialties </label>
				<input type="text" name="dataSpecialties"> </p>
			</form>
		</div>
	</div>
	<div class="addPictures">
		<h1 class="addPicturesTitle"> pictures </h2>
		<p class="addPics"> Add a picture</p>
	</div>
	<div class="addPictures">
		<h1 class="addPicturesTitle"> documents </h2>
		<p class="addImg"> Add a document</p>
	</div>
	<footer>
		<h1> footer </h1>
	</footer>
</div>
</body>
</html>