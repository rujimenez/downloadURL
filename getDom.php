<?php
/**
 * Created by PhpStorm.
 * User: rubenjimenez
 * Date: 22/01/16
 *
 */
namespace getDom;
use \DOMDocument;

class getDomInfo{

    protected static  $url;
    protected static  $size=0;

    public static function getDomData($url){

        self::$url = $url ;


        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $html = curl_exec($ch);
        self::$size  = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
        curl_close($ch);

        # Create a DOM parser object
        $dom = new DOMDocument();

        // Parse the HTML from URL

        @$dom->loadHTML($html);

        return $dom ;


    }

    public static function getSize(){

        return self::$size;

    }


}