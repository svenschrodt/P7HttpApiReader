<?php declare(strict_types=1);
/**
 * \P7HttpApiReader\Communication\Protocol
 *
 * Class representing general HTTP protocol 
 * (methods, headers , other  attributes etc.)
 *
 * !Do not use in production until it is stable!
 *
 * @todo add references to relevant RFCs to DocBlock commenting!
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

class Protocol
{
    //@todo add mor comments
    const VERSION_10 = '1.0';
    const VERSION_11 = '1.1';
    const VERSION_20 = '2.0';
    
    //Methods
    const METHOD_OPTIONS = 'OPTIONS';
    const METHOD_GET = 'GET';
    const METHOD_HEAD = 'HEAD';
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';
    const METHOD_DELETE = 'DELETE';
    const METHOD_TRACE = 'TRACE';
    const METHOD_CONNECT = 'CONNECT';
    
    const HEADER_SEPARATOR = "\r\n";
    const MESSAGE_SEPARATOR = "\r\n\r\n";
    
    /**
     * Array with valid HTTP request methods
     *
     * @var array
     */
    protected  $validMethods = array(self::METHOD_OPTIONS, self::METHOD_GET, self::METHOD_HEAD , self::METHOD_POST, self::METHOD_PUT, self::METHOD_DELETE, self::METHOD_TRACE, self::METHOD_CONNECT);
    /**
     * HTTP status codes acc. to RFC 216 sec 10 'Status Code Definitions':
     *
     * Status code equals array key and value reason phrase
     *
     *
     * @todo Complete list!
     * @link  http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html#sec10
     * @var array
     */
    public static $statusCodes = array(
        // Informational 1xx
        100 => 'Continue', 101 => 'Switching Protocols', 102 => 'Processing',
        
        // Successful 2xx
        200 => 'OK', 201 => 'Created', 202 => 'Accepted', 203 => 'Non-Authoritative Information',
        204 => 'No Content', 205 => 'Reset Content', 206 => 'Partial Content', 207 => 'Multi-status',
        208 => 'Already Reported',
        
        // Redirection 3xx
        300 => 'Multiple Choices', 301 => 'Moved Permanently', 302 => 'Found', 303 => 'See Other',
        304 => 'Not Modified', 305 => 'Use Proxy', 306 => 'Switch Proxy', // Deprecated
        307 => 'Temporary Redirect',
        
        // Client Error 4xx
        400 => 'Bad Request', 401 => 'Unauthorized', 402 => 'Payment Required', 403 => 'Forbidden',
        404 => 'Not Found', 405 => 'Method Not Allowed', 406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required', 408 => 'Request Time-out', 409 => 'Conflict',
        410 => 'Gone', 411 => 'Length Required', 412 => 'Precondition Failed',
        413 => 'Request Entity Too Large', 414 => 'Request-URI Too Long', 415 => 'Unsupported Media Type',
        416 => 'Requested range not satisfiable', 417 => 'Expectation Failed', 418 => 'I\'m a teapot',
        422 => 'Unprocessable Entity', 423 => 'Locked', 424 => 'Failed Dependency',
        425 => 'Unordered Collection', 426 => 'Upgrade Required', 428 => 'Precondition Required',
        429 => 'Too Many Requests', 431 => 'Request Header Fields Too Large',
        
        // Server Error 5xx
        500 => 'Internal Server Error', 501 => 'Not Implemented', 502 => 'Bad Gateway',
        503 => 'Service Unavailable', 504 => 'Gateway Time-out', 505 => 'HTTP Version not supported',
        506 => 'Variant Also Negotiates', 507 => 'Insufficient Storage', 508 => 'Loop Detected',
        511 => 'Network Authentication Required'
    );
    
    /***
     * Returning HTTP status codes
     *
     * @param bool $codeOnly
     * @return array
     */
    public function getStatusCodes($codeOnly = false)
    {
        return ($codeOnly) ? array_keys(self::$statusCodes) : self::$statusCodes;
    }
    
    /**
     * Returning valid request methods
     *
     * @return array
     */
    public function getMethods()
    {
        return $this->validMethods;
    }
    
    /**
     * Checking if given method is valid HTTP method
     *
     * @param $method
     * @return bool
     */
    public function isValidMethod($method)
    {
        return in_array(strtoupper($method), $this->validMethods, true);
    }
    
}