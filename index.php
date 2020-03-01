<?php
include('classes/DB.php');
include('classes/Login.php');
include('classes/Upload.php');
include('inc/header.php');

$showTimeline = False;
if (Login::isLoggedIn()) {
    $user_id = Login::isLoggedIn();
    $username = DB::query('SELECT username from users WHERE id=:user_id', array(':user_id' => $user_id))[0]['username'];

    if (isset($_POST['upload'])) {
        $doc_title = $_POST['title'];
        $doc_description = $_POST['desc'];
        $file = $_FILES["documentToUpload"];

        Upload::uploadDocument($doc_title, $doc_description, $file);
    }
} else {
    header('location:login');
}
?>

<div class="jumboText">

    <form class="searchform" method="post" action="search.php">
        <input type="text" name="q" id="search_field" autocomplete="off" placeholder="Search for documents" required><input type="submit" value="Search">
    </form>

    <h1>Hello, <?php echo $username; ?></h1>
    <h2>Always feel free to contribute to the DocGo community</h2>
    <button id="uploadButton" class="jumboButton">Upload Now</button>
</div>

<div id="uploadFormContainer">
    <form action="index.php" enctype="multipart/form-data" method="post">
        <div class="closeForm" id="closeUploadForm">&times;</div>
        <h2>Upload a Document</h2><br>
        <input type="file" name="documentToUpload" id="docmentToUpload" required><br><br>
        <input type="text" name="title" id="docTitle" placeholder="Title" required>
        <textarea name="desc" id="desc" cols="30" rows="10" placeholder="Description of the document" required></textarea>
        <input type="submit" value="upload" name="upload">
    </form>
</div>
<?php include('inc/footer.php'); ?>