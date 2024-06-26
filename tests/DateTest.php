<?php
// require_once __DIR__ . '/config.php';

use PDate\PDate;
use PHPUnit\Framework\TestCase;

class DateTest extends TestCase
{
    public const TS = 1714390128;

    public function testNew(){
        $now = PDate::new()->get();
        $date = PDate::new()->timestamp(self::TS)->get();
        $this->assertLessThan($now, $date);
    }

    public function testNow()
    {
        $now = PDate::new()->now()->get();
        $date = PDate::new()->timestamp(self::TS)->get();
        $this->assertLessThan($now, $date);
    }

    public function testFormat()
    {

        $date = PDate::new()->format('Y-m-d')->timestamp(self::TS)->get();
        $this->assertEquals('1403-02-10', $date);
    }


    public function testMonthDays()
    {
        $days = PDate::new()->monthDays(self::TS);
        $this->assertEquals(31, $days);
    }


    public function testAddDays()
    {
        $format = 'Y-m-d';

        $date = PDate::new()
            ->timestamp(self::TS)
            ->addDay(12)
            ->format($format)
            ->get();
        $this->assertEquals('1403-02-22', $date);

        $result = PDate::new()->timestamp(self::TS)->addDay(35)->format($format)->get();
        $this->assertEquals('1403-03-14', $result);
    }

    public function testAddWeeks()
    {
        $format = 'Y-m-d';

        $date = PDate::new()
            ->timestamp(self::TS)
            ->addWeek(1)
            ->format($format)
            ->get();
        $this->assertEquals('1403-02-17', $date);

        $date = PDate::new()
            ->timestamp(self::TS)
            ->addWeek(4)
            ->format($format)
            ->get();
        $this->assertEquals('1403-03-07', $date);
    }


    public function testAddMonth()
    {
        $format = 'Y-m-d';


        $date = PDate::new()
            ->timestamp(self::TS)
            ->addMonth(1)
            ->format($format)
            ->get();

        $this->assertEquals('1403-03-10', $date);

        $date = PDate::new()
            ->timestamp(self::TS)
            ->addMonth(-1)
            ->format($format)
            ->get();

        $this->assertEquals('1403-01-10', $date);

        $date = PDate::new()
            ->timestamp(self::TS)
            ->addMonth(12)
            ->format($format)
            ->get();

        $this->assertEquals('1404-02-09', $date);
    }


}





