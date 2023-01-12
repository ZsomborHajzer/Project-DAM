<?php

$pageName = "E3T-Talents";
$cssFile = "Booking.css";
include "/var/www/E3T/components/header.php";

?>
    <script>
        $(document).ready(function() {


            $(".subClass").hide();

            $(".dropUpImg").hide();


            $(".mClass").click(function() {

                if ($(".subClass").is(":visible")) {
                    $(".subClass").hide();

                    $(".dropDownImg", this).show();

                    $(".dropUpImg", this).hide();

                } else {

                    $(".mClass > .subClass").fadeOut();
                    $(".dropDownImg", this).hide();
                    $(".dropUpImg", this).show();
                    $(".subClass").prev()
                    $(this).next().fadeIn();
                    $(".mClass > .subClass", this);
                    $(".subClass", this).hide();

                }
            })

            $(function() {
                var dtToday = new Date();

                var month = dtToday.getMonth() + 1;
                var day = dtToday.getDate();
                var year = dtToday.getFullYear();
                if (month < 10)
                    month = '0' + month.toString();
                if (day < 10)
                    day = '0' + day.toString();

                var maxDate = year + '-' + month + '-' + day;

                // or instead:
                // var maxDate = dtToday.toISOString().substr(0, 10);



                $('#dataDate').attr('min', maxDate);
            });
        });
    </script>


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

                        include "/var/www/E3T/components/dbConnect.php";

                        $stmtToGetSpecialites = $dbHandler->query("SELECT * FROM tblspecialties");

                        $arrayFilter = ["Pricing", "Active", "Specialty"];

                        $speciality = array();

                        while ($row = $stmtToGetSpecialites->fetch()) {


                            array_push($speciality, $row['dtDescription']);
                        }

                        foreach ($speciality as $value) {
                            array_push($arrayFilter, $value);
                        }

                        foreach ($arrayFilter as $item) {
                            if ($item == "Specialty") {
                                echo "<option disabled>------- Select a " . $item . " -------</option>";
                            } else {
                                echo "<option value='$item'>$item</option>";
                            }
                        }


                        ?>

                    </select>


                    <input type="submit" value="SearchByFilter" name="dataFilterSearch">
                </form>


                <div class="t-content">
                    <!-- Talent information to be injected using php -->
                    <div class="gen-content">
                        <?php

                        // getting the different filter option to search talents
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {


                            if ($_POST["dataNameOrEmail"] != "") {
                                //if the email is correct then we will filter per Email
                                if (filter_input(INPUT_POST, "dataNameOrEmail", FILTER_VALIDATE_EMAIL)) {

                                    $stmt = $dbHandler->prepare("SELECT * FROM tbluser  INNER JOIN tblspecialties ON fiSpecialty  = tblspecialties.idSpecialty WHERE dtEmail  LIkE ?  AND  dtIsAdmin = 0");

                                    //$stmt->bind_param

                                    $mail = filter_input(INPUT_POST, "dataNameOrEmail", FILTER_VALIDATE_EMAIL);

                                    $stmt->execute(["%$mail%"]);

                                    while ($row = $stmt->fetch()) {
                                        $id = $row['idUser'];
                                        $spec = $row['fiSpecialty'];

                                        echo "<div class= 'g-item'>";
                                        echo "<div class= 'mClass'>";
                                        echo "<img class='g-img' src=" . $row['dtImage'] . ">";
                                        echo "<a class='g-p'><a href='tpp-public/public/view/public.php?id='"  . $row['idUser'] . "'>" . $row['dtFirstName'] . " " . $row['dtLastName'] . "</a></p>";
                                        echo "<p class='g-email'>" . $row['dtEmail'] . "</p>";
                                        echo "<p class='g-descr'>" . $row['dtDescription'] . "</p>";
                                        echo "<p class='g-price'>" . $row['dtPrice'] . "€</p>";
                                        echo "<form>";
                                        echo "<p class='a-p' >Book Me</p>";
                                        echo "<a href='#'> <img class='a-mg dropDownImg' src='../images/dropdown.png'>" . "</a>";
                                        echo "<a href='#'> <img class='a-mg dropUpImg' src='../images/dropUp.png'>" . "</a>";
                                        echo "</form>";
                                        echo "</div>";
                                        echo "<div class='subClass'>";
                                        echo "<p class='s-content s-p'>Select the date of booking</p>";
                        ?>
                                        <form class="s-content" method="post" action="insertIntoBooking.php?id=<?php echo $id ?>&spec=<?php echo $spec ?>">

                                            <div>
                                                <label class="s-label" for="dataDate">Date: </label>
                                                <input class="s-date" type="date" name="dataDate" id="dataDate">
                                            </div>

                                            <div>
                                                <label class="s-label" for="dataMail">Email: </label>
                                                <input class="s-email" type="email" name="dataMail" id="dataMail">
                                            </div>

                                            <input class="s-sub" type="submit" name="dataSendByMail" placeholder="Book">
                                        </form>
                                        <?php
                                        echo "</div>";
                                        echo "</div>";

                                        ?>

                                    <?php

                                    }


                                    //if that is not correct then we will filter per Name
                                } else if (filter_input(INPUT_POST, "dataNameOrEmail", FILTER_SANITIZE_SPECIAL_CHARS)) {

                                    $stmt = $dbHandler->prepare("SELECT * FROM tbluser INNER JOIN tblspecialties ON fiSpecialty  = tblspecialties.idSpecialty  WHERE dtFirstName  LIkE ?  AND  dtIsAdmin = 0");

                                    //$stmt->bind_param

                                    $name = filter_input(INPUT_POST, "dataNameOrEmail", FILTER_SANITIZE_SPECIAL_CHARS);

                                    $stmt->execute(["%$name%"]);

                                    while ($row = $stmt->fetch()) {
                                        $id = $row['idUser'];
                                        $spec = $row['fiSpecialty'];

                                        echo "<div class= 'g-item'>";
                                        echo "<div class= 'mClass'>";
                                        echo "<img class='g-img' src=" . $row['dtImage'] . ">";
                                        echo "<p class='g-p'> <a href='tpp-public/public/view/public.php?id='"  . $row['idUser'] . "'>" . $row['dtFirstName'] . " " . $row['dtLastName'] . "</a></p>";
                                        echo "<p class='g-email'>" . $row['dtEmail'] . "</p>";
                                        echo "<p class='g-descr'>" . $row['dtDescription'] . "</p>";
                                        echo "<p class='g-price'>" . $row['dtPrice'] . "€</p>";
                                        echo "<form>";
                                        echo "<p class='a-p' >Book Me</p>";
                                        echo "<a href='#'> <img class= 'a-mg dropDownImg'  src='../images/dropdown.png'>" . "</a>";
                                        echo "<a href='#'> <img class= 'a-mg dropUpImg' src='../images/dropUp.png'>" . "</a>";
                                        echo "</form>";
                                        echo "</div>";
                                        echo "<div class='subClass'>";
                                        echo "<p class='s-content s-p'>Select the date of booking</p>";
                                    ?>

                                        <form class="s-content" method="post" action="insertIntoBooking.php?id=<?php echo $id ?>&spec=<?php echo $spec ?>">

                                            <div>
                                                <label class="s-label" for="dataDate">Date: </label>
                                                <input class="s-date" type="date" name="dataDate" id="dataDate">
                                            </div>

                                            <div>
                                                <label class="s-label" for="dataMail">Email: </label>
                                                <input class="s-email" type="email" name="dataMail" id="dataMail">
                                            </div>

                                            <input class="s-sub" type="submit" name="dataSendByName" placeholder="Book">

                                        <?php
                                        echo "</div>";
                                        echo "</div>";
                                    }
                                } else {

                                    echo "<h3>Please enter a valid name or Email</h3>";
                                }
                            } else if (isset($_POST["searchBySpec"])) {
                                $sanitzeValue = filter_input(INPUT_POST, "searchBySpec", FILTER_SANITIZE_SPECIAL_CHARS);
                            } else {
                                //if none of the above is the case then a select option has been choosen

                                $sanitzeOption = filter_input(INPUT_POST, "dataTalents", FILTER_SANITIZE_SPECIAL_CHARS);

                                // new test needs to be added. If the users wants to only see avaible ones then we only need to show those ones.

                                if ($sanitzeOption == "Active") {

                                    $stmt = $dbHandler->prepare("SELECT * FROM tbluser INNER JOIN tblspecialties ON fiSpecialty = tblspecialties.idSpecialty  WHERE dtActive = 1  AND  dtIsAdmin = 0   ORDER BY  dtFirstName ASC ");

                                    //$stmt->bind_param

                                    $name = filter_input(INPUT_POST, "dataNameOrEmail", FILTER_SANITIZE_SPECIAL_CHARS);

                                    $stmt->execute();

                                    while ($row = $stmt->fetch()) {
                                        $id = $row['idUser'];
                                        $spec = $row['fiSpecialty'];

                                        echo "<div class= 'g-item'>";
                                        echo "<div class= 'mClass'>";
                                        echo "<img class='g-img' src=" . $row['dtImage'] . ">";
                                        echo "<p class='g-p'> <a href='tpp-public/public/view/public.php?id='"  . $row['idUser'] . "'>" . $row['dtFirstName'] . " " . $row['dtLastName'] . "</a></p>";
                                        echo "<p class='g-email'>" . $row['dtEmail'] . "</p>";
                                        echo "<p class='g-descr'>" . $row['dtDescription'] . "</p>";
                                        echo "<p class='g-price'>" . $row['dtPrice'] . "€</p>";
                                        echo "<form>";
                                        echo "<p class='a-p' >Book Me</p>";
                                        echo "<a href='#'> <img class='a-mg dropDownImg' src='../images/dropdown.png'>" . "</a>";
                                        echo "<a href='#'> <img class='a-mg dropUpImg' src='../images/dropUp.png'>" . "</a>";
                                        echo "</form>";
                                        echo "</div>";
                                        echo "<div class= 'subClass'>";
                                        echo "<p class= 's-content s-p' >Select the date of booking</p>";
                                        ?>

                                            <form class="s-content" method="post" class="s-content" action="insertIntoBooking.php?id=<?php echo $id ?>&spec=<?php echo $spec ?>">

                                                <div>
                                                    <label class="s-label" for="dataDate">Date: </label>
                                                    <input class="s-date" type="date" name="dataDate" id="dataDate">
                                                </div>

                                                <div>
                                                    <label class="s-label" for="dataMail">Email: </label>
                                                    <input class="s-email" type="email" name="dataMail" id="dataMail">
                                                </div>

                                                <input class="s-sub" type="submit" name="dataSendByActive" placeholder="Book">
                                            </form>

                                        <?php
                                        echo "</div>";
                                        echo "</div>";
                                    }
                                } else if ($sanitzeOption == "Pricing") {

                                    $stmt = $dbHandler->prepare("SELECT * FROM tbluser  INNER JOIN tblspecialties ON 	fiSpecialty  = tblspecialties.idSpecialty   WHERE dtIsAdmin = 0 ORDER BY dtPrice  ASC");

                                    //$stmt->bind_param

                                    $name = filter_input(INPUT_POST, "dataNameOrEmail", FILTER_SANITIZE_SPECIAL_CHARS);

                                    $stmt->execute();
                                    while ($row = $stmt->fetch()) {
                                        $id = $row['idUser'];
                                        $spec = $row['fiSpecialty'];

                                        //<option disabled selected value> -- select an option --</option>
                                        echo "<div class= 'g-item'>";
                                        echo "<div class= 'mClass'>";
                                        echo "<img class='g-img' src=" . $row['dtImage'] . ">";
                                        echo "<p class='g-p'><a href='tpp-public/public/view/public.php?id='"  . $row['idUser'] . "'>" . $row['dtFirstName'] . " " . $row['dtLastName'] . "</a></p>";
                                        echo "<p class='g-mail'>" . $row['dtEmail'] . "</p>";
                                        echo "<p class='g-descr'>" . $row['dtDescription'] . "</p>";
                                        echo "<p class='g-price'>" . $row['dtPrice'] . "€</p>";
                                        echo "<form>";
                                        echo "<p class='a-p' >Book Me</p>";
                                        echo "<a href='#'> <img class='a-mg dropDownImg' src='../images/dropdown.png'>" . "</a>";
                                        echo "<a href='#'> <img class='a-mg dropUpImg' src='../images/dropUp.png'>" . "</a>";
                                        echo "</form>";
                                        echo "</div>";
                                        echo "<div class='subClass'>";
                                        echo "<p class='s-content s-p' >Select the date of booking</p>";
                                        ?>

                                            <form class="s-content" method="post" action="insertIntoBooking.php?id=<?php echo $id ?>&spec=<?php echo $spec ?>">

                                                <div>
                                                    <label class="s-label" for="dataDate">Date: </label>
                                                    <input class="s-date" type="date" name="dataDate" id="dataDate">
                                                </div>

                                                <div>
                                                    <label class="s-label" for="dataMail">Email: </label>
                                                    <input class="s-email" type="email" name="dataMail" id="dataMail">
                                                </div>

                                                <input class="s-sub" type="submit" name="dataSendByPrice" placeholder="Book">
                                            </form>
                                        <?php
                                        echo "</div>";
                                        echo "</div>";
                                    }
                                } else {


                                    $stmt = $dbHandler->prepare("SELECT * FROM tbluser INNER JOIN tblspecialties ON fiSpecialty = tblspecialties.idSpecialty WHERE dtIsAdmin = 0 AND tblspecialties.dtDescription = ? ORDER BY dtPrice ASC;");

                                    //$stmt->bind_param

                                    $name = filter_input(INPUT_POST, "dataNameOrEmail", FILTER_SANITIZE_SPECIAL_CHARS);

                                    $stmt->execute(["$sanitzeOption"]);
                                    while ($row = $stmt->fetch()) {
                                        $id = $row['idUser'];
                                        $spec = $row['fiSpecialty'];

                                        //<option disabled selected value> -- select an option --</option>
                                        echo "<div class= 'g-item'>";
                                        echo "<div class= 'mClass'>";
                                        echo "<img class='g-img' src=" . $row['dtImage'] . ">";
                                        echo "<p class='g-p'><a href='tpp-public/public/view/public.php?id='"  . $row['idUser'] . "'>" . $row['dtFirstName'] . " " . $row['dtLastName'] . "</a></p>";
                                        echo "<p class='g-email'>" . $row['dtEmail'] . "</p>";
                                        echo "<p class='g-descr'>" . $row['dtDescription'] . "</p>";
                                        echo "<p class='g-price'>" . $row['dtPrice'] . "€</p>";
                                        echo "<form>";
                                        echo "<p class='a-p' >Book Me</p>";
                                        echo "<a href='#'> <img class='a-mg dropDownImg' src='../images/dropdown.png'>" . "</a>";
                                        echo "<a href='#'> <img class='a-mg dropUpImg' src='../images/dropUp.png'>" . "</a>";
                                        echo "</form>";
                                        echo "</div>";
                                        echo "<div class='subClass'>";
                                        echo "<p class='s-content s-p' >Select the date of booking</p>";
                                        ?>

                                            <form class="s-content" method="post" action="insertIntoBooking.php?id=<?php echo $id ?>&spec=<?php echo $spec ?>">

                                                <div>
                                                    <label class="s-label" for="dataDate">Date: </label>
                                                    <input class="s-date" type="date" name="dataDate" id="dataDate">
                                                </div>

                                                <div>
                                                    <label class="s-label" for="dataMail">Email: </label>
                                                    <input class="s-email" type="email" name="dataMail" id="dataMail">
                                                </div>

                                                <input class="s-sub" type="submit" name="dataSendByPrice" placeholder="Book">
                                            </form>
                            <?php
                                        echo "</div>";
                                        echo "</div>";
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
    <!-- Foooter -->


   
</body>

<script src="deskapp.js"></script>

<?php

include "/var/www/E3T/components/footer.html";

?>