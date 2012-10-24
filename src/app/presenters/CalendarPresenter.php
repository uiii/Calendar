<?php

class CalendarPresenter extends BasePresenter
{
    private $year = 2012; // TODO

    public function renderMonth($monthNumber)
    {
        $previousMonthNumber = $monthNumber == 1 ? 12 : $monthNumber - 1;
        $previousDaysCount = cal_days_in_month(CAL_GREGORIAN, $previousMonthNumber, $this->year);
        $daysCount = cal_days_in_month(CAL_GREGORIAN, $monthNumber, $this->year);

        $firstDay = date("N", mktime(0, 0, 0, $monthNumber, 1, $this->year)) - 1;

        $days = array();
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

            $days[] = array(
                'is-another-month' => $isAnotherMonth,
                'number' => $dayNumber,
                'name' => strftime("%a", mktime(0, 0, 0, $monthNumber, $dayNumber, $this->year))
            );
        }

        $this->template->days = $days;
    }
}
