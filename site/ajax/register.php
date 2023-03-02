<?php
const __CONFIG__ = true;
require_once "../inc/config.php";
// composer autoload
require_once "../vendor/autoload.php";
// ramsey/uuid
use Ramsey\Uuid\Uuid;

// allowed image files
$extensions = ["jpeg", "jpg", "png", "webp", "gif", "bmp"]; // authorised formats

// check for POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // check if post is sent to the right place
    $return = [];

    // check for empty text fields
    if (!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
        // check if file is selected
        if (!empty($_FILES)) {
            $avatar = $_FILES["avatar"]["name"]; // main file
            $extension = strtolower(pathinfo($avatar, PATHINFO_EXTENSION));

            // check extension against valid extensions array
            if (in_array($extension, $extensions)) {
                // file size validation (4mb hard limit)
                if ($_FILES["avatar"]["size"] < 4000000) {
                    $temp = $_FILES["avatar"]["tmp_name"]; // temporary location where the file is being kept
                    $filename = Uuid::fromDateTime(date_create()) . "." . $extension; // uuid plus extension to create filename
                    $upload_path = "../storage/avatars/" . $filename; // final upload path
                    $database_path = "storage/avatars/" . $filename; // final database path

                    // form validation
                    if (Validator::Email($_POST["email"])) {
                        $email = $_POST["email"];
                        $email_found = User::findEmail($email);

                        // check if email is already registered
                        if (!$email_found) {
                            // sanitize
                            $username = Filter::String($_POST["username"]);
                            $username_found = User::findUsername($username);

                            // check if username is already taken
                            if (!$username_found) {
                                // copy file to server storage
                                if (move_uploaded_file($temp, $upload_path)) {
                                    // log user in
                                    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
                                    $uuid = Uuid::uuid4();

                                    $addUser = $sql_connection->prepare(
                                        "INSERT INTO users(uuid, username, email, password, avatar) VALUES(UUID_TO_BIN(:uuid, 0), :username, LOWER(:email), :password, :avatar)"
                                    );
                                    $addUser->bindParam(":uuid", $uuid, PDO::PARAM_STR);
                                    $addUser->bindParam(":username", $username, PDO::PARAM_STR);
                                    $addUser->bindParam(":email", $email, PDO::PARAM_STR);
                                    $addUser->bindParam(":password", $password, PDO::PARAM_STR);
                                    $addUser->bindParam(":avatar", $database_path, PDO::PARAM_STR);
                                    $addUser->execute();

                                    $_SESSION["user"] = $uuid;
                                    $return["redirect"] = "/dashboard";
                                    $return["is_logged_in"] = true;
                                } else {
                                    $return["error"] = "Image failed to upload";
                                }
                            } else {
                                $return["error"] = "This username is already taken";
                            }
                        } else {
                            $return["error"] = "You already have an account";
                        }
                    } else {
                        $return["error"] = "Please enter a valid email address";
                    }
                } else {
                    $return["error"] = "The selected file is too large";
                }
            } else {
                $return["error"] = "The selected file format is not supported";
            }
        } else {
            $return["error"] = "Please import an image to use as your avatar";
        }
    } else {
        $return["error"] = "Please make sure all of the fields are filled in";
    }
    echo json_encode($return, JSON_PRETTY_PRINT);
    exit();
} else {
    exit("Invalid URL");
}
