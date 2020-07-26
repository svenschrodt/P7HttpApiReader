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
     * Generic function for processing HTTP(s) request to endpoint's uri with given method 
     * and optional parameters (sent within uri or payload depending on chosen method as
     * query string)
     * 
     * @todo To be implemented within each class, inheritating from __CLASS__
     * 
     * @todo delete method in __CLASS__ later!!  
     *
     * @param string $url
     * @return boolean|mixed
     */
    public function processRequest($uri, $method = 'GET', array $parameters = [])
    {
       
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
     * Processig HTTP(S) request with method POST, sending optional payload
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
     * Processig HTTP(S) request with method PUT, sending optional payload
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
    
    
}
