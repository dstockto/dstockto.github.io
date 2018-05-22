---
layout: article
title: "Leveling Up: Advanced Counting"
author: David Stockton
date:   2015-03-31 12:00:00 -0600
category: [php_architect, counting]
tags: [ php, counting, binary, hex, alternate bases ]
---
> In this edition of Leveling Up, we're going to talk about counting. We'll take a look at how counting works, how different number systems work and how you can use this have a better understanding of how your computer works, as well as how we can use this information to make our functions more expressive.

## Introduction

To start off, let's review just a little. Counting should be old-hat to you by now, possibly so much so that you may take a few things for granted. I'm going to point those out now since they will be important soon. At this time, most cultures on earth count as follows: 1, 2, 3 ... 8, 9, 10, 11,...  I've left out the middle numbers, since I'm sure you're familiar, but the really interesting part happens when we move from 9 to 10. No, really, it's interesting, stick with me.

When we move from 9 to 10, we've gone from being able to represent the number with a single digit to now needing two digits. Another interesting point happens when we go from 99 to 100 and another from 999 to 1,000. Let's look at how we read these numbers to find out why it's so interesting. Let's see how we read the number 747:

| 100s | 10s | 1s |
|:----:|:---:|:--:|
|   7  |  4  | 7  |

What this really means is that we have seven 100s, four 10s, and seven 1s. The value of this number can be found with (7 * 100) + (4 * 10) + (7 * 1) or 747 (duh). Again, this all probably looks like review and indeed it is. Now, let's look this time, moving from 9 to 10.

Here's 9:

| 10s | 1s |
|-----|----|
|  0  |  9 |

and here's 10, the result of adding 1 to 9 or moving forward with counting:

| 10s | 1s |
|-----|----|
|  1  |  0 |

When we move from 9 to 10, we're able to increment our 10s column and zero out the 1s column. This is because we're using what's known as "base 10", that is, 10 is the basis for our counting system.

## History of counting and number systems

As I mentioned earlier, we (and most of the people on earth today), use a base 10 number system. It hasn't always been this way though. The ancient Mayans used a number system based on 20. Ancient Babylonians used a base 60 number system. Other societies and languages have used number systems based on 27, 6, 15 and 12. Some number systems don't even follow the same rules as an "n" based number system. For instance, there's a language, Supyire, spoken in Niger-Congo. Its number system is based on 1, 5, 20, 80 and 100. In Bukiyip, a language spoken in Papua New Guinea, some things are counted in base 3 and others in base 4. One group called the Dozenals, promotes learning and using base 12 and alternative base mathematics.

You're probably also familiar with some other number systems as well. Think of how money is represented and how the value of a collection of coins is calculated. For instance, let's look at how we could represent $2.92 in coins and bills.

| Dollar | Quarter | Dime | Nickel | Penny |
|:------:|:-------:|:----:|:------:|:-----:|
|  1.00  |   .25   |  .10 |   .05  |  .01  |
|     2  |    3    |   1  |   1    |   2   |

If you follow the same rules as above, multiplying each column header by the value below and adding them, you'll end up with 2.92. However, money doesn't have the same rules as number and counting systems. For instance, the $0.05 nickel could have been represented or given as 5 pennies, or any other of a number of possible representations of the same $2.87 value. So for the rest of this article we'll be talking about straight base-n number systems, all of which follow the same rules.

## The rules of base-n number systems

Starting with our familiar base-10 number system as an example, let's talk about the rules:

1. In a base-n system, the numbers used should start at 0 and go up to n-1. For example, in base 10, we can use the numbers 0-9.
2. When counting (incrementing by 1), if a column contains a value that cannot be represented by a single digit, reduce that column to 0 and increment the next column to the left. This is a round-about way of saying "carry the 1".
3. The value of each column is the base number raised to the next integer power higher than the column to its right. This means that the right most column's value will be the base raised to the 0th power. The column on its left will be the base raised to the 1st power. Then next column is the base raised to the 2nd power, and so on. I'll be using the caret (^) to represent powers from this point forward, for instance, 10 raised to the 2nd power (10 squared) would be 10^2. So the general case could look something like this:

