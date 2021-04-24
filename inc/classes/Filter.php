<?php

if(!defined('__CONFIG__')) {
	exit('You do not have a config file');
}

class Filter {
	public static function String($string, $html = false) { // validation for strings
		if(!$html) {
			$string = filter_var($string , FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
		} else {
			$string = filter_var($string , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		}
		return $string;
	}

	public static function Email($email) { // email validation
		return filter_var($email , FILTER_SANITIZE_EMAIL);
	}

	public static function URL($url) { // url validation
		return filter_var($url , FILTER_SANITIZE_URL);
	}

	public static function Integer($integer): int {  // integer validation
		return (int)$integer = filter_var($integer , FILTER_SANITIZE_NUMBER_INT);
	}

	public static function Link($input) {
        $regex = "/(http|https|ftp|ftps):\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
        if(preg_match($regex, $input, $url)) {
            // make the urls hyper links
            return preg_replace($regex, "<a href='{$url[0]}'>{$url[0]}</a> ", $input);
        } else {
            // if no urls, return the text
            return $input;
        }
    }
    public static function br2nl($input) { // i wonder what this could be
        if(preg_match('/<br(\s+)?\/?>/i', $input, $url)) {
            return preg_replace('/<br(\s+)?\/?>/i', "\n", $input);
        } else {
            return $input;
        }
    }
}