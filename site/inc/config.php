<?php
if (!defined("__CONFIG__")) {
    exit("You do not have a config file");
}
// session start if none already
if (!isset($_SESSION)) {
    session_start();
}

// errors
// TODO: remove in production
ini_set("display_errors", 1);
error_reporting(E_ALL);

// classes
include_once "classes/Database.php";
include_once "classes/Filter.php";
include_once "classes/Page.php";
include_once "classes/User.php";
include_once "classes/Post.php";
include_once "classes/Validator.php";

// database
$sql_connection = Database::getConnection();
