<?php 
    include('classes/DB.php');
    include('classes/Login.php');

    $showTimeline = False;
    if(Login::isLoggedIn()){
        $user_id = Login::isLoggedIn();
        $username = DB::query('SELECT username from users WHERE id=:user_id', array(':user_id'=>$user_id))[0]['username'];

        echo 'logged in as => '.$username;

    }else{
        header('location:login.php');
    }
?>

<form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="text" name="title" id="title" placeholder="Title">
    <textarea name="desc" id="desc" cols="30" rows="10" placeholder="Description of the document"></textarea>
    <input type="file" name="documentToUpload" id="docment">
    <input type="submit" value="upload" name="upload">
</form>

<form method="post" action="search.php">
    <input type="text" name="q" id="search_field">
    <input type="submit" value="search">
</form>

<style>
input{
    display:block;
    padding:10px;
}
</style>