|base n | n^4  | n^3  | n^2 | n^1 | n^0 |
|:-----:|:----:|:----:|:---:|:---:|:---:|
|base 10|10,000|1,000 | 100 | 10  |  1  |

## Base-2, same rules

Let's take a look at the same set of rules that we have for base-10 with base-2. Rule 1 indicates we can use the numbers from 0 up to one less than the base: so for base 2, our allowed numbers are 0 and 1. The values of the columns look like this:

| 2^4 | 2^3 | 2^2 | 2^1 | n^0 |
|:---:|:---:|:---:|:---:|:---:|
|  16 |  8  |  4  |  2  |  1  |

With all of our example bases, you might have noticed that the right-most column is always a 1. With base-2, we're "carrying the 1" every other time we increment in counting. Let's see what the first 16 numbers look like:

| Base 10 | Base 2 | Base 10 | Base 2 |
|:-------:|:------:|:-------:|:------:|
|    0    |  0000  |    8    |  1000  |
|    1    |  0001  |    9    |  1001  |
|    2    |  0010  |    10   |  1010  |
|    3    |  0011  |    11   |  1011  |
|    4    |  0100  |    12   |  1100  |
|    5    |  0101  |    13   |  1101  |
|    6    |  0110  |    14   |  1110  |
|    7    |  0111  |    15   |  1111  |

We can always leave off the leading 0s. They are not necessary in writing the number just like the number 59 isn't typically written as "0059". I'm leaving them on in the table above so the numbers line up nicely.

## Uses of binary

Inside the computer, everything is binary -- 1s and 0s, on and off. When we're writing numbers in our code, it ends up getting translated into binary. At the lowest level, the logic gates that make up your computer can only tell the difference between a 0 and a 1, or a wire with no current and a wire with current. The internal data types used are stored in binary. Try this in PHP:

```
echo PHP_INT_MAX;
```

Depending on your platform, or really how many bits your version of PHP was compiled for, you should see either 9223372036854775807 for a 64-bit platform, or 2147483647 for a 32-bit platform. The reason for this is, again, binary. We have either 32 or 64 bits (think columns in our examples above) to represent numbers. Since we also want to be able to represent negative numbers, we use one bit for that. The actual representation of negative numbers is slightly more complex than just flipping the left-most bit, but if you raise 2 to the 31st or 63rd powers, you should find you get the same values shown above. Or rather, you'll get a number which is 1 higher than those values. This represents the largest value you can represent in a 32 or 64 bit signed integer. So now we know that those seemingly bizarre maximum integer sizes aren't so arbitrary after all.

We can use the same type of math on base-10 numbers to make sure it works. For instance, we know the highest base-10 number we can store in three decimal (base-10) digits would be 999. 

```
echo pow(10, 3) - 1;
```

The -1 is used to take the 0 into account. In other words, for base-10, there are 1000 possible numbers that can be represented. Since 0 is one of those, the highest is 1000-1, or 999.

We'll come back to binary in a bit, but let's look at another common base for computers.

## Base-8, octal

Following the same rules again but for base-8, we find that we can use the numbers 0 to 7. This means counting in octal looks something like this:

```
1, 2, 3, 4, 5, 6, 7, 10, 11, 12, ...
```

Octal is another nice base to work with for the computer. Let's take a look back at the first 7 values in our binary table and add in octal:

| Base 10 | Base 2 | Base 8 |
|:-------:|:------:|:------:|
|    0    |  000   |    0   |
|    1    |  001   |    1   |
|    2    |  010   |    2   |
|    3    |  011   |    3   |
|    4    |  100   |    4   |
|    5    |  101   |    5   |
|    6    |  110   |    6   |
|    7    |  111   |    7   |

