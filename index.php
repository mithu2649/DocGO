<?php
    include('classes/DB.php');
    include('classes/Login.php');
    include('classes/Upload.php');
    include('inc/header.php');

    $showTimeline = False;
    if(Login::isLoggedIn()){
        $user_id = Login::isLoggedIn();
        $username = DB::query('SELECT username from users WHERE id=:user_id', array(':user_id'=>$user_id))[0]['username'];
        if(isset($_POST['upload'])){
            $doc_title= $_POST['title'];
            $doc_description= $_POST['desc'];
            $file = $_FILES["documentToUpload"];
            Upload::uploadDocument($doc_title, $doc_description, $file);
        }
    }else{
        header('location:login');
    }
?>
<div id="actionButton"><i class="fa fa-search" aria-hidden="true"></i></div>
<div id="overlay-dark">
    <form method="post" action="search.php">
        <input type="text" name="q" id="search_field" autocomplete="off" placeholder="Search for documents" required><br><br>
        <input type="submit" value="Search">
        <div id="closeSearch">&plus;</div>
    </form>
</div>
<div class="jumboText">
    <h1>Hello, <?php echo $username; ?></h1>
    <h2>Always feel free to contribute to the DocGo community</h2>
    <button class="jumboButton">Upload Now</button>
</div>
<!-- 
<form action="index.php" method="post" enctype="multipart/form-data">
    <input type="text" name="title" id="title" placeholder="Title">
    <textarea name="desc" id="desc" cols="30" rows="10" placeholder="Description of the document"></textarea>
    <input type="file" name="documentToUpload" id="docment">
    <input type="submit" value="upload" name="upload">
</form>
-->

<script src="resources/js/index.js"></script>