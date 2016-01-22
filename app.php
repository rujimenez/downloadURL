<?php
/**
 * Created by PhpStorm.
 * User: rubenjimenez
 * Date: 22/01/16
 *
 */

require 'getInfo.php';
require 'getDom.php';


class APP
{


    public static function init()
    {
        if ($_GET['type'] == 1) {
            // Curl extension to do a Google query and get back  results
            set_time_limit(400);
            ini_set('memory_limit', '1024M');
            $file = $_GET['url'];
            $file_headers = @get_headers($file);

            echo '<h1>File HEADERS</h1>';
            print_r($file_headers);

            echo '</br>============================================================================</br>';

            if (($file_headers[0] == 'HTTP/1.1 404 Not Found') or ($file_headers[0] == '')) {

                echo 'This url does not exists or not data accesible from outside';
            } else {

                $dom = getDom\getDomInfo::getDomData($_GET['url']);
                $size = getDom\getDomInfo::getSize();
                $info = new getInfo\getFiles($dom);
                if($size>=1) {
                    echo '<h2>Size of document: ' . $size . "</h2>";
                }
                $urlBase = $info->parseURLBase($_GET['url']);
                $info->getElements('link', 'href', 'CSS/ICO', $urlBase);
                $info->getElements('script', 'src', 'JS', $urlBase);
                $info->getElements('iframe', 'src', 'iframe', $urlBase);
                $info->getElements('img', 'src', 'img', $urlBase);

            }


        } else {

            require 'googleAPI.php';
            googleAPI::getSpeed($_GET['url']);

        }
    }
}