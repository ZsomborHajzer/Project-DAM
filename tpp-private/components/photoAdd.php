<?php
$fileholder = "../img/pictureholder/";
$fileSize = (4 * 1024 * 1024);


if ($_FILES["uploadImg"]["error"] == 0) {

    if ($_FILES["uploadImg"]["size"] < $fileSize) {

        $acceptedFileTypes = ["image/gif", "image/jpg", "image/jpeg", "image/png"];

        $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
        $uploadedFileType = finfo_file($fileinfo, $_FILES["uploadImg"]["tmp_name"]);

        if (in_array($uploadedFileType, $acceptedFileTypes)) {
            if (!file_exists($fileholder . $_FILES["uploadImg"]["name"])) {

                //move_uploaded_file is a function that checks if the file was uploaded a secure way and if it was it will move it to the designated place. The first parameter checks if it was uploaded using a post mechanism, the second parameter transfers it to the designated file holder. If this function passes, it returns a true. if it does not it returns a false.
                if (move_uploaded_file($_FILES["uploadImg"]["tmp_name"], $fileholder . $_FILES["uploadImg"]["name"])) {
                } else {
                    echo "Something went wrong";
                }
            } else {
            }
        } else {
            echo "Invalid file type. Must be gif, jpeg or jpg or png";
        }
    } else {
        echo "File size too larg";
    }
} else {
    echo "There was an unexpected error try again";
}
