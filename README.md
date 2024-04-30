# Persian Date


## pdate provides the ability to use Hijri dates and also convert Gregorian dates to Hijri dates and vice versa easily.

Hijri calendar library is created based on jdf library

## Install pdate

```
composer require webrium/pdate
```


```PHP
use PDate\PDate;


PDate::new()->get();
// 1403-02-10 21-10-25

PDate::new()
   ->timestamp('1714390128')
   ->format('Y-m-d')
   ->get();
   // 1403-02-10

```

### Convert Date 
```PHP
PDate::new()
   ->fromGregorian('2024-04-29')
   ->format('Y-m-d')
   ->get();
  // 1403-02-10


PDate::new()
   ->fromShamsi('1403-02-10')
   ->format('Y-m-d')
   ->getGregorian();
  // 2024-04-29
```

### Add Days and week and month to date

```PHP
PDate::new()->now()->addDay(4)->get();
// 1403-02-14 21-10-25

PDate::new()->now()->addWeek(1)->get();
// 1403-03-17 21-16-25

PDate::new()->now()->addMonth(1)->get();
// 1403-03-14 21-16-25

PDate::new()
   ->fromGregorian('2024-04-29')
   ->format('Y-m-d')
    ->addDay(5)
   ->get();
  // 1403-02-15
```


### Methods

```PHP
$pdate = PDate::new();

$pdate->day(); // 27

$pdate->month(); // 11

$pdate->year(); // 1403

$pdate->clock(); // 20:46:32

$pdate->hour(); // 23

$date->minutes(); // 59

$pdate->second(); // 45

// Persian month name
$pdate->monthName(); //خرداد

//The number of days in the month
$pdate->monthDays(); // 31 
```
<br>

You also have access to the `jdate` method. jdate is the same as `date` but for Hijri date

```PHP
PDate::new()->jdate();
```