Interestingly, up to 7, base 10 and base 8 are identical. Also, conveniently, in base 2, 111 corresponds to 7 in octal. So we can easily convert from a binary number to octal by grouping the binary number into sets of 3 and then using the chart above. For example, the binary number b011010111 would be split into 011 010 111 and correspond to 327. In decimal, these are equivalent to 215. We can use PHP to check this:

```
echo 0b011010111; // prints 215
echo 0327;        // prints 215
```

In PHP, we can represent a binary number (as of PHP 5.4+) starting with 0b. We can also represent an octal number starting with a leading 0. This is true as long as none of the digits are greater than 7. If there are any greater than 7, then PHP will ignore the leading 0 and treat the number as decimal.

You might already be familiar with a common use of octal if your OS of choice is *nix or MacOS. The chmod command allows an argument that's octal:

```
chmod 764 /path/to/file
```

Each of the digits in the octal number 764 (number randomly chosen) represents permissions on a file. The first digit is used for the owner of the file, the second digit is for the group the file belongs to, and the last digit is for "world" or everyone else. We can give read a value of 4, write a value of 2 and execute a value of 1. This should look similar to the headers in one of the binary charts:

| Read | Write | Execute |
|:----:|:-----:|:-------:|
|   4  |   2   |    1    |

Using these values, we can determine the desired permissions represented by 764. For the owner, a 7 is created with a 4, 2 and 1 (4 + 2 + 1) which means the owner is receiving all permissions. The group value of 6 is created with 4 and 2 so the group has read and write permissions. The world value of 4 indicates that everyone else is able to read the file. If you can remember the values above, it should be easy to determine what any given numerical argument to chmod actually means.

For now though, let's look at one more common computer base.

## Base 16 - hexadecimal

As before, let's try another number base by reviewing the rules. Rule 1 says we can use the numbers 0 up to 15 in a location. This is a problem. Suppose we have the number 115. Would that be read as 1 | 1 | 5, or 11 | 5 or 1 | 15? Each of those have very different values. In order to fix this, instead of representing the values 10-15 as 10-15, we'll introduce some new symbols. So now counting in hexadecimal looks like this:

```
1, 2, 3, 4, 5, 6, 7, 8, 9, A, B, C, D, E, F
```

Now, if you're looking at a hexadecimal number (hex for short) and see a letter, know that A = 10, B = 11, C = 12, D = 13, E = 14 and F is 15. All the rest of the rules still apply. Let's take a look at the hex number 0x1FA.

| 256 | 16 | 1 |
|:---:|:--:|:-:|
|  1  |  F | A |

To calculate the decimal equivalent:

```
(1 * 256) + (15 * 16) + (10 * 1) = 506
```

We can check in PHP with the following:

```
echo 0x1FA; // prints 506
```

The case for the letters in hex in PHP doesn't matter: 0x1fa is the same as 0x1FA.

The reason hex is useful on the computer is similar to why octal is useful: it's easy to convert hex to and from binary. Instead of splitting into groups of 3 binary digits like we did for octal, we split into groups of 4 binary digits. This becomes even more convenient when we realize that 2 hex digits is a full byte worth of digits.

You're likely very familiar with an extremely common use of hex numbers: HTML/CSS colors. Using this knowledge, we can start to recognize what colors are represented by a hex value or even create a hex value that is close to the color we want. Let's take a look at an example color: #DC5921. First we split the hex value into individual bytes, or groups of 2 hex digits.

```
DC  59   21
```

These values represent RGB, or red, green and blue values. Each color has one byte, or 8 bits of value, to determine how much of each "primary" color is mixed into the final color. We know that an 8-bit (binary) value can hold a value between 0 and 255 (2^8 - 1). So let's convert these values to decimal and see what we're looking at:

```
DC ==> (13 * 16) + (12 * 1) = 220
59 ==> (5 * 16) + (9 * 1) = 89
21 ==> (2 * 16) + (1 * 1) = 33
```

So we end up with a red value of 220, green value of 89 and blue of 33. Each of these are out of 255, so based on estimations, we can guess there's a good deal of red component to the color mixed with a decent amount (about 1/3) of green and even less blue. Mixing light is different than mixing pigment. If all the values were 255 (or FF in hex) then we'd have white. And if they were all 0, we'd have black. If you try out the color above, it turns out it's an orange, specifically PHP Architect Orange.

