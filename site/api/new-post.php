<?php
const __CONFIG__ = true;
require_once "../inc/config.php";

// composer autoload
require_once "../vendor/autoload.php";
// ramsey/uuid
use Ramsey\Uuid\Uuid;

// get current user
$User = new User($_SESSION["user"]);
// allowed image files
$extensions = ["jpeg", "jpg", "png", "webp", "gif", "bmp"]; // authorised formats

// check for POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $return = []; // header('Content-Type: application/json');
    if (!empty($_POST["title"]) && !empty($_POST["content"])) {
        $uuid = Uuid::uuid4(); // uuid for post
        if (!empty($_FILES)) {
            // if the files super global is empty, don't process it. let the default value of null be set
            $thumbnail = $_FILES["thumbnail"]["name"]; // main file
            $extension = strtolower(pathinfo($thumbnail, PATHINFO_EXTENSION)); // get current file extension

            // check extension against valid extensions array
            if (in_array($extension, $extensions)) {
                // file size validation (4mb hard limit)
                if ($_FILES["thumbnail"]["size"] < 4000000) {
                    $temp = $_FILES["thumbnail"]["tmp_name"]; // temporary location where the file is being kept
                    $filename = Uuid::fromDateTime(date_create()) . "." . $extension; // uuid plus extension to create filename
                    $upload_path = "../storage/thumbnails/" . $filename; // final upload path
                    $database_path = "storage/thumbnails/" . $filename; // final database path

                    // copy file to storage on filesystem
                    if (move_uploaded_file($temp, $upload_path)) {
                        // when copy is complete, do the rest
                        $title = Filter::String($_POST["title"]);
                        $content = $_POST["content"];
                        $content = Filter::String($content, true);
                        $addPost = $sql_connection->prepare(
                            "INSERT INTO posts(uuid, thumbnail, title, content, author)
                            VALUES(UUID_TO_BIN(:uuid, 0), :thumbnail, :title, :content, UUID_TO_BIN(:author, 0))"
                        );
                        $addPost->bindParam(":uuid", $uuid, PDO::PARAM_STR);
                        $addPost->bindParam(":thumbnail", $database_path, PDO::PARAM_STR);
                        $addPost->bindParam(":title", $title, PDO::PARAM_STR);
                        $addPost->bindParam(":content", $content, PDO::PARAM_STR);
                        $addPost->bindParam(":author", $User->uuid, PDO::PARAM_STR);
                        $addPost->execute();

                        // redirect
                        $return["redirect"] = "/dashboard";
                    } else {
                        $return["error"] = "Image upload failed" . $_FILES["thumbnail"]["error"];
                    }
                } else {
                    $return["error"] = "The selected file is too large";
                }
            } else {
                $return["error"] = "The selected file format is not supported";
            }
        } else {
            // if no thumbnail, proceed without
            $title = Filter::String($_POST["title"]);
            $content = Filter::String($_POST["content"], true);
            $addPost = $sql_connection->prepare(
                "INSERT INTO posts(uuid, title, content, author)
                VALUES(UUID_TO_BIN(:uuid, 0), :title, :content, UUID_TO_BIN(:author, 0))"
            );
            $addPost->bindParam(":uuid", $uuid, PDO::PARAM_STR);
            $addPost->bindParam(":title", $title, PDO::PARAM_STR);
            $addPost->bindParam(":content", $content, PDO::PARAM_STR);
            $addPost->bindParam(":author", $User->uuid, PDO::PARAM_STR);
            $addPost->execute();

            // redirect
            $return["redirect"] = "/dashboard";
        }
    } else {
        $return["error"] = "Please make sure all of the fields are filled in";
    }
    // return json response
    echo json_encode($return, JSON_PRETTY_PRINT);
    exit();
} else {
    exit("Invalid URL");
}
