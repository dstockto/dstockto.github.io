---
layout: article
title: "Leveling Up: Getting a Date with PHP"
author: David Stockton
date:   2015-06-30 12:00:00 -0600
category: [php_architect, TDD]
tags: [ php, date, time, timezone ]
---
> At some point in your software development career, you're almost guaranteed to run into a problem where you need to know when something happened or when it will happen. In this edition of Leveling Up, we'll be talking about how to get a date with PHP, specifically looking at some of the functionality that PHP provides with the `DateTime` class.

## Introduction

There's an old joke that says, "How many months have 28 days?". Of course there's February, but there's also all of the other months as well. The answer, then, is "All of them." At first glance, dealing with dates and times may not seem to be all that hard. But as it turns out, it can be very hard to wrap your head around some of the parts and understand the implications.

How many hours are there between 1am and 3am? The actual answer is, "it depends". Most of the time, it's 2 hours. Some of the time it's 1 hour and other times it's 3 hours. It all depends on what day you're asking about. And what timezone. Fortunately PHP's `\DateTime` class keeps all of these things in mind and can tell us these things without too much hair-pulling and gnashing of teeth.

## A Few Oddities to Start

Most everyone is aware of the concept of a "leap year". Approximately every 4 years, we add another day to the year to help our calendars stay on track with the fact that it takes about 365.25 days for our little blue ball to make a full trip around the sun. If you have code that does its own date calculations though, you need to make sure you know how to deal with leap years. For instance, this code is wrong:

```php
function isLeapYear($year) 
{
    return ($year % 4 == 0);
}
```

We can show this by writing a bit of PHP code utilizing DateTime to tell us how many days are in a year.

```php
$lastDay = new DateTime('2015-12-31');
echo $lastDay->format('z') + 1;
```

The 'z' format string tells the DateTime object to return a value for the day of the year, starting with 0. So we need to add 1 in order to determine how many days in the year. Running this code as a sanity check shows 365 which is indeed, how many days in 2015.

The year 2012 was our most recent leap year, so if we switch from `2015-12-31` to `2012-12-31` you should see it output 366 days, indicating that PHP does see 2012 as a leap year. But 2012 or 2016 are not interesting as far as calculating leap years. Indeed, the naïve calculation we started with is still correct. If you change the year to 2100, you'll see there's a difference between what DateTime says and what dividing by 4 does, and this is the first way we must expand our definition of what years are "leap years".

If a year is divisible by 4, it's a leap year, unless that year is evenly divisible by 100. So we can update the first bit of code:

```php
function isLeapYear($year)
{
    return (($year % 4 == 0) && ($year % 100 != 0));
}
```

This is a little bit better, but it's not perfect. It will correctly tell us that 1900 and 2100 were not leap years, but unfortunately, the year 2000 was a leap year and the function above would indicate that it was not.

The third part of the rule for determining if a year is a leap year states that years which are even divisible by 400 are leap years as well. So we can update the function with our final criteria:

```php
function isLeapYear($year)
{
    return (($year % 4 == 0) && ($year % 100 != 0)) || ($year % 400 == 0);
}
```

This function will work for all the years, but this article is about doing date and time the right way anyway. PHP has a date formatting option that gives back a '1' if it's a leap year and '0' otherwise. We can utilize that to update our function.

```php
function isLeapYear($year)
{
    return (new DateTime("$year-01-01", new DateTimeZone('GMT')))->format('L') == 1;
}
```

Note that in order for the above function to work, you must be on PHP 5.4 or later. For the equivalent function that will work on PHP 5.2 or later, try this:

```php
function isLeapYear($year)
{
    $date = new DateTime("$year-01-01", new DateTimeZone('GMT'));
    return $date->format('L') == 1;
}
```

Now this is probably way more than you, or I, or almost anyone really cares to read about leap years, so lets move on.

## Timezones

In 1878, a Canadian named Sir Sandord Fleming proposed that the globe be split into 24 time zones, each 15 degrees of longitude wide. Timezones are nice because they mean that we can have lunch at about the same time anywhere in the world and the sun will be just about straight overhead. (Please excuse the gross simplification here).

If we didn't have timezones and instead everywhere on earth used the same times, we'd have a situation where 6am for some people meant time to wake up and for others it means time to go to bed. In any case, the situation with timezones is quite a bit more complex than just 24 global timezones.

