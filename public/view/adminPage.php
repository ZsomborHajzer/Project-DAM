<?php 
    global $dEmail;



?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title>AdminPage</title>
		 <link rel="stylesheet" href="css/adminPageCss.css">
	</head>
    <script>
            function showmore(id) {
                var submitEmailForm = document.getElementById("submitEmailForm" + id)
                if (submitEmailForm.classList[0] === 'd-none') {
                    submitEmailForm.classList.remove("d-none");
                    submitEmailForm.classList.add("d-inline");
                } else {
                    submitEmailForm.classList.remove("d-inline");
                    submitEmailForm.classList.add("d-none");
                }
            }
    </script>
	<body>
        <main>


            <div id="mainTalentInformation">

                <?php
                // Create retrieval of talent information from email entered, check if email entered exists
				
				include "/var/www/E3T/components/dbConnect.php";

                //Create php to change user from active to inactive & vice versa
                if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"] == "change") {

                    $userId = $_POST["userId"];
                    if(!empty($userId)){

                        try {
                            // if(isset($_POST["active"])){
                            // 	$active= $_POST["active"];
                            // }

                            // if(isset($_POST["inActive"])){
                            // 	$active= $_POST["inActive"];
                            // }

                            $active = (int)$_POST["active"];





                            $sql1 = "UPDATE tblUser SET dtActive = :active WHERE idUser like :id";
                            $stmt = $dbHandler->prepare($sql1);
                            $stmt->bindParam("active", $active);
                            $stmt->bindParam("id", $userId);
                            $stmt->execute();

                            echo '<script>alert("Talent activity has been changed")</script>';

                        }catch (Exception $exception){
                            echo '<script>alert("Unexpected error")</script>';
                            echo $exception;
                        }
                    }
                    else {
                        echo '<script>alert("No id was specified")</script>';
                    }


                }

                //Create php to change user from active to inactive & vice versa
                if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"] == "newEmail") {

                    $newEmail = $_POST["newEmail"];
                    $oldEmail=$_POST["oldEmail"];
                    if(!empty($newEmail)){

                        try {



                            $sql1 = "UPDATE tblUser SET dtEmail = :email WHERE dtEmail like :oldEmail";
                            $stmt = $dbHandler->prepare($sql1);
                            $stmt->bindParam("email", $newEmail);
                            $stmt->bindParam("oldEmail", $oldEmail);
                            $stmt->execute();


                            echo '<script>alert("Successfully changed")</script>';


                        }catch (Exception $exception){
                            echo '<script>alert("Not success")</script>';
                            echo $exception;
                        }
                    }
                    else {
                        echo '<script>alert("No email")</script>';
                    }


                }




                    $query= "SELECT * FROM tblUser WHERE dtIsAdmin=0 ";
                    $getinfo= $dbHandler-> prepare($query);
                    $getinfo->execute();


                       // $row = $getinfo->fetch();
                        //$dEmail=$row["dtEmail"];
                        while ($row = $getinfo->fetch()) {
                        $isActive = $row["dtActive"];
                        $userId = $row["idUser"];

                        echo "<div class='talentProfile'>";
                        echo '<div id="talentInformation">';
                        echo "<img id='talentProfilePicture' src=".$row["dtImage"].">";
                        echo "<p id='talentName'>".$row["dtFirstName"]." ".$row["dtLastName"]."</p>";
                        echo "<p id='talentEmail'>".$row["dtEmail"]."</p>";
                        echo "<p id='talentPassword'>".str_repeat("*", strlen($row["dtPassword"]))."</p>";
                        echo '</div>';
                        echo '<div id="emailButton">';
                        echo "<button id='changeEmailButton' name='changeEmail' onclick='showmore($userId)'>Change Email</button>";
                        echo '</div>';
                        echo '<div id="submitEmailSearchBar">';
                        echo "<form action='adminPage.php' id='submitEmailForm$userId' class='d-none' method='post'><button id='changeEmailSubmit' type='submit'>submit Email</button>";//the button that submits the email
                        echo "<input id='newEmail' placeholder='type the new email here' type='email' name='newEmail'><input type='hidden' name='action' value='newEmail'><input type='hidden' name='oldEmail' value='".$row["dtEmail"]."'> </form>";
                        echo '</div>';
                        echo '<div id="radioButtons">
                    <form method="POST" action="adminPage.php" >
                        <label for="Inactive">Inactive</label><input type="radio" id="inactiveButton" name="active" value="0" ' . ($isActive == 0 ? 'checked' : "") . '>
                        <label for="active">Active</label><input  type="radio" id="activeButton" name="active" value="1" ' . ($isActive == 1 ? 'checked'  :"").'>
                        <input type="hidden" name="action" value="change">
                        <input type="hidden" name="userId" value="' . $row["idUser"] . '"> 
                        

                </div>
                 <div id="submitChange">
                        
                  <button id="radioSubmitButton" type="submit">Enter</button>
                    </div></form>';
                        echo "</div>";
                    }





                ?>

                    <?php






                    ?>
            </div>
        </div>
        </main>
    </body>


</html>