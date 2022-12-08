<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:wght@500;600&display=swap"
          rel="stylesheet">
    <!-- My css -->
    <link rel="stylesheet" href="Booking.css">
    <!--Font Awesome script-->
    <script src="https://kit.fontawesome.com/08626bfbba.js" crossorigin="anonymous"></script>
    <title>E3T-Talents</title>
</head>
<body>
<header>
    <nav class="navbar">
        <div class="Lholder">
            <img class="logo" src="/images/blogo.png">
        </div>

        <button class="fas fa-bars" id="hamburger-btn"></button>

        <div class="nav-desktop">

            <ul>
                <li class="active"><a href="index.html">Home</a></li>
                <li><a href="Booking.html">Book here</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Login</a></li>
            </ul>
        </div>

    </nav>

    <div class="nav-mobile" id="nav-mobile">

        <ul class="nav-list-mobile">
            <li class="active"><a href="index.html">Home</a></li>
            <li><a href="#">Book here</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">Login</a></li>
        </ul>
    </div>
</header>

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

                                    echo "<tr>";
                                    echo "<td>" . $row['dtImage'] . "</td><td>" . $row['dtName'] . " " . $row['dtLastName'] . "</td>
                            <td>" . $row['dtEmail'] . "</td>
                            <td>" . $row['dtDescription'] . "</td>";
                                    echo "</tr>";
                                }
                                //if that is not correct then we will filter per Name
                            }else if (filter_input(INPUT_POST, "dataNameOrEmail", FILTER_SANITIZE_SPECIAL_CHARS)){

                                $stmt = $dbHandler->prepare("SELECT * FROM tbluser INNER JOIN tblspecialties ON fiSpeciality = tblspecialties.idSpecialty  WHERE dtName LIkE ? ");

                                //$stmt->bind_param

                                $name= filter_input(INPUT_POST, "dataNameOrEmail", FILTER_SANITIZE_SPECIAL_CHARS);

                                $stmt->execute(["%$name%"]);
                                while ($row = $stmt->fetch()) {

                                    echo "<tr>";
                                    echo "<td>" . $row['dtImage'] . "</td><td>" . $row['dtName'] . " " . $row['dtLastName'] . "</td>
                            <td>" . $row['dtEmail'] . "</td>
                            <td>" . $row['dtImage'] . "</td>";
                                    echo "</tr>";
                                }

                            }else {

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

                                echo "<tr>";
                                echo "<td>" . $row['dtImage'] . "</td><td>" . $row['dtName'] . " " . $row['dtLastName'] . "</td>
                            <td>" . $row['dtEmail'] . "</td>
                            <td> Book me</td>";
                                echo "</tr>";
                            }
                        }else{

                        $stmt = $dbHandler->prepare("SELECT * FROM tbluser  INNER JOIN tblspecialties ON fiSpeciality = tblspecialties.idSpecialty ORDER BY ?  ASC");

                        //$stmt->bind_param

                        $name= filter_input(INPUT_POST, "dataNameOrEmail", FILTER_SANITIZE_SPECIAL_CHARS);

                        $stmt->execute(["$sanitzeOption"]);
                        while ($row = $stmt->fetch()) {

                            echo "<tr>";
                            echo "<td>" . $row['dtImage'] . "</td><td>" . $row['dtName'] . " " . $row['dtLastName'] . "</td>
                            <td>" . $row['dtEmail'] . "</td>
                            <td> Book me</td>";
                            echo "</tr>";

                            $dbHandler = null;
                        }
                        }


                    }


                }

                $dbHandler = null;
                ?>

            </div>
        </div>
    </article>
</main>
<!-- Foooter -->


<footer>
    <div class="f-content">
        <ul>
            <li>
                <a href="#">About</a>
            </li>
            <li>
                <a href="#">Blog</a>
            </li>
            <li>
                <a href="#">Team</a>
            </li>
            <li>
                <a href="#">bla</a>
            </li>
            <li>
                <a href="#">Contact</a>
            </li>
        </ul>
    </div>
    <div class="f-content">
        <a href="#">
            <img src="../images/instagram.png" alt="instagram">
        </a>
        <a href="#">
            <img src="../images/facebook.png" alt="facebook">
        </a>
        <a href="#">
            <img src="../images/twitter.png" alt="twitter">
        </a>
        <a href="#">
            <img src="../images/linkedin.png" alt="linkedin">
        </a>
    </div>
    <div class="f-content">
        <p>© Copyright E3T and PEZARB 2022. All rights reserved</p>
    </div>
</footer>
</body>

<script src="deskapp.js"></script>
</html>