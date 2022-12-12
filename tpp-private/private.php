<?php
/*
This is the private talent page where seperate talents will have different seperate personal pages
This is the area where they can upload images of themselfs and their own documnets. They are also able to 
delete these documents.  Profile Image will aslo be changeable. Styling for this page is not a focus. 
The aim of this page is customization.
*/

$arrayofImages = [];
$pictureHolder = "pictureholder/";
$documentHolder = "documentholder/";
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
            <p>Insert talent fname/lname</p>
            <p><b>Specialities: </b>Guitar, Singer, Songwriter, Actor </p>
        </div>

        <div class="email">
            <p>Email address: <a href="mailto:testemail@adus.com">testemail@adus.com</a></p>
        </div>

        <!-- This part should only allow one profile image, meaning if one is uploaded, the previous one is deleted-->
        <div class="profileButtons">
            <form action="#" method="post">
                <input type="file" name="profileFile" id="profileFile">
                <input type="submit" value="Update profile pic" name="newProfilePic">
            </form>
        </div>

        <div class="photoTitle">
            <h1><b>Photos</b></h1>
        </div>

        <div class="photoHolder">

            <!--  first img should be this one for talents so they can add more images later on to the project  -->
            <div class="addImg">
                <form action="#" method="post" enctype="multipart/form-data">
                    <label>
                        <input type="file" name="uploadImg" id="" style="display:none">
                        <img src="stockphotoholder/addimg.png" alt="addimg" id="stockphotoAddImg">
                        <figcaption>
                            <p>Add a new image</p>
                        </figcaption>
                    </label>
            </div>

            </form>

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
                    echo "<img src=" . $item . " alt='images' id='images' height='200' width='200' />";
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
                    echo '<div class="docPics">';
                    echo "<a href='documentholder/doc1.docx' download><img src='stockphotoholder/docxstockphoto.png'  height = 250  width = 200 /></a>";
                    echo '<figcaption>' . $arrayofDocs[$i] . '</figcaption>';
                    echo '</div>';
                }
            }

            ?>

            <!--  add doc image on the bottom -->
            <div class="addDoc">
                <form action="#" method="post" enctype="multipart/form-data">
                    <label>
                        <input type="file" name="uploadDoc" id="" style="display:none">
                        <img src="stockphotoholder/adddoc.png" alt="" height="200" width="200">
                        <figcaption>
                            <p>Add a new document</p>
                        </figcaption>
                    </label>
            </div>

        </div>

        <footer>
            <h1>Placeholder for actuall footer</h1>
        </footer>

    </div>

</body>

</html>