<?php
/* This is the public page for the talents which the general user will be able to see
There are folders with  with pre uploaded image files so that the webpage is not empty
There is a dynamic upload function which is run through a sorting algorithm which makes sure that the newest image is always on top
There are a lot of placeholders such as name and email and other info that will be accessible from database later on
*/

// variables needed for later
$arrayofImages = [];
$pictureHolder = "../img/pictureholder/";
$documentHolder = "../img/documentholder/";
$profileImgLocations = "../img/profileimg/";
$files = [];
$sessionID = 12; // $_GET["id"];

require "../../components/dbConnect.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talent personal page</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container">

        <header>
            <h1>Placeholder for actual header</h1>
        </header>

        <div class="profileImage">
            <img src="<?php
                        $printedProfile = scandir($profileImgLocations);
                        echo $profileImgLocations . $printedProfile[2];
                        ?>" alt="" width=200 height=200 />
        </div>

        <?php
        //This is query requesting information from user database 
        $query = 'SELECT * FROM tblUser WHERE idUser= ' . $sessionID . ';';
        $stmt = $dbHandler->prepare($query);
        $stmt->execute();
        $posts = $stmt->fetch(PDO::FETCH_ASSOC);

        //This is to get the description based on the value get from fiSpecialty
        $query2 = 'SELECT * FROM tblSpecialty WHERE idSpecialty = ' . $posts["fiSpecialty"] . '  ';
        $stmt2 = $dbHandler->prepare($query2);
        $stmt2->execute();
        $talents = $stmt2->fetch(PDO::FETCH_ASSOC);
        ?>


        <div class="talentInfo">
            <?php
            echo "<p>" . $posts["dtFirstName"] . "&nbsp" . $posts["dtLastName"] . "</p>";
            echo " <p><b>Specialities: </b>" . $talents["dtDescription"] . "</p>";
            ?>
        </div>

        <div class="email">
            <p>Email address: <a href="mailto:<?php echo $posts["dtEmail"] ?>"><?php echo $posts["dtEmail"]; ?></a></p>

            <?php


            $stmt = $dbHandler->prepare("SELECT * FROM tblavaible  WHERE fiUser = $sessionID");

            $stmt->execute();
            echo "<h3>On vacation during</h3>";
            while ($row = $stmt->fetch()) {

                echo $row["dtDateStart"] . " till " . $row["dtDateEnd"] ."</br>";
            }



            ?>


        </div>

        <div class="photoTitle">
            <h1><b>Photos</b></h1>
        </div>

        <div class="photoHolder">
            <?php

            // checks if there is a directory in that address or not
            if (is_dir($pictureHolder)) {

                // if there is a directory, scan the names of the files in that directory and put it in a array called $array of images
                $arrayofImages = scandir($pictureHolder);

                // count the number of pictures in the array 
                // exclude the ones called '.' and '..' cuz those are invisible for the user
                // push the names of the files with  complete location this time to another array called $files
                for ($i = 0; $i < count($arrayofImages); $i++) {
                    if ($arrayofImages[$i] != '.' && $arrayofImages[$i] != '..') {
                        array_push($files, $pictureHolder . $arrayofImages[$i]);
                    }
                }

                // sort files by last modified date
                // orders them by most recently modified on top and last modified on bottom
                // renaming files does not count as modification apperantly

                usort(
                    $files,
                    function ($x, $y) {
                        return filemtime($y) <=> filemtime($x);
                    }
                );

                // echo the html script with file locations

                foreach ($files as $item) {
                    echo "<div class='pic'>";
                    echo "<img src=" . $item . " height = 250  width = 200 />";
                    echo "<figcaption> <p>Variable input from </br> user limited to a few words</p> </figcaption>";
                    echo "</div>";
                }
            }

            ?>

        </div>

        <div class="documentsTitle">
            <h2>Documents</h2>
        </div>

        <div class="documents">

            <?php

            // check if documentholder location exists
            if (is_dir($documentHolder)) {

                // puts the name of the docs into the array $arrayofDocs
                $arrayofDocs = scandir($documentHolder);

                // count the number of docs in the array (starts at two because of the invisible docs '.' and '..')
                for ($i = 2; $i < count($arrayofDocs); $i++) {

                    // html gibberish
                    echo "<div class='docPics'>";
                    echo "<a href=' ../img/documentholder/doc1.docx' download><img src='../img/stockphotoholder/docxstockphoto.png'  height = 250  width = 200 /></a>";
                    echo "<figcaption>" . $arrayofDocs[$i] . "</figcaption>";
                    echo "</div>";
                }
            }

            ?>

        </div>

        <footer>
            <h1>Placeholder for actuall footer</h1>
        </footer>

    </div>

</body>

</html>