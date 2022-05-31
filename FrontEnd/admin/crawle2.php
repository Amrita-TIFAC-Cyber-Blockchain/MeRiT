<?php

/* 
 * Authors      : Swapneel Khandagale
 * Updated Date : 01-JUN-2022
 */
 
//include('../couch_config.php');

require 'vendor/autoload.php';
$user_agent="ScrapBot/1.0";
$start = "crawlfed.html";

$already_crawled=array();
$crawling=array();

function get_details($url)
{
 $options=array('http'=>array('method'=>"GET", 'headers'=>"User-Agent: ScrapBot/1.0\n"));
 $context=stream_context_create($options);
 $doc = new DOMDocument();
 @$doc->loadHTML(@file_get_contents($url,false,$context));
 $title=$doc->getElementsByTagName("title");
 $title=$title->item(0)->nodeValue;
 $xpath = new DOMXPath($doc);
 $imag = $xpath->evaluate("string(//img/@src)");
 if(substr($imag,0,1)=="/" && substr($imag,0,2)!="//")
 	{
 		$imag=parse_url($url)["scheme"]."://".parse_url($url)["host"].$imag;
 	}
 	else if (substr($imag,0,2)=="//") 
 	{
 		$imag=parse_url($url)["scheme"].":".$imag;
 	}
 	else if(substr($imag,0,2)=="./")
 	{
        $imag=parse_url($url)["scheme"]."://".parse_url($url)["host"].dirname(parse_url($url)["path"]).substr($imag,1);
 	}
 	else if(substr($imag,0,1)=="#")
 	{
 		$imag=parse_url($url)["scheme"]."://".parse_url($url)["host"].parse_url($url)["path"].$imag;
 	}
 	else if(substr($imag,0,3)=="../")
 	{
 		$imag=parse_url($url)["scheme"]."://".parse_url($url)["host"]."/".$imag;
 	}
 	else if(substr($imag,0,5)!="https" && substr($imag,0,4)!="http")
 	{
 		$imag=parse_url($url)["scheme"]."://".parse_url($url)["host"]."/".$imag;
 	}
	
 $description="";
 $keywords="";
 $type="";
 $metas=$doc->getElementsByTagName("meta");
 
 for($i=0; $i<$metas->length; $i++)
 {
 	$meta=$metas->item($i);
 	if($meta->getAttribute("name")==strtolower("description"))
 	$description=$meta->getAttribute("content");
    if($meta->getAttribute("name")==strtolower("keywords"))
 	$keywords=$meta->getAttribute("content");

    if($meta->getAttribute("property")==strtolower("og:type"))
    {
    	if($meta->getAttribute("content")==strtolower("video"))
    		$type=$meta->getAttribute("content");
    	else if($meta->getAttribute("content")==strtolower("article"))
    		$type=$meta->getAttribute("content");
    }
 }
 
 if (strpos($url,'watch?v') !== false) {
    $type='video';
 }
 
 $couchurl = 'http://augustoandro:windows@192.168.43.143:5984/hyperledger/';
 $couch_rec = '{"site_head":"'.$title.'","link":"'.$url.'","keywords":"'.$keywords.'","description":"'.$description.'","visual_file":"'.$imag.'","file_type":"'.$type.'"}';
 $ch = curl_init(); 

        //Define Settings 
        curl_setopt ( $ch, CURLOPT_URL, $couchurl ); 
        curl_setopt ( $ch, CURLOPT_POST, true );
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $couch_rec);
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        $output = curl_exec($ch);
        echo $output;
        curl_close($ch);
        echo "Inputting data";
}

