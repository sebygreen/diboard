<?php

const __CONFIG__ = true;
require_once "../inc/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $return = [];

    if (!empty($_POST["email"]) || !empty($_POST["password"])) {
        $email = Filter::String($_POST["email"]);
        $password = $_POST["password"];

        $user_found = User::findEmail($email, true);

        if ($user_found) {
            // user exists, try and sign them in
            $user_id = (int) $user_found["id"];
            $hash = (string) $user_found["password"];

            if (password_verify($password, $hash)) {
                // user is signed in. set session and redirect
                $return["redirect"] = "/dashboard";
                $_SESSION["user_id"] = $user_id;
            } else {
                $return["error"] = "Your email and/or password is incorrect"; // invalid user email/password combo
            }
        } else {
            // they need to create a new account
            $return["error"] =
                "You do not have an account. <a href='/register.php'>Create one now?</a>";
        }
    } else {
        $return["error"] = "Please make sure all of the fields are filled in";
    }

    echo json_encode($return, JSON_PRETTY_PRINT);
    exit();
} else {
    exit("Invalid URL");
}
