<?php
    include('classes/DB.php');
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$username))){
          if(password_verify($password, DB::query('SELECT password FROM users WHERE username=:username', array(':username'=>$username))[0]['password'])){
              echo 'logged_in';
              
                $cstrong = True;
                $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
                echo $token;
                
                $user_id = DB::query('SELECT id from users WHERE username =:username', array(':username'=>$username))[0]['id'];
                DB::query('INSERT INTO login_tokens VALUES(\'\',:token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$user_id));
                
                setcookie("CLID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
                setcookie("CLID_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);

          }else{
              echo 'incorrect_password : please try again';
          }
        }else{
            echo 'user_not_found';
        }
    }
?>
<style>
    input{display:block;padding:10px}
</style>
<form action="login.php" method="post">
<input type="text" name="username" id="username" placeholder="Username">
    <input type="password" name="password" id="password" placeholder="Password">
    <input type="submit" name="login" value="Login">
</form>