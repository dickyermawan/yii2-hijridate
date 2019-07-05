Hijri Date - Tanggal Hijriyah Indonesia
=======================================
Hijri Date - Tanggal Hijriyah Indonesia

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require dickyermawan/yii2-hijridate
```

or add

```
"dickyermawan/yii2-hijridate": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?php

use dickyermawan\hijridate\HijriDate;

$hd = new HijriDate(); // for today
echo $hd->get_date(); // 2 Dzul Qa'dah 1440H
echo $hd->get_date(true); //2 Dzul Qa'dah 1440 H

$hd = new HijriDate('2019-06-05'); //for custom date
echo $hd->get_date(); // 1 Syawwal 1440H
echo $hd->get_date(true); //1 Syawwal 1440 H

echo $hd->get_date(true, true); //01 Syawwal 1440 H