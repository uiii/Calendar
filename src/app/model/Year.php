<?php

class Year extends BaseObject
{
    public function __construct($yearNumber)
    {
        $this->addProperty('number', $yearNumber, false);
    }

    public function getMonth($monthNumber)
    {
        return new Month($monthNumber, $this);        
    }

    public function getPrevious()
    {
        return new Year($this->number - 1);
    }

    public function getNext()
    {
        return new Year($this->number + 1);
    }

    public function __toString()
    {
        return $this->number;
    }
}