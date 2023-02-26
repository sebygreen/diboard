<?php

if(!defined('__CONFIG__')) {
    exit('You do not have a config file');
}

class Validator {
    public static function Email( $email ) { // email validation
        return filter_var($email , FILTER_VALIDATE_EMAIL);
    }
}