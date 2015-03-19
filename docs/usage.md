# Using the Cron class
A single class `Cron` is provided.
When you construct a new object provide the cron expression as the only parameter.
Once you have an object, just call the methods covered here to get your desired results.
Only `array`s are returned. This allows you to combine and display the results however you wish.

## Creating an object
Create a new class giving it the expression to work with.

`$cron = new Garbee\TranslateCron\Cron('*/5, 9, *, 2, * *');`

## Get the days of the week
Call the `daysOfWeek` method.

`$cron->daysOfWeek();`

This will return:

`array('Tuesday')`

## Get the months
Call the `months` method.

`$cron->months();`

This will return:

`array('September')`

## Get the hours
Call the `hours` method.

`$cron->hours()`

This will return:

`array('9')`

## Get the minutes
Call the `minutes` method.

`$cron->minutes()`

This will return:

`array('Every 5 minutes')`
