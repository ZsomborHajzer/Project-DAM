<?php 
    global $dEmail;
?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title>AdminPage</title>
		<!-- <link rel="stylesheet" href="css/adminPageCss.css" /> -->
	</head>

	<body>
		<form id="emailSearch" action="adminPage.php" method="POST">
			<div class="formBox">
				<div id="emailSearchLabel"><label  for="talentEmailInput">Search by email</label></div>
				<div id="talentEmailInputDiv"><input id="talentEmailInput"  type="email" name="dataEmail" placeholder=""></div>
				<INPUT type="hidden" name="action" value="search">
				<button id="submitTalentEmail" type=submit>Enter</button>
			</div>
		</form>
		<div class='talentProfile'>
		<?php 
		// Create retrieval of talent information from email entered, check if email entered exists
		$err=[];
		$dsn="mysql:host=mysql;dbname=dbprojectterm2";
		$user="root";
		$passwrd="qwerty";

		$dbHandler = new PDO($dsn, $user, $passwrd);

		if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"] == "search"){

			if(!$email = filter_input(INPUT_POST, "dataEmail", FILTER_VALIDATE_EMAIL)){
				$err[] ="Invalid email";
			}

			$query= "SELECT * FROM tblUser WHERE dtEmail=:dtEmail";
			$getinfo= $dbHandler-> prepare($query);
			$getinfo->bindParam("dtEmail", $email);
			$getinfo->execute();

			if(isset($getinfo)){
				$row = $getinfo->fetch();
				$dEmail=$row["dtEmail"];
				echo "global email is ".$dEmail;
				echo "<img id='talentProfilePicture' src=".$row["dtImage"].">";
				echo "<p id='talentName'>".$row["dtFirstName"]." ".$row["dtLastName"]."</p>";
				echo "<p id='talentEmail'>".$row["dtEmail"]."</p>";
				echo "<p id='talentPassword'>".$row["dtPassword"]."</p>";
				
			}else{
				echo "email entered is not in database";
			}
		
		
		?>
		
 	<div id="activityButtons">
			<form method="POST" action="adminPage.php" >
                <label for="inActive">inActive</label><input type="radio" name="active" value="0" <?php echo ($row["dtActive"] == 0 ? "checked" : ""); ?>>
                <label for="active">Active</label><input  type="radio" name="active" value="1" <?php echo ($row["dtActive"] == 1 ? "checked" : ""); ?>>
			</div>
			<div>
			<input type="hidden" name="action" value="change">
			<input type="hidden" name="email" value="<?= $dEmail ?>">
				<button type="submit">Enter</button>
			</div>
			</form>

			<?php

			}

			//Create php to change user from active to inactive & vice versa
            if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"] == "change") {
               
				$dEmail = $_POST["email"];
				if(!empty($dEmail)){

					try {
				// if(isset($_POST["active"])){
				// 	$active= $_POST["active"];
				// }
				
				// if(isset($_POST["inActive"])){
				// 	$active= $_POST["inActive"];
				// }

				$active = (int)$_POST["active"];
				

				var_dump($active);
				echo "<p>debug Line 73</p>";
				
                    $sql1 = "UPDATE tblUser SET dtActive = :active WHERE dtEmail like :email";
                    $stmt = $dbHandler->prepare($sql1);
					$stmt->bindParam("active", $active);
					$stmt->bindParam("email", $dEmail);
                    $stmt->execute();
                 
                    echo "Talent activity has been changed";

				}catch (Exception $exception){
					echo "not success";
					echo $exception;
				}
			}
			else {
				echo "no email";
			}

				
			}
			
            ?>
	</div>
	</body>


</html>