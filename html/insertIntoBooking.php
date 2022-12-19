<?php
$dsn = "mysql:host=localhost;dbname=dbprojectterm2";
$user = "root";
$passwd = "";

//Connecting to a database
$dbHandler = new PDO($dsn, $user, $passwd);
if (isset ($_POST["dataSendByPrice"])) {

    if ($mailClient = filter_input(INPUT_POST, "dataMail", FILTER_VALIDATE_EMAIL) && $date = filter_input(INPUT_POST, "dataDate", FILTER_SANITIZE_NUMBER_INT)) {

        $query = $dbHandler->query("SELECT `dtDate`, `fiUser` FROM tblbooking");
        $mail = $_POST["dataMail"];
        $submit_id = $_GET['id'];
        $speciality =  $_GET['spec'];

        while ($row = $query->fetch()) {


            if ($date != $row["dtDate"] && $submit_id != $row["fiUser"]) {

                $sql = "INSERT INTO tblbooking (dtDate, dtEmail, fiUser,fiSpeciality) VALUES (?,?,?,?)";
                $stmt = $dbHandler->prepare($sql);
                $stmt->execute([$date, $mail, $submit_id, $speciality]);
                //$dbHandler = null;
                //echo "<script>alert('Value added succefully')</script>";
                //header("Location: booking.php");

            }else {
                echo "<script>alert('User is already booked on this date')</script>";
                header("Location: booking.php");
            }
        }

    } else {
        echo '<script>   alert("email or data wrong");
                                                     window.location = "booking.php?reloaded=yes";
                                                  </script>';

    }
}


if (isset ($_POST["dataSendByActive"])) {

    if ($mailClient = filter_input(INPUT_POST, "dataMail", FILTER_VALIDATE_EMAIL) && $date = filter_input(INPUT_POST, "dataDate", FILTER_SANITIZE_NUMBER_INT)) {

        $query = $dbHandler->query("SELECT `dtDate`, `fiUSer` FROM tblbooking");
        $mail = $_POST["dataMail"];
        $submit_id = $_GET['id'];
        $speciality =  $_GET['spec'];

        $submit_id = $_GET['id'];
        while ($row = $query->fetch()) {


            if ($date != $row["dtDate"] && $submit_id != $row["fiUser"]) {

                $sql = "INSERT INTO tblbooking (dtDate, dtEmail, fiUser,fiSpeciality) VALUES (?,?,?,?)";
                $stmt = $dbHandler->prepare($sql);
                $stmt->execute([$date, $mail, $submit_id, $speciality]);
                //$dbHandler = null;
                //echo "<script>alert('Value added succefully')</script>";
                //header("Location: booking.php");

            }else {
                echo "<script>alert('User is already booked on this date')</script>";
                header("Location: booking.php");
            }
        }

    } else {
        echo '<script>   alert("email or data wrong");</script>';

    }
}

if (isset ($_POST["dataSendByName"])) {

    if ($mailClient = filter_input(INPUT_POST, "dataMail", FILTER_VALIDATE_EMAIL) && $date = filter_input(INPUT_POST, "dataDate", FILTER_SANITIZE_NUMBER_INT)) {

        $query = $dbHandler->query("SELECT `dtDate`, `fiUSer` FROM tblbooking");
        $mail = $_POST["dataMail"];
        $submit_id = $_GET['id'];
        $speciality =  $_GET['spec'];

        while ($row = $query->fetch()) {


            if ($date != $row["dtDate"] && $submit_id != $row["fiUser"]) {

                $sql = "INSERT INTO tblbooking (dtDate, dtEmail, fiUser,fiSpeciality) VALUES (?,?,?,?)";
                $stmt = $dbHandler->prepare($sql);
                $stmt->execute([$date, $mail, $submit_id, $speciality]);
                //$dbHandler = null;
                //echo "<script>alert('Value added succefully')</script>";
                //header("Location: booking.php");

            }else {
                echo "<script>alert('User is already booked on this date')</script>";
                header("Location: booking.php");
            }
        }

    } else {
        echo '<script>   alert("email or data wrong");
                                                     window.location = "booking.php?reloaded=yes";
                                                  </script>';

    }
}

if (isset ($_POST["dataSendByMail"])) {

    if ($mailClient = filter_input(INPUT_POST, "dataMail", FILTER_VALIDATE_EMAIL) && $date = filter_input(INPUT_POST, "dataDate", FILTER_SANITIZE_NUMBER_INT)) {

        $query = $dbHandler->query("SELECT `dtDate`, `fiUSer` FROM tblbooking");
        $mail = $_POST["dataMail"];
        $submit_id = $_GET['id'];
        $speciality =  $_GET['spec'];

        while ($row = $query->fetch()) {


            if ($date != $row["dtDate"] && $submit_id != $row["fiUser"]) {

                $sql = "INSERT INTO tblbooking (dtDate, dtEmail, fiUser,fiSpeciality) VALUES (?,?,?,?)";
                $stmt = $dbHandler->prepare($sql);
                $stmt->execute([$date, $mail, $submit_id, $speciality]);
                //$dbHandler = null;
                //echo "<script>alert('Value added succefully')</script>";
                //header("Location: booking.php");

            }else {
                echo "<script>alert('User is already booked on this date')</script>";
                header("Location: booking.php");
            }
        }

    } else {
        echo '<script>   alert("email or data wrong");
                                                     window.location = "booking.php?reloaded=yes";
                                                  </script>';

    }
}
$dbHandler = null;

?>
