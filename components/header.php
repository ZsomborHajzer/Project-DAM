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
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/Booking.css">
    <!--Font Awesome script-->
    <script src="https://kit.fontawesome.com/08626bfbba.js" crossorigin="anonymous"></script>
    <title><?= $pageName; ?></title>
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
                    <li><a href="Booking.php">Book here</a></li>
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
