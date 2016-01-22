<?php
/**
 * Created by PhpStorm.
 * User: rubenjimenez
 * Date: 22/01/16
 *
 */

    class googleAPI
    {
    // get url
        public static function getSpeed($url)
        {
            $url = $url;
            $app = 'https://www.googleapis.com/pagespeedonline/v2/runPagespeed?url=' . urlencode($url);

        // open file connection
            $stdout = fopen('php://output', 'w+');

        // initiate cURL session
            $ch = curl_init($app);

        // optional settings for debugging
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //option to return string
            curl_setopt($ch, CURLOPT_VERBOSE, false);
            curl_setopt($ch, CURLOPT_STDERR, $stdout); // logs curl messages

        // required POST request settings
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

            $data = curl_exec($ch); // Execute the curl request
            $data = json_decode($data, TRUE);

        // check for errors and process results
            $info = curl_getinfo($ch);

            echo '<pre>';
            print_r($data);
        }

    }