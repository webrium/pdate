<?php
// require_once __DIR__ . '/config.php';

use PDate\PDate;
use PHPUnit\Framework\TestCase;

class ConvertTest extends TestCase
{
    public const TS = 1714390128;



    public function testConvertShamsiToGregorian(){
        $format = 'Y-m-d';
        $date = PDate::new()->fromGregorian('2024-04-29')->format($format)->get();
        $this->assertEquals('1403-02-10', $date);
    }

    public function testConvertGregorianToShamsi(){
        $format = 'Y-m-d';
        $date = PDate::new()->fromShamsi('1403-02-10')->format($format)->getGregorian();
        $this->assertEquals('2024-04-29', $date);


        $date = PDate::new()
        ->fromShamsi('1403-02-10')
        ->addMonth(1)
        ->format('Y-m')
        ->getGregorian();
        $this->assertEquals('2024-05', $date);

        $date = PDate::new()
        ->fromShamsi('1403-02-10')
        ->addMonth(12)
        ->format('Y-m')
        ->getGregorian();
        $this->assertEquals('2025-04', $date);

        $date = PDate::new()
        ->fromShamsi([1403,02,10])
        ->addMonth(1)
        ->format('Y-m')
        ->get();
        $this->assertEquals('1403-03', $date);
    }

}