## Bitmap/Bitmasking

In binary, we saw that each position (each column), can hold one of two values, either 1 or 0. Suppose we have a number of flags or switches in code that we need to keep track of and they are all related. One common example in PHP are the flags for PHP's error_reporting setting. The user is going to want to be able to enable or disable each of those flag individually and independently. In order to do that, we could have individual functions for each one of PHP's different error reporting levels. Right now, there are 15 different error levels. That could mean 15 separate functions, each accepting a boolean argument. However, that's assinine. Another option would be a single function that allows you to set the values with 15 individual arguments:

```
function error_reporting($error, $warning, $parse, $notice, $coreError, $coreWarning, $compileError, $compileWarning, $userError, $userWarning, $userNotice, $strict, $recoverableError, $deprecated, $userDeprecated) { ... }
```

However, this too, would be a nightmare to use. What PHP has in this function is the concept of using a bitmap. It allows the incoming parameter (a single parameter) to be an integer. If you look at the value in binary, the rightmost 15 bits each represent the on/off value of one of the error reporting flags.

The whole table would be too wide to fit, but let's look at the last 4 values:

| E_NOTICE | E_PARSE | E_WARNING | E_ERROR |
|:--------:|:-------:|:---------:|:-------:|
|     8    |    4    |     2     |    1    |

This should look just like the header values on the binary table. The value of each error reporting value is twice that of the one that comes before it. This continues on all the way up to the (current) highest value for E_USER_DEPRECATED with 16,384.

