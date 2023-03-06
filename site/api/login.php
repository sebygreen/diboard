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
            $uuid = (string) $user_found["uuid"];
            $hash = (string) $user_found["password"];

            if (password_verify($password, $hash)) {
                // user is signed in. set session
                $_SESSION["user"] = $uuid;
                // redirect
                $return["redirect"] = "/dashboard";
            } else {
                $return["error"] = "Your email and/or password is incorrect";
            }
        } else {
            $return["error"] = "You do not have an account. <a href='/register.php'>Create one now?</a>";
        }
    } else {
        $return["error"] = "Please make sure all of the fields are filled in";
    }
    // response
    echo json_encode($return, JSON_PRETTY_PRINT);
    exit();
} else {
    exit("Invalid URL");
}
