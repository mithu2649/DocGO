<?php 
    include('classes/DB.php');
    include('classes/Login.php');

    $dbposts = "";
    $showTimeline = False;
    if(Login::isLoggedIn()){
        $user_id = Login::isLoggedIn();
        $username = DB::query('SELECT username from users WHERE id=:user_id', array(':user_id'=>$user_id))[0]['username'];

        echo 'logged in as => '.$username.'<br><br>';

        if(isset($_POST['q'])){
            
           $keywords = explode(' ', $_POST['q']);

           $query = 'SELECT username, url, title, description, posted_at 
                FROM documents, users 
                WHERE title LIKE "%'.$keywords[0].'%"
                OR username LIKE "%'.$keywords[0].'%"
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
                        <img src="'.$img.'" width="120px"/>
                        <h2>'.$p['title'].'</h2>
                        <p>'.$p['description'].'<p>
                        <p>'.$p['username'].': '.$p['posted_at'].'<p>
                        <a href="'.$p['url'].'">Download</a>
                    </div>';
                }
            
        }
    }else{
        header('location:login.php');
    }
?>

<div class="posts">
    <?php echo $dbposts; ?>
</div>

<style>
    .post{
        background-color:#f2f2f2;
        padding:10px;
        margin:5px;
    }
</style>