<?php
include('classes/DB.php');
include('classes/Login.php');
include('inc/header.php');
if (Login::isLoggedIn()) {
    $user_id = Login::isLoggedIn();
    $username = DB::query('SELECT username from users WHERE id=:user_id', array(':user_id' => $user_id))[0]['username'];

    if (isset($_POST['upload'])) {
        $doc_url = $_POST['docurl'];
        $doc_title = $_POST['title'];
        $doc_description = $_POST['desc'];
        $file = $_FILES["documentToUpload"];

        $temp = explode(".", $file["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);

        $target_dir = "uploads/";
        $target_file = $target_dir . $newfilename;

        $uploadOk = 1;
        $FileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (strlen($doc_title) < 15) {
            echo 'Title too short: Please provide with a descriptive title.';
            $uploadOk = 0;
        }
        if (strlen($doc_description) < 40) {
            echo 'Description too short: Please add more details about the document.';
            $uploadOk = 0;
        }

        if ($file["size"] > 50000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if ($FileType != "pdf" && $FileType != "txt" && $FileType != "odt" && $FileType != "doc" && $FileType != "docx" && $FileType != "epub" && $FileType != "mobi" && $FileType != "rtf") {
            echo "Sorry, only pdf, epub, txt, odt, doc, docx, mobi and rtf allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                DB::query('INSERT INTO documents VALUES(\'\', :uploaded_by, :title, :doc_desc, NOW(), :doc_url)', array(':uploaded_by' => $user_id, ':title' => $doc_title, ':doc_desc' => $doc_description, ':doc_url' => $target_file));
                echo '
                        <div class="download_container">
                            <p style="color:#fff;">Successfully uploaded!</p>
                            <h1 style="color: #369666;">Thankyou for contributing!</h1>
                            <a class="postLink" href="' . $doc_url . '">Download Now</a>
                        </div>
                        ';
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        header('location: feed');
    }
}

include('inc/footer.php');
