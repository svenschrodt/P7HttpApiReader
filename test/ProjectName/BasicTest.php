<?php
/**
 * Basic testing of PHPUnit's functionality
 * 
 * -
 *
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package ProjectName
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.0.23
 */
class BasicTest extends \PHPUnit\Framework\TestCase
{

    public function testInstatiationOfFoo()
    {
        $foo = new \ProjectName\ExampleClass();
        $this->assertInstanceOf('\ProjectName\ExampleClass', $foo);
    }
}


