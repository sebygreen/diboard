<?php 

if(!defined('__CONFIG__')) {
	exit('You do not have a config file');
}

if(!isset($_SESSION)) { // session start
	session_start();
}

error_reporting(-1); // allow errors
ini_set('display_errors', 'On');

// classes
include_once "classes/DB.php";
include_once "classes/Filter.php";
include_once "classes/Page.php";
include_once "classes/User.php";
include_once "classes/Post.php";
include_once "classes/Validator.php";

$sql_connection = DB::getConnection();
