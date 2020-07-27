<?php declare(strict_types = 1);

namespace P7HttpApiReader\Communication;
/**
 * \P7HttpApiReader\Communication\AbstractClient
 *
 * Abstract class with common code base for HTTP(S) clients 
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
abstract class AbstractClient
{
    
    /**
     * Sanitized raw http headers (response and request)
     * 
     * @var array
     */
    protected $rawHeader = [];
    
    
    /**
     * URI of endpoint of current request 
     * 
     * @var string 
     */
    protected $uri;
    
    /**
     * Request headers of current HTTP(S) message sent to server
     *
     * @var array
     */
    protected $requestHeaders;
    
    /**
     * Method of current HTTP request
     * 
     * @var string
     */
    protected $requestMethod;
    
    
    /**
     * Holding parameters|paylof for curent request
     * 
     * @var array
     */
    protected $requestParameters;
    
    /**
     * Content (“body”) of received message from HTTP(S) endpoint
     *
     * @var string
     */
    protected $responseBody;
    
    /**
     * Response headers of received HTTP(S) message 
     *
     * @var array
     */
    protected $responseHeaders;

    /**
     * Size of current response header
     * 
     * @var int
     */
    protected $responseHeaderSize;
    
    /**
     * HTTP(S) response code received by last request
     *
     * @var integer
     */
    protected $statusCode;
    
    /**
     * Constructor function
     *
     * @throws \ErrorException
     */
    public function __construct()
    {
       //@todo ??
        
    }
    
    /**
     * Generic function for processing HTTP(s) request to endpoint's uri with given 
     * method and optional parameters (sent within uri or payload depending on chosen 
     * method as query string)
     * 
     * @todo To be implemented within each class, inheritating from __CLASS__
     * 
     * @todo delete method in __CLASS__ later!!  
     * 
     * @param string $uri
     * @param string $method
     * @param array $parameters
     * @return \P7HttpApiReader\Communication\AbstractClient
     */
    public function processRequest(string $uri, string $method = 'GET', array $parameters = [])
    {
        return $this;
    }
    
    /**
     * Setting method for current HTTP request
     *
     * @param string $method
     */
    protected function setMethod(string $method)
    {
        //@todo sanitize $method
        if(!Protocol::isValidMethod($method)) {
            throw new \InvalidArgumentException('Method ' . $method - ' is not vaild!');
        }
        $this->requestMethod = $method;
        curl_setopt($this->curlHandle, CURLOPT_CUSTOMREQUEST, $method);
        
    }
    
    // Methods implementing HTTP methods (“verbs”)
    
    
    /**
     * Processig HTTP(S) request with method HEAD, sending optional parameters
     * as query string within URI
     * 
     * @param string $uri
     * @param array $parameters
     * @return \P7HttpApiReader\Communication\AbstractClient
     */
    public function head(string $uri, array $parameters = [])
    {
        $this->processRequest($uri, Protocol::METHOD_HEAD, $parameters);
        return $this;
    }
    
    /**
     * Processig HTTP(S) request with method POST, sending payload
     * as query string within URI
     * 
     * @param string $uri
     * @param array $payload
     * @return \P7HttpApiReader\Communication\AbstractClient
     */
    public function post(string $uri, array $payload = [])
    {
        $this->processRequest($uri, Protocol::METHOD_POST, $payload);
        return $this;
    }
    
    /**
     * Processig HTTP(S) request with method GET, sending optional parameters
     * as query string within URI
     * 
     * @param string $uri
     * @param array $parameters
     * @return \P7HttpApiReader\Communication\AbstractClient
     */
   public function get(string $uri, array $parameters = [])
    {
        $this->processRequest($uri, Protocol::METHOD_GET, $parameters);    
        return $this;
    }
    
    
    /**
     * Processig HTTP(S) request with method DELETE, sending optional parameters
     * as query string within URI
     * 
     * @param string $uri
     * @param array $parameters
     * @return \P7HttpApiReader\Communication\AbstractClient
     */
    public function delete(string $uri, array $parameters = [])
    {
        $this->processRequest($uri, Protocol::METHOD_DELETE, $parameters);
        return $this;
    }
    
    /**
     * Processig HTTP(S) request with method PUT, sending payload
     * as query string within URI
     * 
     * @param string $uri
     * @param array $payload
     * @return \P7HttpApiReader\Communication\AbstractClient
     */
    public function put(string $uri, array $payload = [])
    {
        $this->processRequest($uri, Protocol::METHOD_PUT, $payload);
        return $this;
    }
    
    /**
     * Getting content (“body”) of current HTTP response
     * 
     * @return string
     */
    public function getContent() 
    {
        return $this->responseBody;
    }
}
