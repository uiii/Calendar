<?php

class Month extends BaseObject
{
    public function __construct($monthNumber, Year $year)
    {
        $this->addProperty('number', $monthNumber, false);
        $this->addProperty('year', $year, false);

        $daysCount = cal_days_in_month(CAL_GREGORIAN, $monthNumber, $year->number);
        $this->addProperty('daysCount', $daysCount, false);

        $this->addProperty('name', strftime("%B", mktime(0,0,0,$monthNumber,1)));
    }

    /**
     * Get array of $daysCount days of month
     * starting from $startDayNumber
     * 
     * @param integer $startDayNumber
     *     If positive (up to the month day count),
     *     the sequence will start with this day in month.
     *     If negative (down to the minus month day count),
     *     the sequence will start with the day that far from the end of month.
     *     If zero or out of range, empty array is returned.
     *     
     * @param integer $dayCount
     *     If positive, then the sequence will have up to that many days in it.
     *     If the month day count is shorter than that, then only the available
     *     days will be returned.
     *     If negative then the sequence will stop that many days from the end
     *     of the month.
     *     If null or ommited, then the sequence will all days
     *     from $startDayNumber up to the end of the month.
     * 
     * @return array of \Day
     */
    public function getDays($startDayNumber = 1, $daysCount = null)
    {
        if($startDayNumber == 0 || abs($startDayNumber) > $this->daysCount)
        {
            return array();
        }
        elseif($startDayNumber < 0)
        {
            $startDayNumber = $this->daysCount + $startDayNumber + 1;
        }

        if($daysCount === null || $startDayNumber + $daysCount - 1 > $this->daysCount)
        {
            $daysCount = $this->daysCount - $startDayNumber + 1;
        }
        elseif($daysCount < 0)
        {
            $daysCount = $this->daysCount - $startDayNumber + $daysCount + 1;
        }

        $days = array();
        for($dayNumber = $startDayNumber; $dayNumber < $startDayNumber + $daysCount; ++$dayNumber)
        {
            $days[] = new Day($dayNumber, $this);
        }

        return $days;
    }

    /**
     * Get the days of month
     * 
     * @param type $dayNumber
     *     If positive (up to the month day count),
     *     this day in month is returned.
     *     If negative (down to the minus month day count),
     *     the day that far from the end of month is returned.
     *     If zero or out of range then \Nette\OutOfRangeException is thrown.
     * 
     * @return \Day
     */
    public function getDay($dayNumber)
    {
        if($dayNumber == 0 || abs($dayNumber) > $this->daysCount)
        {
            throw new \Nette\OutOfRangeException();
        }
        elseif($dayNumber < 0)
        {
            $dayNumber = $this->daysCount + $dayNumber + 1;
        }

        return new Day($dayNumber, $this);
    }

    public function getPrevious()
    {
        $previousMonth = null;

        if($this->number == 1)
        {
            $previousMonth = new Month(12, $this->year->getPrevious());
        }
        else
        {
            $previousMonth = new Month($this->number - 1, $this->year);
        }

        return $previousMonth;
    }

    public function getNext()
    {
        $nextMonth = null;

        if($this->number == 12)
        {
            $nextMonth = new Month(1, $this->year->getNext());
        }
        else
        {
            $nextMonth = new Month($this->number + 1, $this->year);
        }

        return $nextMonth;
    }

    public function __toString()
    {
        return $this->name;
    }
}
