<?php namespace Garbee\TranslateCron;

use Garbee\TranslateCron\Exceptions\InvalidExpression;

class Cron
{
    /**
     * @var string
     */
    protected $minutes;

    /**
     * @var string
     */
    protected $hours;

    /**
     * @var string
     */
    protected $daysOfMonth;

    /**
     * @var string
     */
    protected $months;

    /**
     * @var string
     */
    protected $daysOfWeek;

    /**
     * @var string|null
     */
    protected $years;

    protected $dayMapping = [
        '*' => 'Every day',
        '0' => 'Sunday',
        '1' => 'Monday',
        '2' => 'Tuesday',
        '3' => 'Wednesday',
        '4' => 'Thursday',
        '5' => 'Friday',
        '6' => 'Saturday'
    ];

    protected $monthMapping = [
        '*'  => 'Every month',
        '1'  => 'January',
        '2'  => 'February',
        '3'  => 'March',
        '4'  => 'April',
        '5'  => 'March',
        '6'  => 'June',
        '7'  => 'July',
        '8'  => 'August',
        '9'  => 'September',
        '10' => 'October',
        '11' => 'November',
        '12' => 'December'
    ];

    /**
     * @param string $expression
     */
    public function __construct($expression)
    {
        $places = explode(' ', trim($expression));
        if (count($places) < 5 || count($places) > 6) {
            throw new InvalidExpression;
        }
        $this->minutes = $places[0];
        $this->hours = $places[1];
        $this->daysOfMonth = $places[2];
        $this->months = $places[3];
        $this->daysOfWeek = $places[4];
        $this->years = '*';
        if (isset($places[5])) {
            $this->years = $places[5];
        }
    }

    /**
     * Get the years the job executes on.
     *
     * @return array
     */
    public function years()
    {
        $years = explode(',', $this->years);
        if ($years[0] === '*') {
            return $this->returnFrame('year');
        }
        if ($this->isRecurring($years[0])) {
            return $this->returnFrame('years', explode('/', $years[0])[1]);
        }
        if ($this->isRange($years[0])) {
            return $this->returnFrame('years', $years[0]);
        }
        return $years;
    }


    /**
     * Get the days of the month the job executes on.
     *
     * @return array
     */
    public function daysOfMonth()
    {
        $days = explode(',', $this->daysOfMonth);
        if ($days[0] === '*') {
            return $this->returnFrame('day of the month');
        }
        if ($this->isRecurring($days[0])) {
            return $this->returnFrame('days of the month', explode('/', $days[0])[1]);
        }
        if ($this->isRange($days[0])) {
            return $this->returnFrame('days of the month', $days[0]);
        }
        return $days;
    }


    /**
     * Get the days of the week the job executes on.
     *
     * @return array
     */
    public function daysOfWeek()
    {
        $days = explode(',', $this->daysOfWeek);
        if ($days[0] === '*') {
            return $this->returnFrame('day of the week');
        }
        if ($this->isRecurring($days[0])) {
            return [];
        }
        if ($this->isRange($days[0])) {
            return $this->returnFrame('days of the week', $days[0]);
        }
        return array_map(function ($day) {
            return $this->dayMapping[$day];
        }, $days);
    }

    /**
     * Get the months the job executes on.
     *
     * @return array
     */
    public function months()
    {
        $months = explode(',', $this->months);
        if ($this->isRecurring($months[0])) {
            return $this->returnFrame('months', explode('/', $months[0])[1]);
        }
        if ($this->isRange($months[0])) {
            return $this->returnFrame('months', $months[0]);
        }
        return array_map(function ($month) {
            return $this->monthMapping[$month];
        }, $months);
    }

    /**
     * Get the hours of the day the job executes on.
     *
     * @return array
     */
    public function hours()
    {
        $hours = explode(',', $this->hours);
        if ($hours[0] === '*') {
            return $this->returnFrame('hour');
        }
        if ($this->isRecurring($hours[0])) {
            return $this->returnFrame('hours', explode('/', $hours[0])[1]);
        }
        if ($this->isRange($hours[0])) {
            return $this->returnFrame('hours', $hours[0]);
        }
        return $hours;
    }

    /**
     * Get the minutes of the hour the job executes on.
     *
     * @return array
     */
    public function minutes()
    {
        $minutes = explode(',', $this->minutes);
        if ($minutes[0] === '*') {
            return $this->returnFrame('minute');
        }
        if ($this->isRecurring($minutes[0])) {
            return $this->returnFrame('minutes', explode('/', $minutes[0])[1]);
        }
        if ($this->isRange($minutes[0])) {
            return $this->returnFrame('minutes', $minutes[0]);
        }
        return $minutes;
    }

    /**
     * Decide if the given time is a recurring task.
     *
     * @param string $time
     *
     * @return boolean
     */
    protected function isRecurring($time)
    {
        return (bool)strstr($time, '/');
    }

    /**
     * Decide if the given time is a range.
     *
     * @param string $time
     *
     * @return boolean
     */
    protected function isRange($time)
    {
        return (bool)strstr($time, '-');
    }


    /**
     * Morph the given frame into an array for the calling process.
     *
     * @param string $frame
     * @param string $interval
     *
     * @return array
     */
    protected function returnFrame($frame, $interval = null)
    {
        if ($interval) {
            return ["Every $interval $frame"];
        }
        return ["Every $frame"];
    }
}
