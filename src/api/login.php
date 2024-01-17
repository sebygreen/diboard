<?php
const __CONFIG__ = true;
require_once "../inc/config.php";

function response($packet, $error): void
{
    $return = [];
    if ($error) {
        $return["error"] = $packet;
    } else {
        $return["redirect"] = $packet;
    }
    echo json_encode($return, JSON_PRETTY_PRINT);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    response("Invalid request method.", true);
}

if (empty($_POST["email"]) || empty($_POST["password"])) {
    response("Please make sure all of the fields are filled in.", true);
}

if (!Validator::Email($_POST["email"])) {
    response("Please enter a valid email address.", true);
}

$email = Filter::String($_POST["email"]);
$user = User::Email($email, true);
if (!$user) {
    response("You don't have an account.", true);
}

$password = $_POST["password"];
$uuid = (string)$user["uuid"];
$hash = (string)$user["password"];

if (!password_verify($password, $hash)) {
    response("Your credentials are incorrect.", true);
}

$_SESSION["user"] = $uuid;
response("/dashboard", false);