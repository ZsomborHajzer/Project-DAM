<?php

$pageName = "E3T-home";
$cssFile = "calendarStyles.css";
include "/var/www/E3T/components/header.php";

?>

<?
// $month = 12;
// $year = 2022;

$stamp = time();
$start_day = date('N', $stamp);
$end_day = date('t', $stamp);

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
<h1 id="calendarTitle">My Calendar</h1>
<div id="calenderMain">
    <table id="calenderTable">
        <thead>
            <tr>
                <th colspan=7>My calendar</th>
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
            <?
            foreach ($weeks as $week) {
                echo "<tr>" . PHP_EOL;
                foreach ($week as $day) {
                    echo "<td>$day</td>" . PHP_EOL;
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