In the United States (where I am from) it's common to abbreviate timezones like PST or EST (Pacific Standard Time or Eastern Standard Time), but those abbreviations are not only used in the US. For instance, PST can also mean Pakistan Standard Time and EST could be Eastern Standard Time (for Australia) or Eastern Brazil Standard Time. For this reason, it's recommended not to use timezone abbreviations, but to use timzone IDs. These look like America/Denver or Europe/London or for the very special ones America/Indiana/Knox.

Instead of the 24 timezones proposed by Sir Fleming, we now actually have over 500. This is because, at certain times, some cities or regions or states or other geographic region changed how they dealt with time. This could be switching from using Daylight savings to not using it or switching their offset from GMT. In order for people to be able to accurately determine when things happened (or should happen) we need to know how the time related to GMT.

GMT (also commonly referred to as UTC or Universal Time Coordinated) or Greenwich Mean Time (pronounced GRENitch, not Green Witch) is used as the common base for the other timezones. Times are defined as GMT along with some sort of offset from GMT. As I right this, Denver is at GMT-0600 meaning that we subtract 6 hours from GMT to figure out what time it is in Denver. The Europe/London timezone offset is GMT+0100. This means we add an hour to GMT to get London's time. This means London time is 7 hours ahead of my time. When I'm eating lunch, it's dinner time. When my work day is starting, theirs is wrapping up. Timezones help us keep track of these sorts of things, but they aren't easy. It's also important to note that not all timezones fall neatly on the hour. There are some which are offset by a number of hours as well as 15, 30 or 45 minutes. Additionally not all timezones fall within the range of GMT-12:00 to GMT+12:00. In fact, they go all the way to GMT+14:00. The Line Islands in the Pacific Ocean have a timezone with this offset. It means that while the time of day is the same as Hawaii, it's actually a full day ahead of Hawaii.

Dealing with two timezones on the same day isn't extraordinarily difficult. However, imagine that you're building an application that allows for scheduling appointments or meetings. You could have a server located in one timezone, some meeting participants in one timezone and others in yet another timezone. The problem could be expanded to even more timezones as more meeting attendees are added.

To complicate things further, imagine that this is a recurring daily meeting. When everyone is in the same timezone, telling them there's a recurring 9am meeting is not tough. Whenever the timezone offset changes (for daylight savings) everyone still continues to show up at 9am. However, not all timezones follow daylight savings and even among those that do, they don't all switch on the same day. This means that a recurring meeting for attendees in different timezones may change what time of day it starts depending on what timezone is used as the base for the meeting. It's not an easy problem, but DateTime can help with it.

## Using DateTime

Creating a DateTime object is as simple as "new'ing" one up:

```php
$now = new DateTime();
```

This will create an object set to "now" in the timezone that your PHP is configured for. This is the `date.timezone` setting in your `php.ini` file. You can also override the timezone in your code if you want or need to.

Now, creating this object isn't all that useful unless we can do some things with it. The object has a "format" method which allows any of the formatting options you might be familiar with from PHP's date function. The full list can be found at <http://php.net/manual/en/function.date.php>. Let's give it a shot:

```php
$now = new DateTime();
echo $now->format('Y-m-d H:i:s');

2015-05-15 00:47:50
```

The format tells the object to print out a four digit year (Y) followed by a dash, followed by a two digit month (m), another dash, and a two digit day. This is followed by a space, a two digit hour in 24 hour format(H), colon, then two digit minutes (i), a final colon, and then two digit seconds. And yes, it's pretty late as I'm writing this.

I can use other letters to output almost any date/time format imaginable. I can get numerical months, days, hours, minutes and seconds with or without leading zeros, text representations of months, and days of the week (or abbreviated versions of those as well), information about how many days there are in a given month, whether or not it's a leap year, and two or four digits years. Additionally, I can get indicators like "AM" or "pm", timezone identifiers, whether or not the date is in daylight savings time, timezone offsets, timezone names and abbreviations. You can even get ordinal suffixes for the day like "st" for 1st or "nd" for 2nd and so on, so if I want to output a format like "Friday, May 15th, 2015" I can do that with ease by providing "l, F jS, Y" to the format method.

So we've talked about how to get dates back out, but not how to get dates in. Fortunately, the constructor for DateTime is similar to `strtotime()` and it will accept almost any string that could be reasonably construed as a date. Here are some examples and what the object outputs with a format of "Y-m-d H:i:s":

