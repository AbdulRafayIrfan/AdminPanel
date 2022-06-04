<?php
session_start();
$view = new stdClass();
$view->pageTitle = 'login';
require_once('Models/accountDataSet.php');
$username = "";
$password = "";

function login()
{
    $view = new stdClass();
    $view->pageTitle = 'login';
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $password = htmlentities(trim($_POST['password']));
        $username = htmlentities(trim($_POST['username']));
        $accountDataSet = new accountDataSet();
        // Hashing the password
        $hash = password_hash($password, PASSWORD_DEFAULT);
        //
        $account = $accountDataSet->login($username);
        if ($account != null) {
            $hashed_password = trim($account->getPassword());
            if (password_verify($password, $hashed_password)) {
                // Set sessions
                $_SESSION['id'] = $account->getID();
                $_SESSION['username'] = $account->getUsername();
                $_SESSION['password'] = $account->getPassword();

                echo "Logged in.";
                header("Location:record.php");
            } else {
                echo "Username or password is incorrect.";
            }
        } else {
            echo "Username or password is incorrect.";
        }
        return $view;
    }
}
$view = login();
require_once('Views/login.phtml');