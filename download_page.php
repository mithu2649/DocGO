<?php
include('classes/DB.php');
include('classes/Login.php');
include('inc/header.php');

$document = "";
$document_url = "";
$uploadStatus = "";
$showTimeline = False;
if (Login::isLoggedIn()) {
    $user_id = Login::isLoggedIn();
    $username = DB::query('SELECT username from users WHERE id=:user_id', array(':user_id' => $user_id))[0]['username'];

    $document = DB::query(
        'SELECT username, url, title, description, posted_at, documents.id
            FROM documents, users
            WHERE documents.id = :document_id
            ORDER BY posted_at DESC
            LIMIT 25',
        array(':document_id' => $_GET['id'])
    );
    $document_url = $document[0]['url'];
    foreach ($document as $p) {
        if (pathinfo($p['url'], PATHINFO_EXTENSION) == "pdf") {
            $img = "resources/img/pdf.png";
        } else if (pathinfo($p['url'], PATHINFO_EXTENSION) == "epub") {
            $img = "resources/img/epub.png";
        } else if (pathinfo($p['url'], PATHINFO_EXTENSION) == "docx") {
            $img = "resources/img/docx.png";
        } else if (pathinfo($p['url'], PATHINFO_EXTENSION) == "txt") {
            $img = "resources/img/txt.png";
        } else {
            $img = "resources/img/unknown.png";
        }
    }
} else {
    header('location:login');
}
?>

<div class="jumboText">
    <h1>Just one step more..</h1>
    <h2>Please upload a document to downlod</h2>
    <button id="uploadButton" class="jumboButton">Upload Now</button>
</div>

<div id="uploadFormContainer">
    <form action="download.php" id="uploadForm" enctype="multipart/form-data" method="post">
        <div class="closeForm" id="closeUploadForm">&times;</div>
        <h2>Upload a Document</h2><br>
        <input type="file" name="documentToUpload" id="docmentToUpload" required><br><br>
        <input type="text" name="title" id="docTitle" placeholder="Title" required>
        <textarea name="desc" id="desc" cols="30" rows="10" placeholder="Description of the document" required></textarea>
        <input type="text" style="display:none" name="docurl" value=<?php echo $document_url; ?>>
        <input type="submit" class="submit-btn" value="upload" id="sendDocument" name="upload">
    </form>
</div>

<?php include('inc/footer.php'); ?>