<?php 
    include('classes/DB.php');
    include('classes/Login.php');
    include('inc/header.php');
    $dbposts = "";
    $showTimeline = False;
    if(Login::isLoggedIn()){
        $user_id = Login::isLoggedIn();
        $username = DB::query('SELECT username from users WHERE id=:user_id', array(':user_id'=>$user_id))[0]['username'];

        $posts = DB::query(
            'SELECT username, url, title, description, posted_at 
            FROM documents, users
            WHERE documents.uploaded_by = users.id
            ORDER BY posted_at DESC
            LIMIT 25'
        );

        foreach($posts as $p){

            if(pathinfo($p['url'], PATHINFO_EXTENSION) == "pdf"){
                $img = "resources/img/pdf.png";
            }else if(pathinfo($p['url'], PATHINFO_EXTENSION) == "epub"){
                $img = "resources/img/epub.png";
            }else if(pathinfo($p['url'], PATHINFO_EXTENSION) == "docx"){
                $img = "resources/img/docx.png";
            }
            else if(pathinfo($p['url'], PATHINFO_EXTENSION) == "txt"){
                $img = "resources/img/txt.png";
            }else{
                $img = "resources/img/unknown.png";
            }

            $dbposts .= '
            <div class="post">
                <div class="postImg filetype">
                    <img src="'.$img.'"/>
                </div>
                <div class="postContent">
                    <h2 class="postTitle">'.$p['title'].'</h2><br>
                    <p class="postDesc">'.substr($p['description'], 0, 250).'...</p><br>
                    <p class="postAuthor">'.$p['username'].'<span class="postTime"><br>uploaded on: '.$p['posted_at'].'</span></p>
                    <a class="postLink" href="'.$p['url'].'">Download</a>
                </div>
            </div>';
        }
    }else{
        header('location:login');
    }
?>

<div class="posts">
    <h1>Recently Added</h1>
    <?php echo $dbposts; ?>
</div>

<?php include('inc/footer.php'); ?>