```text
2015-05-09 19:23:00     -       2015-05-09 19:23:00
Jan 5, 2013             -       2013-01-05 00:00:00
2015/11/07              -       2015-11-07 00:00:00
next Tuesday            -       2015-05-19 00:00:00
3 weeks ago             -       2015-04-24 01:06:04
+2 months               -       2015-07-15 01:06:04
3/5/2015                -       2015-03-05 00:00:00
3-5-2015                -       2015-05-03 00:00:00
```

To me, this is pretty incredible. It gives us all sorts of flexible ways to build dates, in some cases using natural language, or something very close. There are some gotcha's and caveats though. Take a look at the last two examples. The only difference between the last two is the delimiter, but both dates are arguably ambiguous. Americans will often use a "month/day/year" format while much of the rest of the world uses day-month-year. Just by changing the delimiter, the DateTime class changes from interpreting the date in "month day" format to "day month" format. If you're not aware of this, it can easily surprise you and cause some weird errors. My recommendation is to use non-ambiguous formats when you can. The Year-Month-Day format seems to work well for this.

## Adding months is weird

You may have in your mind an idea for what it means to schedule something for "a month from now". However, unlike days and weeks which are consistent, months vary in length. Sometimes it's fairly unambiguous what a month from now would mean. If you're talking about what a month from the first of some month is, likely you're implying the next event should happen on the first of the following month.

If it happens to be January 31st and want to know what the date is a month from then, what's the correct answer? One could argue that since January 31 is the last day of the month then it implies the end of February (either the 28th or the 29th). If you are on the 30th of January and want a month later, it gets a bit more complicated since you're no longer starting from a solid "end of the month" definition. You're simultaneously talking about one day before the end of the month, four weeks and two days into the month, the 30th of the month and probably a few others. Regardless, though, February doesn't have a 30th (or a 31st). 

PHP's DateTime class does something interesting that's important to understand lest it bite you. If we ask DateTime to give us a date that is one month past January 31st, it will give us March 3rd. There is logic behind this, of course. Adding a month to January 31st results in February 31st. This doesn't exist, and in 2015, the 31st is three days past the actual last day of February, so those three days are carried into the next month, and we end up with March 3rd. If we add another month to this resulting date, DateTime gives back an expected (at this point) April 3rd.

Starting back over with January 31st and telling DateTime to add two months at once results in March 31st, so adding both months at once results in an answer that is probably more in line with what you'd expect. Adding three months at once though will result in May 1st due to the same problem explained above -- April only has thirty days, and there is no April 31st. The conclusion to this is that months are weird.

## Parsing Date with a Format

Suppose you have a way to represent a date, but it's not necessarily a "standard" date representation. For instance, maybe you know you'll have the year and a number representing the day of the year. For instance, the 128th day of 2015. DateTime has a solution for this as well.

```php
$date = \DateTime::createFromFormat('z Y', '128 2015');
echo $date->format('Y-m-d'); // prints 2015-05-09
```

It's worth noting that the formatting strings for this method are not exactly the same as the ones you'd expect for formatting output. The formatting values are found in the docs here: <http://php.net/manual/en/datetime.createfromformat.php>

## Comparing and Modifying Dates

Creating and setting dates is fine and dandy, but you'll probably want to be able to change and compare dates. Imagine you're shipping a product out to a customer. You know when they placed the order (now), but you want to tell them when it will arrive (orders take 2 weeks to arrive). You can build and modify the date in order to display this to the user.

```php
$orderDate = new \DateTime(); // 2015-05-19
$shipDate = $orderDate->add(new \DateInterval('P2W')); // 2015-06-02
```

Essentially, the constructor for `DateInterval` accepts a period specifier which starts with a capital P. You can specify the number of years, months, weeks, days, hours, minutes and seconds, but there are some rules about what works or what does not. If you want to include time in the interval, you must precede it with 'T'. This is because it use 'M' for both months and minutes, so it needs something to be able to tell the difference.

Additionally, you can use DateTime's sub method to subtract an interval. This is very useful for figuring out dates in the past relative to a given date.

There is one issue that's important to know about with the example above. If you were to use the code sample above to print out a user's order date and ship date, you'll see that after the call to `->add()`, both $orderDate and $shipDate contain the same values. This is because add actually modifies the date. There is a solution to this though, and it doesn't involve cloning objects or anything like that.

