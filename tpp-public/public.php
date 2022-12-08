<?php
$arrayofImages=[];
$pictureholder = "pictureholder/";
$documentholder = "documentholder/";
$files = [];
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talent personal page</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">

        <header>
            <h1>Placeholder for actual header</h1>
        </header>


        <div class="profileImage">
            <img src="profileimg/img0.gif" alt="" width=200 height=200 />
        </div>

        <div class="talentInfo">
            <p>Adus Adus</p>
            <p><b>Specialities: </b>Guitar, Singer, Songwriter, Actor </p>
        </div>
        <div class="email">
            <p>Email address: <a href="mailto:testemail@adus.com">testemail@adus.com</a></p>
        </div>

        <div class="phototitle">
            <h1><b>Photos</b></h1>
        </div>

        <div class="photoholder">
            <?php

            // checks if there is a directory in that address or not
            if (is_dir($pictureholder)) {

                // if there is a directory, scan the names of the files in that directory and put it in a array called $array of images
                $arrayofImages = scandir($pictureholder);


                //count the number of pictures in the array 
                //exclude the ones called '.' and '..' cuz those are invisible for the user
                // push the names of the files with  complete location this time to another array called $files
                for ($i = 0; $i < count($arrayofImages); $i++) {
                    if ($arrayofImages[$i] != '.' && $arrayofImages[$i] != '..') {

                        array_push($files, $pictureholder . $arrayofImages[$i]);
                    }
                }

                // sort files by last modified date
                // orders them by most recently modified on top and last modified on bottom

                //renaming files does not count as modification apperantly

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
                    echo '<figcaption> <p>Variable input from </br> user limited to a few words</p> </figcaption>';
                    echo "</div>";
                }
            }

            ?>


        </div>




        <div class="documentstitle">
            <h2>Documents</h2>
        </div>

        <div class="documents">

            <?php

            // check if documentholder location exists
            if (is_dir($documentholder)) {


                // puts the name of the docs into the array $arrayofDocs
                $arrayofDocs = scandir($documentholder);

                //count the number of docs in the array (starts at two because of the invisible docs '.' and '..')
                for ($i = 2; $i < count($arrayofDocs); $i++) {



                    //html gibberish
                    echo '<div class="docpics">';
                    echo "<a href='documentholder/doc1.docx' download><img src='stockphotoholder/docxstockphoto.png'  height = 250  width = 200 /></a>";
                    echo '<figcaption>' . $arrayofDocs[$i] . '</figcaption>';
                    echo '</div>';
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