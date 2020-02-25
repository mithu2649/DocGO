<?php 
    include('classes/DB.php');
    include('classes/Login.php');
    include('inc/header.php');
    $dbposts = ""; $posts = [];
    $showTimeline = False;
    if(Login::isLoggedIn()){
        $user_id = Login::isLoggedIn();
        $username = DB::query('SELECT username from users WHERE id=:user_id', array(':user_id'=>$user_id))[0]['username'];
        if(isset($_POST['q'])){
            
           $keywords = explode(' ', $_POST['q']);

           $query = 'SELECT username, url, title, description, posted_at 
                FROM documents, users 
                WHERE title LIKE "%'.$keywords[0].'%"
                ';

                for($i = 1; $i < count($keywords); $i++) {
                    if(!empty($keywords[$i])) {
                        $query .= " OR title like '%" . $keywords[$i] . "%'";
                        $query .= " OR description like '%" . $keywords[$i] . "%'";
                    }
                }

            $posts = DB::query($query);
            if(empty(array_filter($posts))){
                die('no_documents_found');
            }
                
                foreach($posts as $p){
                    if(pathinfo($p['url'], PATHINFO_EXTENSION) == "pdf"){
                        $img = "resources/img/pdf.png";
                    }else if(pathinfo($p['url'], PATHINFO_EXTENSION) == "epub"){
                        $img = "resources/img/epub.png";
                    }else if(pathinfo($p['url'], PATHINFO_EXTENSION) == "docx"){
                        $img = "resources/img/docs.png";
                    }

                    $dbposts .= '
                    <div class="post">
                        <div class="postImg filetype">
                            <img src="'.$img.'"/>
                        </div>
                        <div class="postContent">
                            <h2 class="postTitle">'.$p['title'].'</h2><br>
                            <p class="postDesc">'.$p['description'].'</p><br>
                            <p class="postAuthor">'.$p['username'].'<span class="postTime">'.$p['posted_at'].'</span></p>
                            <a class="postLink" href="'.$p['url'].'">Download</a>
                        </div>
                    </div>';
                }
            
        }
    }else{
        header('location:login');
    }
?>

<div class="posts">
    <h1><?php if(count($posts) == 0){echo 'You came in here the wrong way!<br>Tell me what to search for?<br><br>Click on the search button';}else{echo count($posts).' result(s) found';}?></h1>
    <?php echo $dbposts;?>
</div>

<?php include('inc/footer.php');?>