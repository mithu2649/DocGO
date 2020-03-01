<?php
include('./classes/DB.php');
include('./classes/Login.php');
if (!Login::isLoggedIn()) {
    header('location: index');
}
if (isset($_COOKIE['CLID'])) {
    DB::query('DELETE FROM login_tokens WHERE token=:token', array(':token' => sha1($_COOKIE['CLID'])));
}
setcookie('CLID', '1', time() - 3600);
setcookie('CLID_', '1', time() - 3600);

echo 'Logged_out';
header('location: index');
?>