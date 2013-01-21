<?php

class Day extends BaseObject
{
    public function __construct($dayNumber, $month)
    {
        $this->addProperty('number', $dayNumber, false);
        $this->addProperty('month', $month, false);

        $time = mktime(0, 0, 0, $month->number, $this->number, $month->year->number);
        $this->addProperty('nameInWeek', strftime("%a", $time));
        $this->addProperty('numberInWeek', (int) strftime("%u", $time));
    }

    public function __toString()
    {
        return $this->number;
    }
}
