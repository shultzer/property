<?php
    require_once "core/bootstrap.php";

    function validate($user, $pass) {

        $users=[
            'admin' => 'admin',
            'guest' => 'guest'
        ];
        if (isset($users[$user]) && ($users[$user] === $pass)) {
            return true;
        } else {
            return false;
        }
    }

    if (validate($_POST['username'],$_POST['password'])) {
        $_SESSION['login'] = $_POST['username'].','.md5($_POST['username'].$_POST['password']);
    }

    unset($username);
    if (isset($_SESSION['login'])) {
        list($c_username,$cookie_hash) = explode(',',$_SESSION['login']);
        if (md5($c_username.$_POST['password']) == $cookie_hash) {
            $username = $c_username;
            header('Location: home.php');
            exit;
        } else {
           echo "You have tampered with your session.";
        }
    }
?>

<pre>
    <?=print_r($_SESSION)?>
</pre>
