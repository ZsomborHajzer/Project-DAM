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


                    $arrayFilter = ["Pricing", "Availability", "Contact details", "Group"];

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

                $dsn = "mysql:host=mysql;dbname=assigment4";
                $user = "root";
                $passwd = "qwerty";

                //Connecting to a database
                $dbHandler = new PDO($dsn, $user, $passwd);

                if ($_SERVER["REQUEST_METHOD"] == "POST") {


                    if ($_POST["dataTalents"] != "") {
                        $input = filter_input(INPUT_POST, "dataTalents", FILTER_SANITIZE_SPECIAL_CHARS);
                    }


                    if ($_POST["dataNameOrEmail"] != "") {
                        $nameOrEmail = filter_input(INPUT_POST, "dataNameOrEmail", FILTER_SANITIZE_SPECIAL_CHARS);


                        $stmt = $dbHandler->query("SELECT * FROM tblUser");

/*
                        while ($row = $stmt->fetch()) {
                            $id = $row['idBug'];
                            echo "<tr>";
                            echo "<td>" . $row['dtProductName'] . "</td><td>" . $row['dtVersion'] . "</td>
                            <td>" . $row['dtHardwareType'] . "</td>
                            <td>" . $row['dtOs'] . "</td>
                            <td>" . $row['dtFrequancy'] . "</td>
                            <td>" . $row['dtSolution'] . "</td><td><a href='edit.php?id=$id'>Edit Bug</a></td>
                            <td><a href='edit.php?id=$id'>Delete</a></td>";
                            echo "</tr>";
                            $_SESSION['id'] = $row["idBug"];
                        }*/

                        $dbHandler = null;

                    }


                }


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