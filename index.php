<?php 
    include('classes/DB.php');
    include('classes/Login.php');

    $showTimeline = False;
    if(Login::isLoggedIn()){
        $user_id = Login::isLoggedIn();
        echo 'logged in as '.$user_id;
    }else{
        header('location:login.php');
    }
    
?>