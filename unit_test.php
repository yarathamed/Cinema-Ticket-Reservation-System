<?php
use PHPUnit\Framework\TestCase;
class FirstTest extends PHPUnit_Framework_TestCase
{
    public function testTrueAssetsToTrue_tickets()
    {
        $tickets = 100;
        $this->assertTrue(is_int($tickets));
    }
}

?>