<?php
    require_once "core/bootstrap.php";




        $user = $_POST['username'];
        $pwd = $_POST['password'];

        if (validate($user, $pwd)) {

            $_SESSION['login'] = $_POST['username'];
            $_SESSION['pwd'] = $_POST['password'];

            header('Location: index.php');
            exit();
        }else{
            /*$err='wrong pwd';
            header('Location: login.php');*/

    }

?>
<form method="POST" action="login.php">
    Username: <input type="text" name="username"> <br>
    Password: <input type="password" name="password"> <br>
    <input type="submit" value="Log In">
</form>
<?php
    dump($_POST);
    dump($_SESSION);