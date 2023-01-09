
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title>AdminPage</title>
		<link rel="stylesheet" href="css/adminPageCss.css" />
	</head>

	<body>
		<form id="emailSearch" action="adminpage.php" method="POST">
			<div class="formBox">
				<div id="emailSearchLabel"><label  for="talentEmailInput">Search by email</label></div>
				<div id="talentEmailInputDiv"><input id="talentEmailInput"  type="email" name="dataEmail" placeholder=""></div>
				<button id="submitTalentEmail" type=submit>Enter</button>
			</div>
		</form>

		<?php 
		// Create retrieval of talent information from email entered, check if email entered exists
		
		$dsn="mysql:host=localhost;dbname=dbprojectterm2";
		$user="root";
		$passwrd="";

		$dbHandler = new PDO($dsn, $user, $passwrd);
		?>


		<div class="profileBox">
			<div class="talentProfile">
				<img id="talentProfilePicture" src="imagePlaceholder/placeholder.jpg" alt="placeholder">
				<p id="talentName">Kratos</p>
				<p id="talentEmail">GodOfWar@gmail.com</p>
				<p id="talentPassword">Password</p>
				<p id="talentRating">Rating:****</p>

			</div>

			<div id="activityButtons">
			<form action="adminpage.php" method="POST">
			<input type="button" id="inactiveButton" value="Make Inactive">
			<input type="button" id="activeButton" value="Make Active">
			</div>
			</form>
			<?php
			//Create php to change user from active to inactive & vice versa
			?>
		</div>
	</body>


</html>