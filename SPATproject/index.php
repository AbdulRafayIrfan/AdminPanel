<?php
session_start();
$view = new stdClass();
$view->pageName = 'index';

if (isset($_SESSION['username'])) {
    header("Location:record.php");
}
else {
    header("Location:login.php");
}
