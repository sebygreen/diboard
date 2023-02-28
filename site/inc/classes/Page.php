<?php
if (!defined("__CONFIG__")) {
    exit("You do not have a config file");
}

class Page
{
    static function redirectToLogin()
    {
        // force to login when trying to access unauthorized page
        if (!isset($_SESSION["user"])) {
            header("Location: /login.php");
            exit();
        }
    }

    static function redirectToDashboard()
    {
        // force to dashboard when trying to access login or register page when already connected
        if (isset($_SESSION["user"])) {
            header("Location: /dashboard.php");
            exit();
        }
    }
}
