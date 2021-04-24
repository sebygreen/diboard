<?php

const __CONFIG__ = true;
require_once "../inc/config.php";

$valid_extension = array('jpeg', 'jpg', 'png', 'gif', 'bmp'); // authorised formats
$upload_path = '../assets/avatars/'; // file content gets saved here (db's like mySql don't do very well with images)

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // check if post is sent to the right place
    $return = [];

    if (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])) { // check for empty text fields
        if (!empty($_FILES)) {
            $avatar = $_FILES['avatar']['name']; // main file
            $temporary_avatar = $_FILES['avatar']['tmp_name']; // temporary location where the file is being kept
            $avatar_extension = strtolower(pathinfo($avatar, PATHINFO_EXTENSION));
            $final_avatar = rand(1000, 1000000).$avatar; // can upload the same image

            if (in_array($avatar_extension, $valid_extension)) { // extension validation
                if ($_FILES['avatar']['size'] < 1000000) {
                    $upload_path = $upload_path.strtolower($final_avatar); // final upload path

                    if (move_uploaded_file($temporary_avatar, $upload_path)) { // when upload is complete, do the rest
                        if (Validator::Email($_POST['email'])) { // email validation
                            $email = $_POST['email'];
                            $email_found = User::findEmail($email);

                            if ($email_found) { // if user exists throw error
                                $return['error'] = "You already have an account";
                            } else { // user does not exist, add them now
                                $username = Filter::String($_POST['username']);
                                $username_found = User::findUsername($username);

                                if ($username_found) { // if username already taken, error
                                    $return['error'] = 'This username is already taken';
                                }
                                else { // log user in
                                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

                                    $addUser = $sql_connection -> prepare("INSERT INTO users(username, email, password, avatar) VALUES(:username, LOWER(:email), :password, :avatar)");
                                    $addUser -> bindParam(':username', $username, PDO::PARAM_STR);
                                    $addUser -> bindParam(':email', $email, PDO::PARAM_STR);
                                    $addUser -> bindParam(':password', $password, PDO::PARAM_STR);
                                    $addUser -> bindParam(':avatar', $upload_path, PDO::PARAM_STR);
                                    $addUser -> execute();

                                    $user_id = $sql_connection -> lastInsertId();

                                    $_SESSION['user_id'] = (int)$user_id;

                                    $return['redirect'] = '/dashboard';
                                    $return['is_logged_in'] = true;
                                }
                            }
                        }
                        else {
                            $return['error'] = 'Please enter a valid email address';
                        }
                    }
                    else {
                        $return['error'] = 'Image upload failed';
                    }
                }
                else {
                    $return['error'] = 'The selected file is too large';
                }
            }
            else {
                $return['error'] = 'The selected file format is not supported';
            }
        }
        else {
            $return['error'] = 'Please import an image to use as your avatar';
        }
    }
    else {
        $return['error'] = 'Please make sure all of the fields are filled in';
    }
    echo json_encode($return, JSON_PRETTY_PRINT);
    exit;
}
else {
	exit('Invalid URL');
}