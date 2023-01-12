<?php

$pageName = "E3T-Talents";
$cssFile = "Booking.css";
include "/var/www/E3T/components/header.php";

?>

<main id="main-container" class="main-bdy">
    <article class="bdy-grid">
        <div class="b-content">
            <p>Our Talents</p>
        </div>
        <div class="b-content">
            <form class="t-content" method="post">
                <label for="dataNameOrEmail">Name or Email</label>
                <input type="text" name="dataNameOrEmail" id="dataNameOrEmail">

                <input type="submit" name="dataSeachByEmail" value="Submit Mail or Name">
                <label for="dataTalents">Filter By:</label>
                <select id="s_talent" name="dataTalents" id="dataTalents">
                    <option disabled selected value> -- select an option --</option>
                    <?php

                    // getting the different filter option to search talents


                    $arrayFilter = ["Pricing", "Active",];

                    foreach ($arrayFilter as $item) {
                        echo "<option value='$item'>$item</option>";
                    }

                    ?>

                </select>

                <input type="submit" value="SearchByFilter" name="dataFilterSearch">
            </form>
            <div class="t-content">
                <!-- Talent information to be injected using php -->
                <div class="gen-content">
                    <?php

                    $dsn = "mysql:host=localhost;dbname=dbprojectterm2";
                    $user = "root";
                    $passwd = "";

                    //Connecting to a database
                    $dbHandler = new PDO($dsn, $user, $passwd);

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {




                        if ($_POST["dataNameOrEmail"] != "") {
                                //if the email is correct then we will filter per Email
                                if(filter_input(INPUT_POST, "dataNameOrEmail", FILTER_VALIDATE_EMAIL)) {

                                    $stmt = $dbHandler->prepare("SELECT * FROM tbluser  INNER JOIN tblspecialties ON fiSpeciality = tblspecialties.idSpecialty WHERE dtEmail LIkE ? ");

                                    //$stmt->bind_param

                                    $mail= filter_input(INPUT_POST, "dataNameOrEmail", FILTER_VALIDATE_EMAIL);

                                    $stmt->execute(["%$mail%"]);
                                    while ($row = $stmt->fetch()) {

                                        echo "<div class= 'g-item'>";
                                        echo "<img class='g-img' src=". $row['dtImage'].">";
                                        echo "<p class='g-p'>".$row['dtName']." ".$row['dtLastName']."</p>";
                                        echo "<p class='g-p'>" .$row['dtEmail']."</p>";
                                        echo "<form>";
                                        echo "<p class='a-p' >Book Me</p>" ;
                                        echo "<a href='#'> <img class='a-mg' src='../images/dropdown.png'>"."</a>";
                                        echo "</form>";
                                        echo "</div>";
                                    }
                                    //if that is not correct then we will filter per Name
                                }else if (filter_input(INPUT_POST, "dataNameOrEmail", FILTER_SANITIZE_SPECIAL_CHARS)){

                                    $stmt = $dbHandler->prepare("SELECT * FROM tbluser INNER JOIN tblspecialties ON fiSpeciality = tblspecialties.idSpecialty  WHERE dtName LIkE ? ");

                                    //$stmt->bind_param

                                    $name= filter_input(INPUT_POST, "dataNameOrEmail", FILTER_SANITIZE_SPECIAL_CHARS);

                                    $stmt->execute(["%$name%"]);
                                    while ($row = $stmt->fetch()) {

                                        echo "<div class= 'g-item'>";
                                        echo "<img class='g-img' src=". $row['dtImage'].">";
                                        echo "<p class='g-p'>".$row['dtName']." ".$row['dtLastName']."</p>";
                                        echo "<p class='g-p'>" .$row['dtEmail']."</p>";
                                        echo "<form>";
                                        echo "<p class='a-p' >Book Me</p>" ;
                                        echo "<a href='#'> <img class='a-mg' src='../images/dropdown.png'>"."</a>";
                                        echo "</form>";
                                        echo "</div>";
                                    }

                                }    //If it's a specialty
                                // else if (filter_input(INPUT_POST, "dataNameOrEmail", FILTER_SANITIZE_SPECIAL_CHARS)){

                                //     $stmt = $dbHandler-> prepare("SELECT * FROM tbluser
                                //                                 INNER JOIN tblspecialties ON fiSpeciality = tblspecialties.idSpecialty
                                //                                 WHERE tblspecialties.dtDescription LIKE ?");

                                //     $specialty = filter_input(INPUT_POST, "dataNameOrEmail", FILTER_SANITIZE_SPECIAL_CHARS);
                                //     echo($specialty);
                                //     $stmt -> execute(["%$specialty%"]);
                                //     echo $stmt;
                                //     while($row = $stmt-> fetch()){

                                //         echo "<div class= 'g-item'>";
                                //         echo "<img class='g-img' src=". $row['dtImage'].">";
                                //         echo "<p class='g-p'>".$row['dtName']." ".$row['dtLastName']."</p>";
                                //         echo "<p class='g-p'>" .$row['dtEmail']."</p>";
                                //         echo "<form>";
                                //         echo "<p class='a-p' >Book Me</p>" ;
                                //         echo "<a href='#'> <img class='a-mg' src='../images/dropdown.png'>"."</a>";
                                //         echo "</form>";
                                //         echo "</div>";
                                //     }
                                // }

                                else {

                                    echo "<h3>Please enter a valid name or Email</h3>";

                                }


                        }else {
                        //if none of the above is the case then a select option has been choosen

                            $sanitzeOption =  filter_input(INPUT_POST,"dataTalents",FILTER_SANITIZE_SPECIAL_CHARS);

                            // new test needs to be added. If the users wants to only see avaible ones then we only need to show those ones.

                            if ($sanitzeOption == "Active") {

                                $stmt = $dbHandler->prepare("SELECT * FROM tbluser INNER JOIN tblspecialties ON fiSpeciality = tblspecialties.idSpecialty  WHERE dtActive = 1  ORDER BY  dtName ASC ");

                                //$stmt->bind_param

                                $name= filter_input(INPUT_POST, "dataNameOrEmail", FILTER_SANITIZE_SPECIAL_CHARS);

                                $stmt->execute(["$sanitzeOption"]);
                                while ($row = $stmt->fetch()) {

                                    echo "<div class= 'g-item'>";
                                    echo "<img class='g-img' src=". $row['dtImage'].">";
                                    echo "<p class='g-p'>".$row['dtName']." ".$row['dtLastName']."</p>";
                                    echo "<p class='g-p'>" .$row['dtEmail']."</p>";
                                    echo "<form>";
                                    echo "<p class='a-p' >Book Me</p>" ;
                                    echo "<a href='#'> <img class='a-mg' src='../images/dropdown.png'>"."</a>";
                                    echo "</form>";
                                    echo "</div>";
                                }
                            }else{

                            $stmt = $dbHandler->prepare("SELECT * FROM tbluser  INNER JOIN tblspecialties ON fiSpeciality = tblspecialties.idSpecialty ORDER BY ?  ASC");

                            //$stmt->bind_param

                            $name= filter_input(INPUT_POST, "dataNameOrEmail", FILTER_SANITIZE_SPECIAL_CHARS);

                            $stmt->execute(["$sanitzeOption"]);
                            while ($row = $stmt->fetch()) {
                                //<option disabled selected value> -- select an option --</option>
                                echo "<div class= 'g-item'>";
                                echo "<img class='g-img' src=". $row['dtImage'].">";
                                echo "<p class='g-p'>".$row['dtName']." ".$row['dtLastName']."</p>";
                                echo "<p class='g-p'>" .$row['dtEmail']."</p>";
                                echo "<form>";
                                echo "<p class='a-p' >Book Me</p>" ;
                                echo "<a href='#'> <img class='a-mg' src='../images/dropdown.png'>"."</a>";
                                echo "</form>";
                                echo "</div>";

                                $dbHandler = null;
                            }
                            }


                        }


                    }

                    $dbHandler = null;
                    ?>
                </div>
            </div>
        </div>
    </article>
</main>

<?php

include "/var/www/E3T/components/footer.html";

?>
