<?php
class Filter
{
    // string filter with html injection check
    public static function String($string, $html = false)
    {
        if (!$html) {
            $string = htmlspecialchars($string, ENT_QUOTES);
        } else {
            $string = filter_var($string, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }
        return $string;
    }

    // email filter
    public static function Email($email)
    {
        return filter_var($email, FILTER_SANITIZE_EMAIL);
    }

    // url filter
    public static function URL($url)
    {
        return filter_var($url, FILTER_SANITIZE_URL);
    }

    // number filter
    public static function Integer($integer): int
    {
        return (int)($integer = filter_var($integer, FILTER_SANITIZE_NUMBER_INT));
    }

    // convert url to hyperlink
    public static function Link($input)
    {
        $regex = "/(http|https|ftp|ftps):\/\/[a-zA-Z0-9\-.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
        if (preg_match($regex, $input, $url)) {
            // make the urls hyperlinks
            return preg_replace($regex, "<a href='{$url[0]}'>{$url[0]}</a> ", $input);
        } else {
            // if no urls, return the text
            return $input;
        }
    }

    // convert br to new line
    public static function br2nl($input)
    {
        if (preg_match("/<br(\s+)?\/?>/i", $input, $url)) {
            return preg_replace("/<br(\s+)?\/?>/i", "\n", $input);
        } else {
            return $input;
        }
    }
}
