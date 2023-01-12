<?php

$pageName = "E3T-Talents";
$cssFile = "ttpPrivate.css";
include "/var/www/E3T/components/header.php";

/*
This is the private talent page where seperate talents will have different seperate personal pages
This is the area where they can upload images of themselfs and their own documnets. They are also able to 
delete these documents.  Profile Image will aslo be changeable. Styling for this page is not a focus. 
The aim of this page is customization.
*/
/*
//Double refresh the page in order to update the profile picture correctly
if (isset($_POST["newProfilePic"])) {
    header("Location: private.php");
}

//double refresh is required apperantly at all new file uploads
if (isset($_POST["imgUpload"])) {
    header("Location: private.php");
}
//double refresh is required apperantly at all new file uploads
if (isset($_POST["docUpload"])) {
    header("Location: private.php");
}

//double refresh is required apperantly at all new file uploads
if (isset($_POST["deletePic"])) {
    header("Location: private.php");
}
*/
//Database connect
include "/var/www/E3T/components/dbConnect.php";
/*-
$arrayofImages = [];
$pictureHolder = "../img/pictureholder/";
$documentHolder = "../img/documentholder/";
$profileImgLocations = "../img/profileimg/";
$stockPhotoLocation = "images/stockphotoholder/addimg.png";
$addDocLocation = "img/stockphotoholder/adddoc.png";
$stockDocumentLocation = "img/stockphotoholder/";
$files = [];
$profileFiles = [];
$fileSize = 4 * 1024 * 1024; //4MB
*/
//Session variables
$sessionID = $_SESSION["id"];

?>

    <script>

        //jqurey script to not allow select of day before today
        $(document).ready(function () {
            $(function () {
                let dtToday = new Date();

                let month = dtToday.getMonth() + 1;
                let day = dtToday.getDate();
                let year = dtToday.getFullYear();
                if (month < 10)
                    month = '0' + month.toString();
                if (day < 10)
                    day = '0' + day.toString();

                let maxDate = year + '-' + month + '-' + day;

                // or instead:
                // var maxDate = dtToday.toISOString().substr(0, 10);


                $('#dataStartDate').attr('min', maxDate);

            });



            //don't allow select before the start of vacation

            $('#dataStartDate').on('change', function() {

                let selectedDate = this.value;


                $('#dataEndDate').attr('min', selectedDate);
            });

        });


    </script>


    <div class="container">



   

        <?php
        //This is query requesting information from user database 
        $query = "SELECT * FROM tblUser WHERE idUser= $sessionID";
        $stmt = $dbHandler->prepare($query);
        $stmt->execute();
        $posts = $stmt->fetch(PDO::FETCH_ASSOC);

        //This is to get the description based on the value get from fiSpecialty
        $query2 = 'SELECT * FROM tblSpecialty WHERE idSpecialty = ' . $posts["fiSpecialty"];
        $stmt2 = $dbHandler->prepare($query2);
        $stmt2->execute();
        $talents = $stmt2->fetch(PDO::FETCH_ASSOC);

        ?>

        <div class="talentInfo">
            <p><?php echo $posts["dtFirstName"] . "&nbsp" . $posts["dtLastName"]; ?></p>
            <p><b>Speciality: </b> <?php echo $talents["dtDescription"]; ?></p>
        </div>

        <div class="email">
            <p>Email address: <a href="mailto:testemail@adus.com"><?php echo $posts["dtEmail"]; ?></a></p>
        </div>

        <!-- This part should only allow one profile image, meaning if one is uploaded, the previous one is deleted-->
        <div class="profileButtons">
            <form action="#" method="post" enctype="multipart/form-data">
                <input type="file" name="profileFile" id="profileFile">
                <input type="submit" value="Update profile pic" name="newProfilePic">
            </form>
        </div>



        <div class="vacation">
            <h3>Add Vacation</h3>
            <form method="post">
                <input  id="dataStartDate" name="dataStartDate" type="date">
                <input  id="dataEndDate" name="dataEndDate" type="date">
                <input type="submit" id="dataSendVacation" name="dataSendVacation">
            </form>
        </div>

        <?php

        if (isset($_POST["dataSendVacation"])) {



                if ($startDate = filter_input(INPUT_POST,"dataStartDate",FILTER_SANITIZE_NUMBER_INT) && $endDate = filter_input(INPUT_POST,"dataEndDate", FILTER_SANITIZE_NUMBER_INT)) {

                    $date = $_POST["dataStartDate"];

                    $query = $dbHandler->query("SELECT `dtDateStart`, `dtDateEnd` FROM tblavaible WHERE `dtDateStart` = '$startDate'   AND `dtDateEnd` ='$endDate'");
                    $rows = $query->fetchAll();



                    if ($rows  == null) {
                        try {
                            $sql = "INSERT INTO tblavaible (dtDateStart, dtDateEnd, fiUser, dtTrue) VALUES (?,?,?,?)";
                            $stmt = $dbHandler->prepare($sql);
                            $stmt->execute([$date, $endDate, $sessionID, 1]);
                            header("Refresh:0");
                            echo "Vacation was added";
                        }catch (PDOException $e) {
                            echo "You already have vacation on the selected date";
                        }


                    }else {
                        echo "You already have vacation here";

                    }

                }else {
                    echo "<script>alert('Please select a valid date')</script>";
                }


        }
        ?>


<h3>Upload Pic </h3>


      <!--  first img should be this one for talents so they can add more images later on to the project  -->


    <?php
    if (isset($_POST["newProfilePic"])) {
        $sessionID = $_SESSION["id"];
        $name = $_SESSION["name"];


        $newPfrad = "/home/share/e3t/" . $sessionID . "/";
        $fileSize = (4 * 1024 * 1024);


        $config["upload_path"] = $newPfrad;


        if (!is_dir($newPfrad)) {
            $oldMask = umask(0);
            mkdir($folderName, 0777);
            umask($oldMask);
        }


        if ($_FILES["profileFile"]["error"] == 0) {

            if ($_FILES["profileFile"]["size"] < $fileSize) {

                $acceptedFileTypes = ["image/gif", "image/jpg", "image/jpeg", "image/png"];

                $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
                $uploadedFileType = finfo_file($fileinfo, $_FILES["profileFile"]["tmp_name"]);

                if (in_array($uploadedFileType, $acceptedFileTypes)) {
                    if (!file_exists($newPfrad . $_FILES["profileFile"]["name"])) {

                        //move_uploaded_file is a function that checks if the file was uploaded a secure way and if it was it will move it to the designated place. The first parameter checks if it was uploaded using a post mechanism, the second parameter transfers it to the designated file holder. If this function passes, it returns a true. if it does not it returns a false.
                        if (move_uploaded_file($_FILES["profileFile"]["tmp_name"], $newPfrad . $_FILES["uploadImg"]["name"])) {
                            echo "ok";
                        } else {
                            echo "Something went wrong";
                        }
                    } else {
                    }
                } else {
                }
            } else {
            }
        }
    }
?>

    </div>

    <?php

include "/var/www/E3T/components/footer.html";

?>