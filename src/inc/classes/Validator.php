<?php
class Validator {
    public static function Email( $email ) { // email validation
        return filter_var($email , FILTER_VALIDATE_EMAIL);
    }
}