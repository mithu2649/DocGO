<?php
    include('classes/DB.php');
    include('inc/header.php');
    if(isset($_POST['create_account'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        if(!DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$username))){
            if(strlen($username)>=3 && strlen($username)<32){
                if(preg_match('/[a-zA-Z0-9_]+/', $username)){
                    if(strlen($password)>=6 && strlen($password)<=60){
                        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                            if(!DB::query('SELECT email FROM users WHERE email=:email', array(':email'=>$email))){

                                DB::query('INSERT INTO users VALUES(\'\',:username, :password, :email)', array(':username'=>$username, ':password'=>password_hash($password, PASSWORD_BCRYPT), ':email'=>$email));
                                echo "account_created";
                            }else{
                                echo 'email_already_used';
                            }
                        } else{
                            echo 'invalid_email';
                        }
                    }else{
                        echo 'invalid_password_length';
                    }
                }else{
                    echo 'invalid_chars_username';
                }
            }else{
                echo 'invalid_username';
            }
        }else{
            echo 'user_already_exists';
        }
    }

    include('static/registrationForm.html');
    include('inc/footer.php');
?>

