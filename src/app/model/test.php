<?php

require('BaseObject.php');

class Test extends BaseObject
{
    public function __construct()
    {
        $this->addProperty("prop", 5, true);
    }

    public function getProp()
    {
        return $this->getProperty('prop') * 2;
    }

    public function setProp($value)
    {
        $this->updateProperty('prop', $value + 10);
    }
}

$test = new Test;
echo $test->prop;
$test->prop = 4;
echo $test->prop;
