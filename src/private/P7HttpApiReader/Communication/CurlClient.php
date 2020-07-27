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
     * Generic function for processing HTTP(s) request to endpoint's uri with given 
     * method and optional parameters (sent within uri or payload depending on 
     * chosen method 
     * 
     * @param string $uri
     * @param string $method
     * @param array $parameters
     * @see \P7HttpApiReader\Communication\AbstractClient::processRequest()
     */
    public function processRequest(string $uri, string $method = 'GET', array $parameters = [])
    {
     
        // Setting $uri for current request        
        $this->uri = $uri;
        
        // Init cUrl with current funtions 
        $this->initCurlRequest($uri);
        
        // Setting HTTP method for current request
        $this->setMethod($method);        
        
        // Setting up payload parameters, if set
        if(!empty($parameters)) {
           
            $this->setPayloadParameters($parameters);
        }
        
        //@todo -> reading default from configuration
        $this->setRequestHeaders();
        /**
         * Executing HTTP request with given parameters, headers and optional paylod
         * 
         * @var string  $response
         */
        $response = curl_exec($this->curlHandle);

        // Setting header size for current response
        $this->responseHeaderSize = curl_getinfo($this->curlHandle, CURLINFO_HEADER_SIZE);
        
        /// @ todo -> replacig message separators within 7HttpApiReader\Communication\Parser
        $this->rawHeader['response'] = str_replace(Protocol::MESSAGE_SEPARATOR, '', substr($response, 0, $this->responseHeaderSize));
        $this->responseBody = substr($response, $this->responseHeaderSize);

        $this->responseHeaders = Parser::getArrayFromHeader($this->rawHeader['response']);

        $this->responseBody = substr($response, $this->responseHeaderSize);
        $this->statusCode = (int) curl_getinfo($this->curlHandle, CURLINFO_HTTP_CODE);

        // Setting up current request headers (raw and serialized as array) for instance
        $res = curl_getinfo($this->curlHandle);
        $this->rawHeader['request'] = str_replace(Protocol::MESSAGE_SEPARATOR, '', $res['request_header']);
        $this->requestHeaders = Parser::getArrayFromHeader($this->rawHeader['response']);
        
        // Closing current handle to cUrl
        curl_close($this->curlHandle);
        
        
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

        // Returning response instead of writing to STDOUT
        curl_setopt($this->curlHandle, CURLOPT_RETURNTRANSFER, 1);
        
        // Setting timeout for connection creation
        curl_setopt($this->curlHandle, CURLOPT_CONNECTTIMEOUT, $this->ttl);

        // Reading response headers
        curl_setopt($this->curlHandle, CURLINFO_HEADER_OUT, 1);

        // Setting TTL for running cUrl functions
        curl_setopt($this->curlHandle, CURLOPT_TIMEOUT, $this->ttl);

        // Reading response headers from cUrl API!
        curl_setopt($this->curlHandle, CURLOPT_HEADER, 1);
      
    }

    /**
     * Setting (custom) request headers for current request 
     * 
     * @todo reading from default configuration & do real stuff
     * @param array $headers
     */
    public function setRequestHeaders(array $headers = [])
    {
        curl_setopt($this->curlHandle, CURLOPT_HTTPHEADER, array(
            'X-P7HttpApiReader-Client: cUrl',
            'X-P7HttpApiReader-Version: 0.9'
        ));
        curl_setopt($this->curlHandle, CURLOPT_USERAGENT, 'Mozilla/666.0 (Commodore Basic 2.0) P7HttpApiReader library/0.0.23');
    }
}
