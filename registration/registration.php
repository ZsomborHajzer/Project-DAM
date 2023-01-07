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

	<article id="profileInfo">
			
			<div id="form">
				<form method="POST" action="registration.php" enctype="multipart/form-data">
					<div>
						<label for="dataFirstName"> First Name</label>
						<input type="text" name="dataFirstName">
					</div>
					<div>
						<label for="dataLastName"> Last Name </label>
						<input type="text" name="dataLastName">
					</div>
					<div>
						<label for="dataPhoneNo"> Phone Number </label>
						<input type="text" name="dataPhoneNo">
					</div>
					<div>
						<label for="dataEmail"> Email address </label>
						<input type="text" name="dataEmail"> </p>
					</div>
					
					<div>
						<label for="dataPassword"> Password </label>
						<input type="text" name="dataPassword">
					</div>

					<div>
						<p>Admin</p>
						<label for="true">Yes</label>
						<input name="true" type="checkbox" value="1">

						<label for="false">No</label>
						<input name="false" type="checkbox" value="0">
					</div>
					<div>
						<label for="dataSpecialties"> Specialties </label>
						<input type="text" name="dataSpecialties">
					</div>
					
					<button type="submit">Register</button>
				</form>

				<?php

					$dsn="mysql:host=localhost;dbname=dbprojectterm2";
					$user= "root";
					$passwd = "";
					$dbHandler = new PDO($dsn, $user, $passwd);
				
				
				if($_SERVER["REQUEST_METHOD"] == "POST"){

					$err = [];

					if(!$fname = filter_input(INPUT_POST, "dataFirstName", FILTER_SANITIZE_SPECIAL_CHARS)){
						$err[] = "Enter talent's first name";
					}

					if(!$lname = filter_input(INPUT_POST, "dataLastName", FILTER_SANITIZE_SPECIAL_CHARS)){
						$err[] = "Enter talent's last name";
					}

					if(preg_match("/^[0-9]{10}/", $_POST["dataPhoneNo"])){
						$PhoneNo = $_POST["dataPhoneNo"];
					}else{
						$err[] = "Invalid Phone Number";
					}

					if(!$dtEmail = filter_var($_POST["dataEmail"], FILTER_VALIDATE_EMAIL)){
						$err[] = "Enter a valid email";
					}

					if(isset($_POST["true"])){
						$isAdmin = $_POST["true"];
					}

					if(isset($_POST["false"])){
						$isAdmin = $_POST["false"];
					}
					
					if(!$specialty = filter_input(INPUT_POST, "dataSpecialties", FILTER_SANITIZE_SPECIAL_CHARS)){
						$err[] = "Enter a specialty";
					}
					// echo "<b>debug1 line 97</b>";	
					$password = filter_input(INPUT_POST, 'dataPassword') ;

					$uppercase = preg_match('@[A-Z]@', $password);
                    $lowercase = preg_match('@[a-z]@', $password);
                    $number = preg_match('@[0-9]@', $password);

					
						// echo "<b>debug1 line 108</b>";
						// var_dump($err);
						if(count($err) == 0){

							if(!$uppercase || !$lowercase || !$number || strlen($password)<8){
								echo   "The password should be atleast 8 characters in length and 
										contain atleast one uppercase, one lowercase, one number ";
							}else{
							// echo "<b>debug1 line 109</b>";
								//Make a query to add the data to tbluser
								//first check if user email exists in the database
								echo "Entered email is ".$dtEmail;
								try{ 
							
									$stmt = $dbHandler-> prepare("SELECT dtEmail FROM tbluser WHERE dtEmail =:email");
									
									$stmt->bindParam("email", $dtEmail);

									$stmt-> execute();
									// $exist = $dbhandler ->prepare("SELECT 
									// COUNT(*) FROM tbluser (idUser, dtName, dtLastName, dtEmail, dtPassword, dtIsAdmin, dtActive, dtRating, dtImage, dtPrice, fiSpeciality, dtNumber)
									// 						WHERE dtEmail LIKE ?");

									// $exist->bindParam("dtEmail", $dtEmail);

									// echo "<b>debug1 line123</b>";
									// $exist-> execute(["$dtEmail"]);
									// echo "<b>debug2</b>";
									// $res = $exist->fetchall();
									// var_dump($stmt);
									$res = $stmt-> fetchall();
									var_dump($res);
									if(empty($res)){
										echo "<b>debug3</b>";
										$add = $dbHandler -> prepare("INSERT INTO tbluser(dtName, dtLastName, dtEmail, dtPassword, dtIsAdmin, fiSpeciality, dtNumber)
																VALUES(:dtName, :dtLastName, :dtEmail, :dtPassword, :dtIsAdmin, :fiSpecialty :dtNumber)");
										$add->bindParam("dtName", $fname);
										$add->bindParam("dtLastName", $lname);
										$add->bindParam("dtEmail", $dtEmail);
										$add->bindParam("dtPassword", $password);
										$add->bindParam("dtIsAdmin",$isAdmin);
										$add->bindParam("fiSpecialty", $specialty);
										$add->bindParam("dtNumber",$PhoneNo);
										echo "<b>debug4</b>";
										$add-> execute();

										echo "<b>Data was added successfully!</b>";
									}
								}catch(Exception $ex){
									echo $ex;
								}
							}
							}else{
								echo "<ul>";
								foreach ($err as $error) {
								echo "<li>$error</li>";
								}
								echo "</ul>";
								}
						
						}
				
				?>
			</div>
	</article>
	
	<footer>
		<h1> footer </h1>
	</footer>
</div>
</body>
</html>