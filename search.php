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

           $query = 'SELECT DISTINCT 
           documents.id, documents.title, 
           documents.description, documents.posted_at, 
           documents.url, users.username 
           FROM users, documents
           WHERE documents.title LIKE "%'.$keywords[0].'%" ';

                for($i = 1; $i < count($keywords); $i++) {
                    if(!empty($keywords[$i])) {
                        $query .= " OR documents.title like '%" . $keywords[$i] . "%'";
                        $query .= " OR documents.description like '%" . $keywords[$i] . "%'";
                        $query .= " OR users.username like '%" . $keywords[$i] . "%'";

                       //there's a bug in here. the username that is returned from the database is not correct.
                       //Having a hard time figuring it out.
                       //Somebody please fix this.
                       //HINT: removing all the OR statements from the query fixes the issue
                       //but the search is less efficient that way.
                    }
                }

            $finalQuery = $query. ' AND users.id = documents.uploaded_by GROUP BY documents.title';
            $posts = DB::query($finalQuery);
            if(empty(array_filter($posts))){
                die('no_documents_found');
            }

                foreach($posts as $p){
                    if(pathinfo($p['url'], PATHINFO_EXTENSION) == "pdf"){
                        $img = "resources/img/pdf.png";
                    }else if(pathinfo($p['url'], PATHINFO_EXTENSION) == "epub"){
                        $img = "resources/img/epub.png";
                    }else if(pathinfo($p['url'], PATHINFO_EXTENSION) == "docx"){
                        $img = "resources/img/docx.png";
                    }else if(pathinfo($p['url'], PATHINFO_EXTENSION) == "text"){
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
                            <p class="postDesc">'.substr($p['description'], 0, 250).'</p><br>
                            <p class="postAuthor">'.$p['username'].': <span class="postTime">'.$p['posted_at'].'</span></p>
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