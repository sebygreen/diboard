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
            // if the files super global is empty, don't process it. let the default value of null be set
            $thumbnail = $_FILES["thumbnail"]["name"]; // main file
            $temporary_thumbnail = $_FILES["thumbnail"]["tmp_name"]; // temporary location where the file is being kept
            $image_extension = strtolower(
                pathinfo($thumbnail, PATHINFO_EXTENSION)
            );
            $final_thumbnail = rand(1000, 1000000) . $thumbnail; // generate a number and append it to the image name so that the same file can be used multiple times

            if (in_array($image_extension, $valid_extension)) {
                // extension validation
                if ($_FILES["thumbnail"]["size"] < 1000000) {
                    $upload_path = $upload_path . strtolower($final_thumbnail); // final upload path

                    if (
                        move_uploaded_file($temporary_thumbnail, $upload_path)
                    ) {
                        // when upload is complete, do the rest
                        $title = Filter::String($_POST["title"]);

                        $content = $_POST["content"];
                        $content = Filter::String($content, true);

                        $addPost = $sql_connection->prepare(
                            "INSERT INTO posts(thumbnail, title, content, user_id) VALUES(:thumbnail, :title, :content, :user_id)"
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
                        $addPost->bindParam(
                            ":user_id",
                            $User->user_id,
                            PDO::PARAM_STR
                        );
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
            $title = Filter::String($_POST["title"]);
            $content = Filter::String($_POST["content"], true);

            $addPost = $sql_connection->prepare(
                "INSERT INTO posts(title, content, user_id) VALUES(:title, :content, :user_id)"
            );
            $addPost->bindParam(":title", $title, PDO::PARAM_STR);
            $addPost->bindParam(":content", $content, PDO::PARAM_STR);
            $addPost->bindParam(":user_id", $User->user_id, PDO::PARAM_STR);
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
