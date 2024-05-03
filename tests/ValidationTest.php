<?php
// require_once __DIR__ . '/config.php';

use PDate\PDate;
use PHPUnit\Framework\TestCase;

class ValidationTest extends TestCase
{
    public const TS = 1714390128;

    public function testCheckMethod(){
        $result = PDate::check(4,6,1403);
        $this->assertTrue($result);

        $result = PDate::check('4','6','1403');
        $this->assertTrue($result);

        $result = PDate::check(4,40,1403);
        $this->assertFalse($result);

        $result = PDate::check(4,40,143);
        $this->assertFalse($result);
    }
    public function testCheckStrMethod(){
        $result = PDate::checkStr('1403-03-04');
        $this->assertTrue($result);

        $result = PDate::checkStr('1403-30-04');
        $this->assertFalse($result);

        $result = PDate::checkStr('1400-03-041');
        $this->assertFalse($result);
    }

}





