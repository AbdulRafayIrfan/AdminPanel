<?php
session_start();
$view = new stdClass();
$view->pageTitle = 'logout';
//
session_destroy();
//
header("Location:login.php");
?>