<?php
session_start();
$sessionID = $_SESSION["id"];
$uploadDoc = "uploadDoc";

$documentLocation = "/home/share/e3t/" . $sessionID. "/docs/";
$fileSize = (4 * 1024 * 1024);

$config["upload_path"] = $documentLocation;
if (!is_dir($documentLocation)) {
    $oldMask = umask(0);
    mkdir($documentLocation, 0777);
    umask($oldMask);
}


if ($_FILES[$uploadDoc]["error"] == 0) {

    if ($_FILES[$uploadDoc]["size"] < $fileSize) {

        //accepted file types = .txt/.docx/.doc
        $acceptedFileTypes = ["application/vnd.openxmlformats-officedocument.wordprocessingml.document", "text/plain", "application/msword"];

        $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
        $uploadedFileType = finfo_file($fileinfo, $_FILES[$uploadDoc]["tmp_name"]);

        if (in_array($uploadedFileType, $acceptedFileTypes)) {
            if (!file_exists($documentLocation . $_FILES[$uploadDoc]["name"])) {

                //move_uploaded_file is a function that checks if the file was uploaded a secure way and if it was it will move it to the designated place. The first parameter checks if it was uploaded using a post mechanism, the second parameter transfers it to the designated file holder. If this function passes, it returns a true. if it does not it returns a false.
                if (move_uploaded_file($_FILES[$uploadDoc]["tmp_name"], $documentLocation . $_FILES[$uploadDoc]["name"])) {
                    header("Location: private.php");
                } else {
                    echo "Error";
                }
            } else {
                echo "File already exists";
            }
        } else {
            echo "Wrong file type";
        }
    } else {echo "Size to big";
    }
} else {
    echo "Error";

}

