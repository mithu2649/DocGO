<?php 
    class Upload{
        public static function uploadDocument($doc_title, $doc_description, $file){
                $user_id = Login::isLoggedIn();
    
                $temp = explode(".", $file["name"]);
                $newfilename = round(microtime(true)) . '.' . end($temp);
    
                $target_dir = "uploads/";
                $target_file = $target_dir . $newfilename;

                $uploadOk = 1;
                $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
                if ($file["size"] > 50000000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
    
                if($FileType != "pdf" && $FileType != "txt" && $FileType != "odt" && $FileType != "doc" && $FileType != "docx" && $FileType != "epub" && $FileType != "mobi" && $FileType != "rtf") {
                    echo "Sorry, only pdf, epub, txt, odt, doc, docx, mobi and rtf allowed.";
                    $uploadOk = 0;
                }
    
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                } else {
                    if (move_uploaded_file($file["tmp_name"], $target_file)) {
                        DB::query('INSERT INTO documents VALUES(\'\', :uploaded_by, :title, :doc_desc, NOW(), :doc_url)', array(':uploaded_by'=>$user_id, ':title'=>$doc_title, ':doc_desc'=>$doc_description, ':doc_url'=>$target_file));
                        echo "The file ". basename( $file["name"]). " has been uploaded.";
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }  
            }
        }
?>