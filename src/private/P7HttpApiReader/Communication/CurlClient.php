<?php declare(strict_types = 1);
/**
 * \P7HttpApiReader\Communication\CurlClient
 *
 * Abstract class with common code base of HTTP clients
 *
 * @todo - complete method list with *all* HTTP verbs;-)
 *
 * @package P7HttpApiReader
 * @version 0.1
 * @since 2020-07-26
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @see https://github.com/svenschrodt/P7HttpApiReader
 * @see https://travis-ci.org/github/svenschrodt/P7HttpApiReader
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */

namespace P7HttpApiReader\Communication;

class CurlClient 
{

   

    /**
     * Constructor function 
     *
     * @throws \ErrorException
     */
    public function __construct()
    {
        if (! function_exists('curl_version')) {
            throw new \ErrorException('Extension cURL needed!');
        }
        
    }

    /**
     * Processing HTTP(s) request to endpoint's uri with given method and optional
     * parameters (sent within uri or payload depending on chosen method as 
     * query string)
     *
     * @param string $url
     * @return boolean|mixed
     */
    public function processRequest($uri, $method = 'GET', array $parameters = [])
    {
//         $ch = curl_init();
//         curl_setopt($ch, CURLOPT_URL, $url);
//         curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/666.0 (Commodore Basic 2.0) P7Tools library/0.0.23');
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//         curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        
//         curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
//         curl_setopt($ch, CURLOPT_TIMEOUT, 5);
       
//         // Reading response headers!
//         curl_setopt($ch, CURLOPT_HEADER, 1);
        
        
        //@ TODO -> try this
        
//         // Then, after your curl_exec call:
//         $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
//         $header = substr($response, 0, $header_size);
//         $body = substr($response, $header_size);
        
        
//         $this->lastResponseBody = curl_exec($ch);

//         $res = curl_getinfo ( $ch );
//         var_dump($res);die;
        
//         $this->statusCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
//         curl_close($ch);
        
//         return $this->lastResponseBody ;
        
       // return ( $this->_responseCode >= 200 &&  $this->_responseCode < 300) ? $this->_content : false;
    }
    
    
   
    
   
}
