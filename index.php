<?php
    require_once "core/bootstrap.php";

    if (validate($_POST['username'],$_POST['password'])) {
        $_SESSION['login'] =
            $_POST['username'].','.md5($_POST['username'].$secret_word);
    }
    unset($username);
    if (isset($_SESSION['login'])) {
        list($c_username,$cookie_hash) = explode(',',$_SESSION['login']);
        if (md5($c_username.$secret_word) == $cookie_hash) {
            $username = $c_username;
        } else {
            print "You have tampered with your session.";
        }
    }

    ?>

<form method="POST" action="login.php">
    Username: <input type="text" name="username"> <br>
    Password: <input type="password" name="password"> <br>
    <input type="submit" value="Log In">
</form>

