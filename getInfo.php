<?php
/**
 * Created by PhpStorm.
 * User: rubenjimenez
 * Date: 22/01/16
 *
 */
namespace getInfo;


class getFiles{

    protected $tag;
    protected $src ;
    protected $type ;
    protected $dom;
    protected $url;


    public function __construct($dom){
        $this->dom = $dom ;

    }


    public function getElements($tag,$src,$type,$urlBase){

        $this->tag = $tag ;
        $this->src = $src ;
        $this->type = $type ;
        $arraySRC=array();
        $totalSize=0;
        $totaltimeRequest=0;


        foreach($this->dom->getElementsByTagName($tag) as $link) {
            // Show element $tag with the attributte $src
            $space=substr($link->getAttribute($src),1,1);
            if ($space<>'/') {$space='/';}else{$space=='';}
            //array_push($arraySRC,'type"=>'.$this->type . ',url=>'. $urlBase. $space .$link->getAttribute($src) );
            array_push($arraySRC, $urlBase. $space .$link->getAttribute($src) );

        }
        //var_dump($arraySRC);
        foreach ($arraySRC as $key => $url ) {
            $size=$this->getSize($url);
            $timeRequest=$this->getTimeRequest($url);
            echo 'URL:'.$url .' ,Size:'. $size .' ,TimeRequest: '. $timeRequest . '</br>';
            $totalSize.=$totalSize +$size;
            $totaltimeRequest=$totaltimeRequest + $timeRequest;

       }
        if($totalSize<>0) {
            echo '<h1>============================================================================</h1>';
            echo '<h1> SIZE of the all '.$this->type.':' . $totalSize . '</h1>';
            echo '<h1>TotalTimeRequest of all '.$this->type.':' . $totaltimeRequest . '</h1>';
            echo '<h1>============================================================================</h1>';
        }

    }

    public function getSize($url){


        $img = get_headers('http://'.$url, 1);
        if (array_key_exists('Content-Length',$img)) {
            $size = $img["Content-Length"];
        }else{$size='hiden element Content-Length;';}
        return $size ;

    }

    public function getTimeRequest($file){

        $t = microtime( TRUE );
        $fileContent=file_get_contents( 'http://'.$file);

        $t = microtime( TRUE ) - $t;

        return $t ;

    }

    public function parseURLBase($url){

        $urlBase=parse_url($url);
        $urlBase=$urlBase['host'];

        return $urlBase;

    }


}
