<?php

declare(strict_types = 1);
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

class CurlClient extends AbstractClient
{

    /**
     * Handle for current cUrl operation
     *
     * @var integer
     */
    protected $curlHandle = 1;

    /**
     * Time to live for current cUrl operation
     *
     * @var integer
     */
    protected $ttl = 5;

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
     * @return string
     */
    public function processRequest(string $uri, string $method = 'GET', array $parameters = [])
    {
        $this->uri = $uri;
        
        $this->initCurlRequest($uri);
        
        $this->setMethod($method);
        
        if(!empty($parameters)) {
           
            $this->setPayloadParameters($parameters);
        }
        
        
        $this->setRequestHeaders();
        /**
         * Executing HTTP request with given parameters, headers and optional paylod
         * 
         * @var string  $response
         */
        $response = curl_exec($this->curlHandle);

        $this->responseHeaderSize = curl_getinfo($this->curlHandle, CURLINFO_HEADER_SIZE);

        
//         var_dump($this);die;
        
        $this->rawHeader['response'] = str_replace(Protocol::MESSAGE_SEPARATOR, '', substr($response, 0, $this->responseHeaderSize));
        $this->responseBody = substr($response, $this->responseHeaderSize);

        $this->responseHeaders = Parser::getArrayFromHeader($this->rawHeader['response']);

        $this->responseBody = substr($response, $this->responseHeaderSize);
        $this->statusCode = (int) curl_getinfo($this->curlHandle, CURLINFO_HTTP_CODE);

        $res = curl_getinfo($this->curlHandle);
    
        // var_dump($res['request_header']);die;

        $this->rawHeader['request'] = str_replace(Protocol::MESSAGE_SEPARATOR, '', $res['request_header']);
        $this->requestHeaders = Parser::getArrayFromHeader($this->rawHeader['response']);
        // var_dump([$header, $body]);
        // @ TODO -> try this

        // // Then, after your curl_exec call:
        // $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        //

        // $this->lastResponseBody = curl_exec($ch);

        // $res = curl_getinfo ( $ch );
        // var_dump($res);die;

        //
        // curl_close($ch);
        
        
       //  return $this->responseBody;

        // return ( $this->_responseCode >= 200 && $this->_responseCode < 300) ? $this->_content : false;
    }

    /**
     * Setting method for current HTTP request
     * 
     * @param string $method
     */
    protected function setMethod(string $method)
    {
        //@todo sanitize $method
        $this->requestMethod = $method;
        curl_setopt($this->curlHandle, CURLOPT_CUSTOMREQUEST, $method);
       
    }
    
    /**
     *  Setting payload parameters (POST, PUT) for current HTTP request
     *  
     * @param array $data
     */
    protected function setPayloadParameters(array $parameters)
    {
        $this->requestParameters = $parameters;
        curl_setopt($this->curlHandle, CURLOPT_POSTFIELDS, $parameters);
    }
    
    /**
     * Initializing cUrl request with set parameters
     *
     * @param string $uri
     * @return \P7HttpApiReader\Communication\CurlClient
     */
    protected function initCurlRequest(string $uri)
    {
        $this->curlHandle = curl_init();

        // Setting URI dor current request
        curl_setopt($this->curlHandle, CURLOPT_URL, $uri);

        // REturning response instead of writing to STDOUT
        curl_setopt($this->curlHandle, CURLOPT_RETURNTRANSFER, 1);
        
        
        curl_setopt($this->curlHandle, CURLOPT_CONNECTTIMEOUT, $this->ttl);

        // Reading response headers
        curl_setopt($this->curlHandle, CURLINFO_HEADER_OUT, 1);

        // Setting TTL for current request
        curl_setopt($this->curlHandle, CURLOPT_TIMEOUT, $this->ttl);

        // Reading response headers from cUrl API!
        curl_setopt($this->curlHandle, CURLOPT_HEADER, 1);
      
    }

    /**
     * Settin (custom) request headers for current request 
     * 
     * @param array $headers
     */
    public function setRequestHeaders(array $headers = [])
    {
        curl_setopt($this->curlHandle, CURLOPT_HTTPHEADER, array(
            'X-Apple-Tz: 0',
            'X-Apple-Store-Front: 143444,12'
        ));
        curl_setopt($this->curlHandle, CURLOPT_USERAGENT, 'Mozilla/666.0 (Commodore Basic 2.0) P7Tools library/0.0.23');
    }
}
