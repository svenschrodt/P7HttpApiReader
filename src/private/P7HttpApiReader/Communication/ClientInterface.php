<?php declare(strict_types = 1);

/**
 * \P7HttpApiReader\Communication\ClientInterface
 *
 * Interface for Http clients  
 *
 *
 * @todo -getter & setter for request headers vi cfg, .ini or CFg-Object
 *
 * @package P7HttpApiReader
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @see https://github.com/svenschrodt/P7HttpApiReader
 * @see https://travis-ci.org/github/svenschrodt/P7HttpApiReader
 * @version 0.1
 * @since 2020-07-25
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
namespace P7HttpApiReader\Communication;

interface  ClientInterface
{

   
    public function __construct();
    
    
  
    
    public function processRequest(string $uri, $method = 'GET', array $payload = []);
    
    public function get(string $uri, array $parameters = []);
    
    public function head(string $uri, array $parameters = []);
    
    public function delete(string $uri, array $parameters = []);
    
    public function post(string $uri, array $payload = []);
    
    
    public function put(string $uri, array $payload = []);
    
    
}
