<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:wght@500;600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:wght@500;600&display=swap"
          rel="stylesheet">
    <!-- My css -->
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/<?= $cssFile; ?>">
    <!--Font Awesome script-->
    <script src="https://kit.fontawesome.com/08626bfbba.js" crossorigin="anonymous"></script>
     <!--Font Awesome script-->
     <script src="https://kit.fontawesome.com/08626bfbba.js" crossorigin="anonymous"></script>
    <!-- jquery link -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <title><?= $pageName; ?></title>
</head>

<body>
    <?php
    echo "<header>";

    if (isset($_SESSION["idUser"])) {

        if ($_SESSION["isAdmin"] == 1) {  //If Admin
            var_dump($_SESSION["isAdmin"]);

            echo "<nav class='navbar'>";
            echo "<div class='Lholder'>";
            echo "<img class='logo' src='/images/blogo.png'>";
            echo "</div>";
            echo "<button class='fas fa-bars' id='hamburger-btn'></button>";
            echo " <div class='nav-desktop'> ";
            echo "<ul>";
            echo "<li class='active'><a href='home.php'>Home</a></li>";
            echo "<li class='active'><a href='#'>Register</a></li>";
            echo "<li><a href='#'>Talent</a></li>";
            echo "<li><a href='#'>Admin Page</a></li>";
            echo "</ul>";
            echo "</div>";
            echo "</nav>";
        } else if ($_SESSION["isAdmin"] == 0) {    //If Talent

            echo "<nav class='navbar'>";
            echo "<div class='Lholder'>";
            echo "<img class='logo' src='/images/blogo.png'>";
            echo "</div>";
            echo "<button class='fas fa-bars' id='hamburger-btn'></button>";
            echo " <div class='nav-desktop'> ";
            echo "<ul>";
            echo "<li class='active'><a href='home.php'>Home</a></li>";
            echo "<li><a href='#'>My Calendar</a></li>";
            echo "<li class='active'><a href='#'>My Profile</a></li>";
            echo "</ul>";
            echo "</div>";
            echo "</nav>";
        }
    } else {     //If Guest

        echo "<nav class='navbar'>";
        echo "<div class='Lholder'>";
        echo "<img class='logo' src='/images/blogo.png'>";
        echo "</div>";
        echo "<button class='fas fa-bars' id='hamburger-btn'></button>";
        echo " <div class='nav-desktop'> ";
        echo "<ul>";
        echo "<li class='active'><a href='home.php'>Home</a></li>";
        echo "<li><a href='Booking.php'>Book here</a></li>";
        echo "<li><a href='contactPage.php'>Contact</a></li>";
        echo "<li><a href='logInPage.php'>Login</a></li>";
        echo "</ul>";
        echo "</div>";
        echo "</nav>";
    }

    echo "</header>";
    ?>
