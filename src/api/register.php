<?php
const __CONFIG__ = true;
require_once "../inc/config.php";
require_once "../vendor/autoload.php";
use Ramsey\Uuid\Uuid;

$extensions = ["jpeg", "jpg", "png", "webp", "gif", "bmp"]; // authorised formats

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

if (empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["password"])) {
    response("Please make sure all of the fields are filled in.", true);
}

if ($_FILES["avatar"]["size"] === 0) {
    response("Please import an image to use as your avatar.", true);
}

if ($_FILES["avatar"]["size"] > 4000000) {
    response("The selected file is too large.", true);
}

$avatar = $_FILES["avatar"]["name"]; // main file
$extension = strtolower(pathinfo($avatar, PATHINFO_EXTENSION));

if (!in_array($extension, $extensions)) {
    response("The selected file format is not supported.", true);
}

// form validation
if (!Validator::Email($_POST["email"])) {
    response("Please enter a valid email address.", true);
}

$email = Filter::String($_POST["email"]);
if (User::Email($email) !== 0) {
    response("You already have an account.", true);
}

$username = Filter::String($_POST["username"]);
if (User::Username($username) !== 0) {
    response("This username is already taken.", true);
}

$temp = $_FILES["avatar"]["tmp_name"]; // temporary location where the file is being kept
$filename = Uuid::fromDateTime(date_create()) . "." . $extension; // uuid plus extension to create filename
$upload_path = "../storage/avatars/" . $filename; // final upload path
$database_path = "storage/avatars/" . $filename; // final database path

if (!move_uploaded_file($temp, $upload_path)) {
    response("Image failed to upload.", true);
}

$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
$uuid = Uuid::uuid4()->toString();

$sql = "
    INSERT
    INTO users(uuid, username, email, password, avatar)
    VALUES(:uuid, :username, LOWER(:email), :password, :avatar)
";

$db = Database::getInstance();
$addUser = $db->handle->prepare($sql);
$addUser->bindParam(":uuid", $uuid, PDO::PARAM_STR);
$addUser->bindParam(":username", $username, PDO::PARAM_STR);
$addUser->bindParam(":email", $email, PDO::PARAM_STR);
$addUser->bindParam(":password", $password, PDO::PARAM_STR);
$addUser->bindParam(":avatar", $database_path, PDO::PARAM_STR);
$addUser->execute();

$_SESSION["user"] = $uuid;
response("/dashboard", false);