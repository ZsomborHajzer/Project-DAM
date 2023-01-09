
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title>AdminPage</title>
		<link rel="stylesheet" href="css/adminPageCss.css" />
	</head>

	<body>
		<form id="emailSearch" action="adminPage.php" method="POST">
			<div class="formBox">
				<div id="emailSearchLabel"><label  for="talentEmailInput">Search by email</label></div>
				<div id="talentEmailInputDiv"><input id="talentEmailInput"  type="email" name="dataEmail" ></div>
				<button id="submitTalentEmail" type=submit>Enter</button>
			</div>
		</form>

		<?php 
		// Create retrieval of talent information from email entered, check if email entered exists
		
		$dsn="mysql:host=mysql;dbname=dbprojectterm2";
		$user="root";
		$passwrd="qwerty";

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
			<form action="adminPage.php" method="POST">
                <button  id="inactiveButton" name="isActive" value="0">Inactive</button>
                <button  id="activeButton" name="isActive" value="1"  >Active</button>
			</div>
			</form>

			<?



			//Create php to change user from active to inactive & vice versa
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                $dataEmail = $_POST["dataEmail"];
                if ($_POST["isActive"] == 0) {

                    $sql1 = "UPDATE tblUser SET dtActive = 1 WHERE 'dtEmail' like?";
                    $stmt = $dbHandler->prepare($sql1);
                    $stmt->execute([$dataEmail]);
                } elseif($_POST["isActive"] == 1){

                    $sql1 = "UPDATE tblUser SET dtActive = 1 WHERE 'dtEmail' like? ";
                    $stmt = $dbHandler->prepare($sql1);
                    $stmt->execute([$dataEmail]);
                }else{
                    echo "not working";
                }



}
            ?>
		</div>
	</body>


</html>