
<?php
    require_once "core/bootstrap.php";
?>

<!DOCTYPE html>
<html>
<title><?php echo $title?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3.css">
<!--<link rel="stylesheet" href="/css/w3-theme-teal.css">-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--<link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">-->

<style>
    .w3-sidenav a {padding:16px}
</style>
<body>

<nav class="w3-sidenav w3-collapse w3-white w3-animate-left w3-large" style="z-index:3;width:300px;" id="mySidenav">

    <div class="w3-bar w3-center">
        <a href="index.php" class="w3-bar-item w3-button" style="width:33.33%">Домой</a>
    </div>

    <div id="nav01">
        <?php menu($menu);?>
    </div>

</nav>

<div class="w3-main" style="margin-left:300px;">

    <header style="background-color: #d4c24f" class="w3-container w3-theme  w3-center">
        <h2 class="w3-large w3-padding-16">Программа контроля за исполнением решений Минэнерго о распоряжении имуществом</h2>
        <hr>
    </header>

    <div class="w3-container">
        <?php include "view/{$include}.view.php";?>
    </div>
</div>

<footer  class="w3-container w3-padding-large w3-light-grey w3-justify w3-opacity">

</footer>
</body>
</html>