PHP, in addition to providing the \DateTime class which is mutable (meaning the state of the object can be changed), it also provides `DateTimeImmutable` which provides all the same kinds of functionality as DateTime, but in an immutable fashion. Let's revisit the example above:

```php
$orderDate = new \DateTimeImmutable(); // 2015-05-19
$shipDate = $orderDate->add(new \DateInterval('P2W')); // 2015-06-02
```

With this example, $orderDate will remain at 2015-05-19 and the call to add will return a brand new object set to 2015-06-02. This is probably what you'd expect and it's recommended to use the immutable version of the class.

One other way to build a DateInterval is to use the static method `createFromDateString`. From this you can build more complex date relationships.

```php
$anotherNow = new \DateTimeImmutable(); // 2015-05-26
$aWeekFromTues = \DateInterval::createFromDateString('1 week from next Tuesday');
echo $anotherNow->add($aWeekFromTues)->format('Y-m-d'); 
// Outputs 2015-06-09
```

In the example above, $anotherNow is May 26, which is a Tuesday. So next Tuesday would be June 2 and a week after that is June 9. If $anotherNow had been May 25 (Monday) then the output would be 2015-06-02.

If you're going to use strings like the above or allow user input to build these, it's extremely important to test as well as catch and deal with exceptions. In the case of DateInterval, it will throw an \Exception with a message about what the problem was.

## Date Differences

Another common problem is to determine how much time elapsed between two given date/times. This could be to determine short periods of time, like how long it took a user to fill out a form, or longer time periods like how many days until the user's next birthday or how old someone is, or how long it was between the Battle of Thermopylae and when Sputnik 1 was launched into orbit:

```php
$thermopylae = new \DateTimeImmutable('-0480-09-08');
$sputnik = new \DateTimeImmutable('4 Oct 1957');
$difference = $thermopylae->diff($sputnik);
echo $difference->format('%y years and %d days');
```

The variable `$difference` that is returned is an instance of DateInterval. It provides the static createFromDateString, the format method and the constructor. The properties of the DateInterval class are public. If you `var_dump` or debug and view the class, you can see them all. In the example above, $diff contains a public property, `y` with a value of 2437, a `d` property with a value of 26 and a public `days` property with a value of 890122. There are a number of other properties you'll see as well but they will all show 0. The example above would output `2437 years and 26 days`. 

Formatting options for DateInterval are found in the php docs: <http://php.net/manual/en/dateinterval.format.php>. Each of them is preceded by the percent sign (%).

## Scheduling A User Group

Most PHP user groups (or other meetups) I'm aware of follow a schedule like "3rd Wednesday of each month" or "2nd Tuesday" or something similar. It's fairly rare to find a group that meets on the 13th of each month because the day of the week would change. Fortunately we can deal with that as well.

```php
$start = new \DateTimeImmutable('2014-12-31');
$end = new \DateTimeImmutable('2015-12-31');
$interval = DateInterval::createFromDateString('third Wednesday of next month');
$period = new \DatePeriod($start, $interval, $end, \DatePeriod::EXCLUDE_START_DATE);
foreach ($period as $date) {
    echo $date->format("F jS\n");
}
```

Running the code above will print out the dates that my local user group, the Front Range PHP User Group, meets in Denver for the rest of the year. If you happen to be near Denver, Colorado during any of those times, please come check it out, or if you'd like to speak, let me know. We'd be happy to have you.

## Conclusion

Dealing with dates and times can be hard. Fortunately, PHP provides a set of excellent tools with DateTimeImmutable (and DateTime), DateInterval and DatePeriod which will abstract away many of the hard parts and make dealing with dates and times simple and correct. There are still plenty of things to concern yourself with, and remaining hard problems, like scheduling recurring meetings with a bunch of people from different timezones, but the DateTime classes should make all of that significantly easier. To learn more, check out Derick Rethan's book "PHP/Architect's Guide to Date and Time Programming". See you `echo (new DateTime())->modify('next month')`.

> ### Biography
> David Stockton is a husband, father and Software Developer. He builds software at i3logix in Colorado, leading a few teams of software developers creating a very diverse array of web applications. His two daughters, age 11 and 9, are learning to code JavaScript, Python, Scratch and PHP as well as building electrical circuits and a 4 year old son who has been seen studying calculus, recursive algorithms and is excelling at annoying his sisters. David is a conference speaker and an active proponent of TDD, APIs and elegant PHP.