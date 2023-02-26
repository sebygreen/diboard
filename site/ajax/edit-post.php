<?php

const __CONFIG__ = true;
require_once "../inc/config.php";

$User = new User($_SESSION["user_id"]);

$valid_extension = ["jpeg", "jpg", "png", "gif", "bmp"]; // authorised formats
$upload_path = "../storage/thumbnails/"; // file content gets saved here

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $return = []; // header('Content-Type: application/json');

    if (!empty($_POST["title"]) && !empty($_POST["content"])) {
        if (!empty($_FILES)) {
            // if the files super global is empty, don't process it. let the default value of null take over
            $thumbnail = $_FILES["thumbnail"]["name"]; // main file
            $temporary_thumbnail = $_FILES["thumbnail"]["tmp_name"]; // temporary location where the file is being kept
            $image_extension = strtolower(
                pathinfo($thumbnail, PATHINFO_EXTENSION)
            );
            $final_thumbnail = rand(1000, 1000000) . $thumbnail; // generate a number and append it to the image name so that the same file can be used multiple times (extremely small chance of duplicates)

            if (in_array($image_extension, $valid_extension)) {
                // extension validation
                if ($_FILES["thumbnail"]["size"] < 1000000) {
                    $upload_path = $upload_path . strtolower($final_thumbnail); // final upload path

                    if (
                        move_uploaded_file($temporary_thumbnail, $upload_path)
                    ) {
                        // when upload is complete, do the rest
                        $post_id = Filter::Integer($_POST["post_id"]);
                        $title = Filter::String($_POST["title"]);
                        $content = Filter::String($_POST["content"], true);
                        $edited = 1;

                        $addPost = $sql_connection->prepare(
                            "UPDATE posts SET thumbnail = :thumbnail, title = :title, content = :content, edited = :edited WHERE id = :id"
                        );
                        $addPost->bindParam(
                            ":thumbnail",
                            $upload_path,
                            PDO::PARAM_STR
                        );
                        $addPost->bindParam(":title", $title, PDO::PARAM_STR);
                        $addPost->bindParam(
                            ":content",
                            $content,
                            PDO::PARAM_STR
                        );
                        $addPost->bindParam(":edited", $edited, PDO::PARAM_STR);
                        $addPost->bindParam(":id", $post_id, PDO::PARAM_INT);
                        $addPost->execute();

                        $return["redirect"] = "/dashboard";
                    } else {
                        $return["error"] = "Image upload failed";
                    }
                } else {
                    $return["error"] = "The selected file is too large";
                }
            } else {
                $return["error"] = "The selected file format is not supported";
            }
        } else {
            $post_id = Filter::Integer($_POST["post_id"]);
            $title = Filter::String($_POST["title"]);
            $content = Filter::String($_POST["content"], true);
            $edited = 1;

            $addPost = $sql_connection->prepare(
                "UPDATE posts SET title = :title, content = :content, edited = :edited WHERE id = :id"
            );
            $addPost->bindParam(":title", $title, PDO::PARAM_STR);
            $addPost->bindParam(":content", $content, PDO::PARAM_STR);
            $addPost->bindParam(":edited", $edited, PDO::PARAM_STR);
            $addPost->bindParam(":id", $post_id, PDO::PARAM_INT);
            $addPost->execute();

            $return["redirect"] = "/dashboard";
        }
    } else {
        $return["error"] = "Please make sure all of the fields are filled in";
    }

    echo json_encode($return, JSON_PRETTY_PRINT);
    exit();
} else {
    exit("Invalid URL");
}
