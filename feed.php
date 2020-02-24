<?php 
    include('classes/DB.php');
    include('classes/Login.php');
    $dbposts = "";
    $showTimeline = False;
    if(Login::isLoggedIn()){
        $user_id = Login::isLoggedIn();
        $username = DB::query('SELECT username from users WHERE id=:user_id', array(':user_id'=>$user_id))[0]['username'];

        echo 'logged in as => '.$username;

        $posts = DB::query(
            'SELECT username, url, title, description, posted_at 
            FROM documents, users
            WHERE documents.uploaded_by = users.id
            ORDER BY posted_at DESC
            LIMIT 25'
        );

        foreach($posts as $p){
            $dbposts .= '
            <div class="post">
                <h2>'.$p['title'].'</h2>
                <p>'.$p['description'].'<p>
                <p>'.$p['username'].': '.$p['posted_at'].'<p>
                <a href="'.$p['url'].'">Download</a>
            </div>';
        }
    }else{
        header('location:login');
    }
?>

<div class="posts">
    <?php echo $dbposts; ?>
</div>

<style>
    .post{
        background-color:#e2e2e2;
        padding:10px;
        margin:5px;
    }
</style>