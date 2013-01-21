<?php

class CalendarPresenter extends BasePresenter
{
    public function renderYear($yearNumber)
    {
        $year = new Year($yearNumber);

        $this->template->year = $year;
    }

    public function renderMonth($yearNumber, $monthNumber)
    {
        $year = new Year($yearNumber);
        $month = $year->getMonth($monthNumber);

        $firstDay = $month->getDay(1);
        $lastDay = $month->getDay(-1);

        $daysBefore = $month->getPrevious()->getDays(1 - $firstDay->numberInWeek);
        $daysAfter = $month->getNext()->getDays(1, 7 - $lastDay->numberInWeek);

        $days = array_merge($daysBefore, $month->getDays(), $daysAfter);


        /*$previousMonthNumber = $monthNumber > 1 ? $monthNumber - 1 : 12;
        $previousDaysCount = cal_days_in_month(CAL_GREGORIAN, $previousMonthNumber, $yearNumber);
        $daysCount = cal_days_in_month(CAL_GREGORIAN, $monthNumber, $this->year);

        $firstDay = date("N", mktime(0, 0, 0, $monthNumber, 1, $this->year)) - 1;

        $daysRow = array();
        for($i = 0; $i < $firstDay; ++$i)
        {
            $days[] = array(
                'is-another-month' => true,
                'number' => $previousDaysCount - $firstDay + $i,
                'name' => ""
            );
        }

        for($i = 0; $i < $daysCount; ++$i)
        {
            $days[] = new Day($previousDaysCount - $firstDay + $i, $monthNumber, $year);
        }

        for($i = 0; $i < 35; ++$i)
        {
            $dayNumber = $i - $firstDay;
            $isAnotherMonth = false;

            if($dayNumber < 0)
            {
                $dayNumber += $previousDaysCount;
                $isAnotherMonth = true;
            }
            else if($dayNumber >= $daysCount)
            {
                $dayNumber -= $daysCount;
                $isAnotherMonth = true;
            }

            $dayNumber += 1;

            $daysRow[] = array(
                'is-another-month' => $isAnotherMonth,
                'number' => $dayNumber,
                'name' => ""
            );

            if($i % 7 == 0)
            {
                $days[] = $daysRow;
                $daysRow = array();
            }
        }*/

        $this->template->month = $month;
        $this->template->days = $days;
    }

    public function renderDay($yearNumber, $monthNumber, $dayNumber)
    {

    }
}
