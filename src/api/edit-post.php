<?php
require_once "../inc/config.php";
// composer autoload
require_once "../vendor/autoload.php";
// ramsey/uuid
use Ramsey\Uuid\Uuid;

// get current user
$user = User::Single($_SESSION["user"]);
// allowed image files
$extensions = ["jpeg", "jpg", "png", "webp", "gif", "bmp"];

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

if (empty($_POST["title"]) || empty($_POST["content"])) {
    response("Please make sure all of the fields are filled in.", true);
}

if ($_FILES["thumbnail"]["size"] === 0) {
    $database_path = $_SESSION["post"]["thumbnail"];
} else {
    $thumbnail = $_FILES["thumbnail"]["name"];
    $extension = strtolower(pathinfo($thumbnail, PATHINFO_EXTENSION));

    if (!in_array($extension, $extensions)) {
        response("The selected file format is not supported.", true);
    }

    $temp = $_FILES["thumbnail"]["tmp_name"]; // temporary location where the file is being kept
    $filename = Uuid::fromDateTime(date_create()) . "." . $extension; // uuid plus extension to create filename
    $upload_path = "../storage/thumbnails/" . $filename; // final upload path
    $database_path = "storage/thumbnails/" . $filename; // final database path

    if ($_SESSION["post"]["thumbnail"]) {
        if (!unlink("../".$_SESSION["post"]["thumbnail"])) {
            response("Failed to delete previous image.", true);
        }
    }

    if (!move_uploaded_file($temp, $upload_path)) {
        response("Image failed to upload.", true);
    }
}

$uuid = $_SESSION["post"]["uuid"];
$title = Filter::String($_POST["title"]);
$content = Filter::String($_POST["content"], true);
$edited = 1;
Post::Update($uuid, $database_path, $title, $content, $edited);
unset($_SESSION["post"]);
response("/dashboard", false);
