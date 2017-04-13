<?php

session_start();



require_once "auth.php";

$_SESSION['admin'] = true;


$url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';

header('Location: ' . $url);