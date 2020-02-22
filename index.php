<?php 
    include('classes/DB.php');
    include('classes/Login.php');
    include('classes/Upload.php');

    $showTimeline = False;
    if(Login::isLoggedIn()){
        $user_id = Login::isLoggedIn();
        $username = DB::query('SELECT username from users WHERE id=:user_id', array(':user_id'=>$user_id))[0]['username'];
        
        echo 'logged in as => '.$username;

        if(isset($_POST['upload'])){

            $doc_title= $_POST['title'];
            $doc_description= $_POST['desc'];
            $file = $_FILES["documentToUpload"];

            Upload::uploadDocument($doc_title, $doc_description, $file);
        }
        
    }else{
        header('location:login.php');
    }
?>

<form action="index.php" method="post" enctype="multipart/form-data">
    <input type="text" name="title" id="title" placeholder="Title">
    <textarea name="desc" id="desc" cols="30" rows="10" placeholder="Description of the document"></textarea>
    <input type="file" name="documentToUpload" id="docment">
    <input type="submit" value="upload" name="upload">
</form>

<form method="post" action="search.php">
    <input type="text" name="q" id="search_field" placeholder="Search for documents">
    <input type="submit" value="search">
</form>

<style>
input{
    display:block;
    padding:10px;
}
</style>