You can see the values listed in the PHP docs. [http://php.net/manual/en/errorfunc.constants.php (http://php.net/manual/en/errorfunc.constants.php)

So at this point, it's probably fairly simple to see how we can set our own desired value. For instance, let's say we want to see only E_ERROR_, E_WARNING and E_STRICT. E_ERROR's value is 1, E_WARNING is 2 and E_STRICT is 2048. If we add those up, calling error_reporting(2051) will result in only seeing those 3 values.

Fortunately, setting these values in PHP code doesn't require us to look up the docs to find the values. PHP defines constants with those values. Try it out:

```
echo E_ERROR + E_WARNING + E_STRICT; // prints 2051
```

Now strictly speaking, while the above does work, it doesn't work for the right reason. Next, we're going to take a look at a few PHP operators that we can use to make sure the values we get when combining these flags are correct all the time.

## Bitwise Operators

PHP provides several operators to help when working with bit values. For this part, we'll be looking at bitwise OR (|), bitwise AND (&), bitwise NOT (~) and bitwise XOR (^). There are additional bitwise operators but for our purposes, we don't need them right now.

With the exception of bitwise NOT (~), the other operators all work on two values. First, we'll get bitwise NOT out of the way. The bitwise NOT operator simply flips the values of the bits sent in. That means ~0 would be 1 and ~1 is 0. In PHP, if we test this we will see this:

```
echo decbin(~0b1);
// prints 1111111111111111111111111111111111111111111111111111111111111110
echo decbin(~0b0);
// prints 1111111111111111111111111111111111111111111111111111111111111111
```

In the examples above, there are a lot of values we don't care about, but the parts that do matter for right now are the final digits. Now let's look at the other operators.

First, we have the bitwise AND (&) operator. It will give back a 1 in each position where both of the values have a 1 in the same position.

| &     | 0 | 1 |
|:-----:|:-:|:-:|
| **0** | 0 | 0 |
| **1** | 0 | 1 |

For bitwise OR (|), we get a 1 in each position where either of the values have a 1 in that position:

| OR    | 0 | 1 |
|:-----:|:-:|:-:|
| **0** | 0 | 1 |
| **1** | 1 | 1 |

Finally, the XOR (^) operator will give us back a 1 where only one of the input values contains a 1 in that position.

|   ^   | 0 | 1 |
|:-----:|:-:|:-:|
| **0** | 0 | 1 |
| **1** | 1 | 0 |

To apply any of these operators, compare each bit for each number in the same position. The resulting bit comes from the table. Let's try on a few small examples:

```
   01011011     01011011     01011011 
 & 01010101   | 01010101   ^ 01010101  
 ----------   ----------   ----------
   01010001     01011111     00001110
```

In the examples above, the arguments are the same. Lining up the binary vertically makes it easy to make the comparisons and the result. So if we continue the analogy of each of the bits representing an on/off switch, then these operators work like this: the AND operator will turn off all switch values in the first where the second has a 0. The OR operator will turn on all switches where the bit value is a 1. This means if it was already on, it will still be on. The XOR operator will flip the value for each position where the second value has a 1. By flipping, I mean if it was on, it will be off in the result, if it was off, it will be on.

Going back to my earlier statement where I said that adding was not the right way to deal with these values. The right way to deal with them is to use these bitwise operators. Pretend that you don't know what the existing value of error_reporting is, but you want to make sure that notices are turned on. We can do that with the following code:

```
$current = error_reporting();
$new = $current | E_NOTICE;
error_reporting($new);
```

The above code will result in notices being turned on. If they were already on, they will remain on. If instead of using |, we'd used +, then if E_NOTICE was already on, the entire value of the error reporting flags would change. Essentially we'd end up with an operation that would carry the E_NOTICE value. If E_STRICT were originally off, it would now be on, which is not what we want. If it was on, then it too would carry, moving down the line to E_RECOVERABLE_ERROR and so on. A similar issue would arise if we used subtraction instead of turning off a flag with bitwise operations.

To turn off a value, we use a combination of the bitwise AND and NOT operators:

```
$current = error_reporting();
$new = $current & ~E_STRICT;
error_reporting($new);
```

The ~E_STRICT will result in a value that has a 1 in every location exception for the one representing E_STRICT. When we apply bitwise AND (&) it with the original value, it will leave every position alone, except it ensures the E_STRICT value is off, whether it was originally or whether this operation flipped it.

## Bitwise on your own

Let's say you want to take this information and use it on your own. First, you need to come up with values that don't interfere at a bit level with others. This is where binary is nice, but hex is even nicer. Each subsequent value needs to be twice the previous value. You can define these values in decimal of course, but it's also very common to see them defined in hex:

```
const VAL1 = 0x01;
const VAL2 = 0x02;
const VAL3 = 0x04;
const VAL4 = 0x08;
const VAL5 = 0x10;
const VAL6 = 0x20;
```

Doubling in binary and hex presents nicely. Almost no brain power is needed to determine the next value. This cannot be said about doubling in decimal.

The final bit to creating and using your own bitmaps is to determine how to extract a single value (or group of values) from a passed in value so you can make decisions.

Given an unknown integer value, you can test whether certain bits are set in the following way:

```
function isBitSet($incoming, $desiredBits)
{
	return ($incoming & $desiredBits) == $desiredBits;
}
```

Simple, right? We're pretty much saying to turn off all switches except the one or ones we care about and then check that the switches that are on are the same as the ones we care about.

## Conclusion

By building on concepts you already knew about counting, we've expanded that knowledge now out into other bases. You should now be able to convert from one base to another, understand at a glance what the numbers sent to chmod mean and have a rough idea of what an HTML/CSS color looks like just by seeing its hex code. You should also be able to create your own functions to deal with bitmaps and determine what flags have been passed into your function. If you didn't already know this, I hope I've removed most of the mystery around dealing with and using binary, octal, hexadecimal and other number bases.

> ### Biography
> David Stockton is a husband, father and Software Developer. He is VP of Technology at i3logix in Colorado leading a few teams of software developers building a very diverse array of web applications. He has two daughters, 11 and 9, who are learning to code JavaScript, Python, Scratch and PHP as well as building electrical circuits and a 3 year old son who has been seen studying calculus and recursive algorithms. David is an active proponent of TDD, APIs and elegant PHP.