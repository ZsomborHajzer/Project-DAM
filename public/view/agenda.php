<?php

echo (string) date("Y-m-d", strtotime("first day of this month"));

// if we haven't got the id parameter
if (empty($_GET["id"])) {
    header("Location: /");
    die();
}

// if the id parameter is present, but it's not a number
if (!is_numeric($_GET["id"])) {
    header("Location: /");
    die();
}

include "/var/www/E3T/components/dbConnect.php";

// then we try to get the name. if no user found - redirect to the main page.
$nameStmt = $dbHandler->prepare("SELECT dtFirstName, dtLastName FROM tblUser WHERE idUser = :id");
$nameStmt->bindParam("id", $_GET["id"]);
$nameStmt->execute();

if ($nameStmt->rowCount() == 0) {
    header("Location: /");
    die();
} else {
    $info = $nameStmt->fetch();
    $talentName = $info[0] . " " . $info[1];
}


$pageName = "E3T-home";
$cssFile = "calendarStyles.css";
include "/var/www/E3T/components/header.php";

?>

<?php
// $month = 12;
// $year = 2022;

// $stamp = time();
$start_day = date('N', strtotime("first day of this month"));
$end_day = date('t');

// echo date("Y-m-d", strtotime("first day of this month"));
// echo date("Y-m-d", strtotime("last day of this month"));

$weeks = array();
$week = array();

for ($day = 1; $day <= $end_day; $day++) {
    // if it is the first day of the month...
    if ($day == 1) {
        for ($i = 0; $i < $start_day - 1; $i++) {
            // ...then we fill the blank days in, up until the point of the 1st day
            $week[$i] = "";
        }
        $week[] = $day;
    } else {
        // normal behaviour, we just add the day to the array
        $week[] = $day;
    }

    // if the week consists of 7 days (the max amount)...
    if (count($week) == 7) {
        // ...then we add week[] to weeks[], then we have week[] cleaned
        $weeks[] = $week;
        $week = [];
    }

    // if it is the last day of the month...
    if ($day == $end_day) {
        $cur = 7 - count($week);
        // ...then we fill the blank days in, up until the week[] consists of 7 days...
        for ($i = 0; $i < $cur; $i++) {
            $week[] = "";
        }
        // ...and we add week[] to weeks[], then clear week[]
        $weeks[] = $week;
        $week = NULL;
    }
}



?>
<h1 id="calendarTitle"><?php echo "Event calendar of $talentName"; ?></h1>
<div id="calenderMain">
    <table id="calenderTable">
        <thead>
            <tr>
                <th colspan=7><?php echo date("F") . ", " . date("Y"); ?></th>
            </tr>
            <tr>
                <td>Mon</td>
                <td>Tue</td>
                <td>Wed</td>
                <td>Thu</td>
                <td>Fri</td>
                <td>Sat</td>
                <td>Sun</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = $dbHandler->prepare("SELECT dtDate FROM tblBooking WHERE fiUser = :id AND dtDate > :start AND dtDate < :end");
            $query->bindParam("id", $_GET["id"]);
            $query->bindParam("start", date("Y-m-d", strtotime("first day of this month")));
            $query->bindParam("end", date("Y-m-d", strtotime("last day of this month")));

            $query->execute();
            $arrBooked = $query->fetchAll(PDO::FETCH_COLUMN, 0);
            $booked = [];
            foreach ($arrBooked as $day) {
                $i = explode("-", $day);
                array_push($booked, (int) end($i));
            }


            $query = $dbHandler->prepare("SELECT dtStartDate, dtEndDate FROM tblAvaible WHERE fiUser = :id AND dtStartDate > :start AND dtStartDate < :end");
            $query->bindParam("id", $_GET["id"]);
            $query->bindParam("start", date("Y-m-d", strtotime("first day of this month")));
            $query->bindParam("end", date("Y-m-d", strtotime("last day of this month")));

            $query->execute();
            $arrUnavailable = $query->fetchAll();
            $unavailable = [];
            foreach ($arrUnavailable as $entry) {
                $startDay = explode("-", $entry[0]);
                $endDay = explode("-", $entry[1]);
                $start = (int) end($startDay);
                $end = (int) end($endDay);

                echo $start . '<br />';
                echo $end . '<br />';

                if ($start < $end) {
                    for ($i = $start; $i <= $end; $i++) {
                        array_push($unavailable, $i);
                    }
                } else {
                    for ($i = $start; $i <= date("t"); $i++) {
                        array_push($unavailable, $i);
                    }
                }
            }

            foreach ($weeks as $week) {
                echo "<tr>" . PHP_EOL;
                foreach ($week as $day) {
                    if (in_array($day, $booked)) {
                        echo "<td class='booked'>$day</td>" . PHP_EOL;
                    } else if (in_array($day, $unavailable)) {
                        echo "<td class='unavailable'>$day</td>" . PHP_EOL;
                    } else {
                        if (strlen($day) > 0) {
                            echo "<td class='free'>$day</td>" . PHP_EOL;
                        } else {
                            echo "<td></td>" . PHP_EOL;
                        }
                    }
                }
                echo "</tr>" . PHP_EOL;
            }
            ?>
        </tbody>
    </table>
    <div id="colorCode">
        <div class="colorBox booked"></div>
        <p>Booked</p>
        <div class="colorBox unavailable"></div>
        <p>Unavailable</p>
        <div class="colorBox free"></div>
        <p>Free</p>
    </div>
</div>
<?php

include "/var/www/E3T/components/footer.html";

?>
