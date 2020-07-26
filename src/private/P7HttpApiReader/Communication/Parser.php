<?php declare(strict_types=1);

/**
 * \P7HttpApiReader\Communication\Parser
 *
 * Class for parsing HTTP(s) messages (requests and responses)
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


class Parser
{
    /**
     * Splitting message to header and body part (separated by CRLFCRLF)
     *
     * @param string $message
     * @return array
     */
    public static function splitMessage(string $message) : array
    {
        return explode(Protocol::MESSAGE_SEPARATOR, $message);
    }

    /**
     * Checking if given string is a valid HTTP message, containing CRLFCRLF as separator
     * 
     * @param $string
     * @return bool
     */
    public static function isValidMessage(string $string) : bool
    {
        return (strstr($string, Protocol::MESSAGE_SEPARATOR)) ? true : false;
    }

    /**
     * Splitting HTTP header lines in HTTP message to usable php array
     *
     * @param array $headers
     * @return \stdClass
     */
    public static function splitHeaders(array $headers)
    {
        $parts = explode(Protocol::HEADER_SEPARATOR, $headers);
        $headerData = new \stdClass();
        $headerData->firstLine = trim(array_shift($parts));
        foreach($parts as $headerLine) {
            if(strstr($headerLine, ':')) {
                list($key, $value) = explode(':', $headerLine);
                $propertyName = trim($key);
                $headerData->$propertyName = trim($value);
            }
        }
        return $headerData;
    }

}