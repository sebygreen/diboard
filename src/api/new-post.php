<?php
require_once "../inc/config.php";
// composer autoload
require_once "../vendor/autoload.php";
// ramsey/uuid
use Ramsey\Uuid\Uuid;

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
    $database_path = null;
} else {
    if ($_FILES["thumbnail"]["size"] > 4000000) {
        response("The selected file is too large.", true);
    }

    $thumbnail = $_FILES["thumbnail"]["name"];
    $extension = strtolower(pathinfo($thumbnail, PATHINFO_EXTENSION));

    if (!in_array($extension, $extensions)) {
        response("The selected file format is not supported.", true);
    }

    $temp = $_FILES["thumbnail"]["tmp_name"]; // temporary location where the file is being kept
    $filename = Uuid::fromDateTime(date_create()) . "." . $extension; // uuid plus extension to create filename
    $upload_path = "../storage/thumbnails/" . $filename; // final upload path
    $database_path = "storage/thumbnails/" . $filename; // final database path

    if (!move_uploaded_file($temp, $upload_path)) {
        response("Image failed to upload.", true);
    }
}

$uuid = Uuid::uuid4();
$title = Filter::String($_POST["title"]);
$content = $_POST["content"];
$content = Filter::String($content, true);
Post::Create($uuid, $database_path, $title, $content, $_SESSION["user"]);
response("/dashboard", false);
