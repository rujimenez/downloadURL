<?php
/**
 * Created by PhpStorm.
 * User: rubenjimenez
 * Date: 21/01/16
 * Time: 16:08
 */
class info{

    protected $getSize;
    protected $getCountImg;
    protected $url;


    public function __construct(){


    }

    public function getAll(){
        $this->url=$_GET['url'];
        $ch = curl_init($this->url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_NOBODY, TRUE);

        $data = curl_exec($ch);
        $size = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);

        curl_close($ch);
        return 'Size : '.$size . '<br>DataHeaders : ' . $data;



    }

}

$download=new info();

echo $download->getAll();


