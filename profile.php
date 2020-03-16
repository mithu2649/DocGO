<?php
include('classes/DB.php');
include('classes/Login.php');
include('classes/Upload.php');
include('inc/header.php');

$showTimeline = False;
if (Login::isLoggedIn()) {
    $user_id = Login::isLoggedIn();
    $user = DB::query('SELECT username, user_img, email FROM users WHERE id = :user_id;', array('user_id' => $user_id));

    $username = $user[0]['username'];
    $user_email = $user[0]['email'];
    $user_img = $user[0]['user_img'];
} else {
    header('location:login');
}

if(isset($_FILES['user_image'])){
    $file = $_FILES['user_image'];
    $temp = explode(".", $file["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);

    $target_dir = "uploads/user_images/";
    $target_file = $target_dir.$newfilename;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["user_image"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
    }

    if($uploadOk == 0){
        echo 'Couldn\'t update your profile picture. <br> Please try again later.';
    }else{
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            // DB::query('UPDATE users SET user_img=:user_img WHERE id=user_id', array(':user_img'=>$target_file, ':user_id'=>$user_id));
                DB::query('UPDATE users SET user_img=:userimg WHERE id=:userid', array(':userimg'=>$target_file, ':userid'=>$user_id));
            echo "Your profile picture has been updated";
            header('location: profile');
        } 
    }
}

?>
<div class="profile-container">
    <div class="img-container-parent"><div class="img-container" id="user_img" style="background:url('<?php echo $user_img; ?>')"></div></div>
    <h1><?php echo $username; ?></h1>
    <a class="email" href="mailto:<?php echo $user_email; ?>"><?php echo $user_email; ?></a>
    <form id="upload_user_image" name="uploadUserImage" action="profile.php" style="display:none" enctype="multipart/form-data" method="post">
        <input type="file" name="user_image" id="user_image_input" onchange="this.form.submit()"/>
    </form><br><br>
    <a href="logout" class="logout-btn">Logout</a>
</div>

<?php
include('inc/footer.php')
?>
<script>

        $('#user_img').click(function(){
            $('#user_image_input').click();
        });
        // $('#user_image_input').change(function(){
        //     $('#upload_user_image').submit();
        // });

</script>