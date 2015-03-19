<?php namespace Garbee\TranslateCron;

class TranslateCron
{

    /**
     * @var string The cron expression.
     */
    protected $expression;

    // Just a reminder array for the positions in the expression.
    private $cronMap = [
        0 => 'minute',
        1 => 'hour',
        2 => 'dayOfMonth',
        3 => 'month',
        4 => 'dayOfWeek',
        5 => 'year'
    ];

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

    public function __construct($expression = '* * * * * *')
    {
        $this->expression = $expression;
    }

    /**
     * @param string $expression
     *
     * Set the expression property.
     */
    public function expression($expression)
    {
        $this->expression = $expression;
    }

    /**
     * Get the days of the week the job executes on.
     *
     * @return array
     */
    public function daysOfWeek()
    {
        $days = explode(',', explode(' ', $this->expression)[4]);
        if ($this->isRecurring($days[0])) {
            return $this->returnFrame('days', explode('/', $days[0])[1]);
        }
        if ($this->isRange($days[0])) {
            return $this->returnFrame('days', $days[0]);
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
        $months = explode(',', explode(' ', $this->expression)[3]);
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
        $hours = explode(',', explode(' ', $this->expression)[1]);
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
        $minutes = explode(',', explode(' ', $this->expression)[0]);
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
