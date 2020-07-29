<?php declare(strict_types = 1);
/**
 * \P7HttpApiReader\Communication\RequestReflector
 *
 * Class for reflecting HTTP requests, for testing 
 *
 * @todo - complete method list with *all* HTTP verbs;-)
 *      
 * @package P7HttpApiReader
 * @version 0.9
 * @since 2020-07-26
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @see https://github.com/svenschrodt/P7HttpApiReader
 * @see https://travis-ci.org/github/svenschrodt/P7HttpApiReader
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
namespace P7HttpApiReader\Communication;

class RequestReflector
{

    /**
     * Version of CurlClient
     *
     * @var string
     */
    const VERSION = '0.9';

    /**
     * HTTP method used by current request 
     * 
     * @var string
     */
    protected $method;
    
    /**
     * Array holding data sent via payload (POST, PUT...)
     * @var array
     */
    protected $payloadData;
    
    /**
     * Data sent via query string URI encoded
     * 
     * @var array
     */
    protected $uriData;
    
    
    /**
     * Data sent via query string URI encoded additionally to payload
     * 
     * e.g:data sent with PUT, POST and addito query string within URI
     * 
     * <code>
     * 
     * POST /index.php?argument=foo
     * HOST: localhost
     * 
     * ?name=Sven&City=Moers
     * 
     * </code>
     *
     * @var array
     */
    protected $queryString;
    
    /**
     * HTTP status code of current response
     * initialized with OK
     *
     * @var int
     */
    protected $currentStatus = 200;
    
    /**
     * Response header fields acc. to RFC 216 sec 6.2
     *
     * @link http://www.w3.org/Protocols/rfc2616/rfc2616-sec6.html#sec6.2
     * @var array
     */
    protected $headers = array();
    
    /**
     * HTTP Header Lines
     *
     * @var string
     */
    protected $headerLines;
    
    /**
     * HTTP pay load
     *
     * @var string
     */
    protected $body;
    
    /**
     * Instance of \P7HttpApiReader\Communication\Protocol for accessing 
     * general HTTP protocol methods, coodes & character sequences 
     *
     *
     * @var Protocol
     */
    protected $protocol;
    
    /**
     * HTTP message (header lines and body)
     *
     * @var string
     */
    protected $message;
    
 
    
    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        
        switch($this->method) {
            case 'PUT':
                // PUT data need to be read from PHP STDIN input wrapper    
                $this->payloadData =  parse_str(file_get_contents('php://input'));
                $this->queryString = parse_str($_SERVER['QUERY_STRING']);
                break;
                
            case 'POST':
                // POST data will to read from PHP super global, ensuriig original data sent will not be manipulated 
                $this->payloadData =  $_POST;
                $this->queryString = parse_str($_SERVER['QUERY_STRING']);
                break;
                
            case 'GET':
            case 'DELETE':
                // POST data will to read from PHP super global, ensuriig original data sent will not be manipulated
                $this->$uriData =  $_GET;
                break;
               
                
        }
    }
    
    /**
     * Setting current http status code
     *
     * @param string $status
     * @throws \InvalidArgumentException
     * @return RequestReflector
     */
    public function setStatusCode( string $status) : \P7HttpApiReader\Communication\RequestReflector
    {
        // Checking if code is a valid status code (== key in array $this->statusCodes)
        if (! in_array($status, array_keys($this->protocol::$statusCodes))) {
            throw new \InvalidArgumentException('Invalid Code');
        } else {
            $this->currentStatus = (int) $status;
        }
        
        return $this;
    }
    
    /**
     * Returning current status code
     *
     * @return int
     */
    public function getStatusCode() : int
    {
        return $this->currentStatus;
    }
    
    /**
     * Initialize response with some default values
     *
     * @param bool $setDefaultHeaders
     * @todo Make it protected after DEV phase
     */
    public function init(bool $setDefaultHeaders = false)
    {
       
    }
    
    /**
     * Setting HTTP header $name to $value
     *
     * @param string $name
     * @param string $value
     * @return RequestReflector
     */
    public function setHeader(string $name, string $value)
    {
        $this->headers[$name] = $value;
        return $this;
    }
    
    /**
     * Getting HTTP header $name
     *
     * @param string $name
     */
    public function getHeader(string $name): string
    {
        return isset($this->headers[$name]) ? $this->headers[$name] : $this->headers[$name];
    }
    
    /**
     * Setting all HTTP headers of current instance
     *
     * @param array $headers
     * @return RequestReflector
     */
    public function setHeaders(array $headers) : \P7HttpApiReader\Communication\RequestReflector
    {
          $this->headers = $headers;
        
        return $this;
    }
    
    /**
     * Returning all HTTP headers of current instance
     *
     * @return array
     */
    public function getHeaders() : array 
    {
        return $this->headers;
    }
    
    /**
     * Setting body of current instance
     *
     * @param string $body
     * @return Response
     */
    public function setBody(string $body)
    {
        $this->body = $body;
        return $this;
    }
    
    /**
     * Returning body of current instance
     *
     * @return string $body
     * @return mixed
     */
    public function getBody(): string
    {
        return $this->body;
    }
    
    /**
     * Sending currently set headers (array $this->headers)
     *
     * @return RequestReflector
     */
    public function sendHeaders()
    {
        // Setting up status code (first line of headers)
        http_response_code($this->currentStatus);
        // Setting all other headers
        foreach ($this->headers as $key => $val) {
            header($key . ': ' . $val);
        }
        return $this;
    }
    
}
