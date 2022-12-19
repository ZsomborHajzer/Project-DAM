   
   <?php

    //Check for POST request by user


    //If The update profile pic button was pressed then...
    if (isset($_POST['newProfilePic'])) {

        //4mb max filesize
        $fileSize = (4 * 1024 * 1024);
        $profileImgLocations = "../img/profileimg/";

        //Check for error in uploaded file. If == 0 then no error
        if ($_FILES["profileFile"]["error"] == 0) {

            // Check for fileSize and determain the accepted file types
            if ($_FILES["profileFile"]["size"] < $fileSize) {
                $acceptedFileTypes = ["image/gif", "image/jpg", "image/jpeg", "image/png"];
                $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
                $uploadedFileType = finfo_file($fileinfo, $_FILES["profileFile"]["tmp_name"]);

                //Check if the file type meets the requierments and check if the file is already existing in our direcotrory or no
                if (in_array($uploadedFileType, $acceptedFileTypes)) {
                    if (!file_exists($profileImgLocations . $_FILES["profileFile"]["name"])) {

                        //if it didnt exist then upload the file into our directory
                        if (move_uploaded_file($_FILES["profileFile"]["tmp_name"], $profileImgLocations . $_FILES["profileFile"]["name"])) {

                            if (is_dir($profileImgLocations)) {

                                // if there is a directory, scan the names of the files in that directory and put it in a array called $array of images
                                $arrayofProfiles = scandir($profileImgLocations);

                                // count the number of pictures in the array
                                // exclude the ones called '.' and '..' cuz those are invisible for the user
                                // push the names of the files with  complete location this time to another array called $files
                                for ($i = 0; $i < count($arrayofProfiles); $i++) {
                                    if ($arrayofProfiles[$i] != '.' && $arrayofProfiles[$i] != '..') {

                                        array_push($profileFiles, $profileImgLocations . $arrayofProfiles[$i]);
                                    }
                                }

                                // sort files by last modified date
                                // orders them by most recently modified on top and last modified on bottom
                                // renaming files does not count as modification apperantly

                                usort(
                                    $profileFiles,
                                    function ($x, $y) {
                                        return filemtime($y) <=> filemtime($x);
                                    }
                                );
                                //Sort them with usort by unix timestamp and then later delete the last item in the array. The last item should always be array[1] since there should be max 2 files.

                                $filetoDelete = $profileFiles[1];
                                unlink($filetoDelete);
                            }
                        } else {
                            echo "Something went wrong please try again";
                        }
                    } else {
                        echo "already there bro";
                    }
                } else {
                    echo "Please Make sure the image file is of the type: PNG, JPEG, JPG or GIF";
                }
            } else {
                echo "Error file size too larg";
            }
        } else {
            echo "There was an unexpected error try again";
        }
    }

    ?>