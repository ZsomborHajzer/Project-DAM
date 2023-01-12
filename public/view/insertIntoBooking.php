<?php
include "/var/www/E3T/components/dbConnect.php";
//Connecting to a database

if (isset ($_POST["dataSendByPrice"])) {

    if ($mailClient = filter_input(INPUT_POST, "dataMail", FILTER_VALIDATE_EMAIL) && $date = filter_input(INPUT_POST, "dataDate", FILTER_SANITIZE_NUMBER_INT)) {

        $mail = $_POST["dataMail"];
        $submitId = $_GET['id'];
        $speciality = $_GET['spec'];


        $query = $dbHandler->query("SELECT `dtDate`, `fiUser` FROM tblBooking WHERE `dtDate` = '$date'   AND `fiUser` ='$submitId'");
        $rows = $query->fetchAll();


        if ($rows  == null) {
            $sql = "INSERT INTO tblBooking (dtDate, dtEmail, fiUser,fiSpeciality) VALUES (?,?,?,?)";
            $stmt = $dbHandler->prepare($sql);
            $stmt->execute([$date, $mail, $submitId, $speciality]);
            echo "<script>alert('Booking was added thanks for trusting us')
            if (window.confirm('Really go to another page?'))
            {'";
                header("Location: Booking.php");
                echo "'
            }
                
                </script>";
        }else {
            echo "<script>alert('Date is already taken')</script>";
            header("Location: Booking.php");
        }


    } else {
        echo '<script>   alert("email or data wrong");
                                                     window.location = "booking.php?reloaded=yes";
                                                  </script>';

    }
}


if (isset ($_POST["dataSendByActive"])) {

    if ($mailClient = filter_input(INPUT_POST, "dataMail", FILTER_VALIDATE_EMAIL) && $date = filter_input(INPUT_POST, "dataDate", FILTER_SANITIZE_NUMBER_INT)) {

        $query = $dbHandler->query("SELECT `dtDate`, `fiUSer` FROM tblBooking");
        $rows = $query->fetchAll();
        $mail = $_POST["dataMail"];
        $submitId = $_GET['id'];
        $speciality = $_GET['spec'];

        $submitId = $_GET['id'];
       
        if ($rows  == null) {
            $sql = "INSERT INTO tblBooking (dtDate, dtEmail, fiUser,fiSpeciality) VALUES (?,?,?,?)";
            $stmt = $dbHandler->prepare($sql);
            $stmt->execute([$date, $mail, $submitId, $speciality]);
            echo "<script>alert('Booking was added thanks for trusting us')
            if (window.confirm('Really go to another page?'))
            {'";
            header("Location: Booking.php");
            echo "'
            }
                
                </script>";
        }else {
            echo "<script>alert('Date is already taken')</script>";
            header("Location: Booking.php");
        }

    } else {
        echo '<script>   alert("email or data wrong");</script>';

    }
}

if (isset ($_POST["dataSendByName"])) {

    if ($mailClient = filter_input(INPUT_POST, "dataMail", FILTER_VALIDATE_EMAIL) && $date = filter_input(INPUT_POST, "dataDate", FILTER_SANITIZE_NUMBER_INT)) {

        $query = $dbHandler->query("SELECT `dtDate`, `fiUSer` FROM tblBooking");
        $rows = $query->fetchAll();
        $mail = $_POST["dataMail"];
        $submitId = $_GET['id'];
        $speciality = $_GET['spec'];


        if ($rows  == null) {
            $sql = "INSERT INTO tblbooking (dtDate, dtEmail, fiUser,fiSpeciality) VALUES (?,?,?,?)";
            $stmt = $dbHandler->prepare($sql);
            $stmt->execute([$date, $mail, $submitId, $speciality]);
            echo "<script>alert('Booking was added thanks for trusting us')
            if (window.confirm('Really go to another page?'))
            {'";
            header("Location: Booking.php");
            echo "'
            }
                
                </script>";
        }else {
            echo "<script>alert('Date is already taken')</script>";
            header("Location: Booking.php");
        }

    } else {
        echo '<script>   alert("email or data wrong");
                                                     window.location = "booking.php?reloaded=yes";
                                                  </script>';

    }
}

if (isset ($_POST["dataSendByMail"])) {

    if ($mailClient = filter_input(INPUT_POST, "dataMail", FILTER_VALIDATE_EMAIL) && $date = filter_input(INPUT_POST, "dataDate", FILTER_SANITIZE_NUMBER_INT)) {

        $query = $dbHandler->query("SELECT `dtDate`, `fiUSer` FROM tblBooking");
        $rows = $query->fetchAll();
        $mail = $_POST["dataMail"];
        $submitId = $_GET['id'];
        $speciality = $_GET['spec'];

        if ($rows  == null) {
            $sql = "INSERT INTO tblbooking (dtDate, dtEmail, fiUser,fiSpeciality) VALUES (?,?,?,?)";
            $stmt = $dbHandler->prepare($sql);
            $stmt->execute([$date, $mail, $submitId, $speciality]);
            echo "<script>alert('Booking was added thanks for trusting us')
            if (window.confirm('Really go to another page?'))
            {'";
            header("Location: Booking.php");
            echo "'
            }
                
                </script>";
        }else {
            echo "<script>alert('Date is already taken')</script>";
            header("Location: Booking.php");
        }

    } else {
        echo '<script>   alert("email or data wrong");
                                                     window.location = "booking.php?reloaded=yes";
                                                  </script>';

    }
}
$dbHandler = null;

?>