function follow_links($url)
{
	global $already_crawled;
	global $crawling;
	$options=array('http'=>array('method'=>"GET", 'headers'=>"User-Agent: ScrapBot/1.0\n"));
	$context=stream_context_create($options);
 $doc = new DOMDocument();
 @$doc->loadHTML(@file_get_contents($url,false,$context));
 $linklist = $doc->getElementsByTagName("a");
 
 foreach ($linklist as $link)
 {
 	$l = $link->getAttribute("href");
 	if(substr($l,0,1)=="/" && substr($l,0,2)!="//")
 	{
 		$l=parse_url($url)["scheme"]."://".parse_url($url)["host"].$l;
 	}
 	else if (substr($l,0,2)=="//") 
 	{
 		$l=parse_url($url)["scheme"].":".$l;
 	}
 	else if(substr($l,0,2)=="./")
 	{
        $l=parse_url($url)["scheme"]."://".parse_url($url)["host"].dirname(parse_url($url)["path"]).substr($l,1);
 	}
 	else if(substr($l,0,1)=="#")
 	{
 		$l=parse_url($url)["scheme"]."://".parse_url($url)["host"].parse_url($url)["path"].$l;
 	}
 	else if(substr($l,0,3)=="../")
 	{
 		$l=parse_url($url)["scheme"]."://".parse_url($url)["host"]."/".$l;
 	}
 	else if(substr($l,0,11)=="javascript:")
 	{
 		continue;
 	}
 	else if(substr($l,0,5)!="https" && substr($l,0,4)!="http")
 	{
 		$l=parse_url($url)["scheme"]."://".parse_url($url)["host"]."/".$l;
 	}
 	if(!in_array($l,$already_crawled))
 	{
 		$already_crawled[]=$l;
 		$crawling[]=$l;
 		echo get_details($l)."\n";
 		//echo $l."\n";
 	}
 }
 
 array_shift($crawling);
 foreach ($crawling as $site) {
 	follow_links($site);
 }
}

function _http ( $target, $referer ) { 
        //Global Variables 
        global $user_agent; 

        //Initialize Handle 
        $handle = curl_init(); 

        //Define Settings 
        curl_setopt ( $handle, CURLOPT_HTTPGET, true ); 
        curl_setopt ( $handle, CURLOPT_HEADER, true ); 
        curl_setopt ( $handle, CURLOPT_COOKIEJAR, "cookie_jar.txt" ); 
        curl_setopt ( $handle, CURLOPT_COOKIEFILE, "cookies.txt" ); 
        curl_setopt ( $handle, CURLOPT_USERAGENT, $user_agent ); 
        curl_setopt ( $handle, CURLOPT_URL, $target ); 
        curl_setopt ( $handle, CURLOPT_REFERER, $referer ); 
        curl_setopt ( $handle, CURLOPT_FOLLOWLOCATION, true ); 
        curl_setopt ( $handle, CURLOPT_RETURNTRANSFER, true ); 

        //Execute Request 
        $output = curl_exec ( $handle ); 

        //Close cURL handle 
        curl_close ( $handle ); 

        //Separate Header and Body 
        $separator = "\r\n\r\n"; 
        $header = substr( $output, 0, strpos( $output, $separator ) ); 
        $body_start = strlen( $header ) + strlen( $separator ); 
        $body = substr( $output, $body_start, strlen( $output ) - $body_start ); 

        //Parse Headers 
        $header_array = Array(); 
        foreach ( explode ( "\r\n", $header ) as $i => $line ) {
                if($i === 0) {
                        $header_array['http_code'] = $line;
                        $status_info = explode( " ", $line );
                        $header_array['status_info'] = $status_info;
                } else {
                        list ( $key, $value ) = explode ( ': ', $line );
                        $header_array[$key] = $value;
                }
        }
        //Form Return Structure
        $ret = Array("headers" => $header_array, "body" => $body );
        return $ret;
}
$seed_components = parse_url( $start );
if($seed_components === false) {
        die( 'Unable to Seed Parse URL' );
}
$seed_scheme = null;
if (isset($seed_components["scheme"])) {
    $seed_scheme = $seed_components["scheme"];
}
$seed_host = null;
if (isset($seed_components["host"])) {
	$seed_host = $seed_components["host"];
}
$url_start = $seed_scheme.'://'. $seed_host;
/*
//Initialize robots.txt File Check
$robots_txt_url = $url_start. "/robots.txt";
//echo "Downloading: $robots_txt_url\n";
$robots_txt = _http($robots_txt_url, "");
$parser = new RobotsTxtParser($robots_txt['body']);
if ( !isset($robots_txt['headers']['status_info'][1])) {
   $robots_txt['headers']['status_info'][1] = null;
}
$parser->setHttpStatusCode($robots_txt['headers']['status_info'][1]);
$parser->setUserAgent($user_agent);
//Check if path is allowed
if( $parser->isDisallowed( $seed_components["path"] ) ) {
        die("Robots.txt: Disallowed Seed URL");
}
*/
    follow_links($start);
    print_r($already_crawled);
?>