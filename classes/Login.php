<?php
    class Login{
        public static function isLoggedIn(){
            if(isset($_COOKIE['CLID'])){
                if(DB::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['CLID'])))){
                    $user_id = DB::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['CLID'])))[0]['user_id'];
                    
                    if(isset($_COOKIE['CLID_'])){
                        return $user_id;
                    }else{
                        $cstrong = True;
                        $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
                        DB::query('INSERT INTO login_tokens VALUES(\'\',:token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$user_id));
                        DB::query('DELETE FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['CLID'])));
    
                        setcookie("CLID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
                        setcookie("CLID_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);
    
                        return $user_id;
                        
                    }
                }
    
                return false;
    
            }
        }
    }
?>