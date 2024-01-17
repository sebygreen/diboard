<?php
class Page
{
    static function redirectToLogin(): void
    {
        // force to login when trying to access unauthorized page
        if (!isset($_SESSION["user"])) {
            header("Location: /login");
            exit();
        }
    }

    static function redirectToDashboard(): void
    {
        // force to dashboard when trying to access login or register page when already connected
        if (isset($_SESSION["user"])) {
            header("Location: /dashboard");
            exit();
        }
    }
}
