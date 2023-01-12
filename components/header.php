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
    <!-- My css -->
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/Booking.css">
    <!--Font Awesome script-->
    <script src="https://kit.fontawesome.com/08626bfbba.js" crossorigin="anonymous"></script>
    <title><?= $pageName; ?></title>
</head>

<body>
    <?php
    echo "<header>";

    if (isset($_SESSION["Login"])) {

        if ($_SESSION["isAdmin"] == 1) {  //If Admin

            echo "<nav class='navbar'>";
            echo "<div class='Lholder'>";
            echo "<img class='logo' src='/images/blogo.png'>";
            echo "</div>";
            echo "<button class='fas fa-bars' id='hamburger-btn'></button>";
            echo " <div class='nav-desktop'> ";
            echo "<ul>";
            echo "<li class='active'><a href='#'>Register</a></li>";
            echo "<li><a href='#'>Talent</a></li>";
            echo "<li><a href='adminPage.html'>Admin Page</a></li>";
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
        echo "<li class='active'><a href='home.html'>Home</a></li>";
        echo "<li><a href='Booking.php'>Book here</a></li>";
        echo "<li><a href='contactPage.php'>Contact</a></li>";
        echo "<li><a href='#'>Login</a></li>";
        echo "</ul>";
        echo "</div>";
        echo "</nav>";
    }

    //Commented out mobile navbar
    // <div class="nav-mobile" id="nav-mobile" >

    //     <ul  class="nav-list-mobile">
    //         <li class="active"><a href="index.html">Home</a></li>
    //         <li><a href="#">Book here</a></li>
    //         <li><a href="#">Contact</a></li>
    //         <li><a href="#">Login</a></li>
    //     </ul>
    // </div>
    echo "</header>";
    ?>
