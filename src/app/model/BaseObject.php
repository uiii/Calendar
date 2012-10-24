<?php

class BaseObject
{
    private $properties = array();
    private $isPropertyMutable = array();

    public function __get($property)
    {
        if(! isset($this->properties[$property]))
        {
            trigger_error("Undefined property: " . get_class($this) . "::$" . $property, E_USER_ERROR);
        }

        $getMethod = "get" . ucfirst($property);
        if(method_exists($this, $getMethod))
        {
            return call_user_func(array($this, $getMethod));
        }
        else
        {
            return $this->properties[$property];
        }
    }

    public function __set($property, $value)
    {
        if(! isset($this->properties[$property]))
        {
            trigger_error("Undefined property: " . get_class($this) . "::$" . $property, E_USER_ERROR);
        }

        if(! $this->isPropertyMutable[$property])
        {
            trigger_error("Property: " . get_class($this) . "::$" . $property . " is not mutable", E_USER_ERROR);
        }

        $setMethod = "set" . ucfirst($property);
        if(method_exists($this, $setMethod))
        {
            return call_user_func(array($this, $setMethod), $value);
        }
        else
        {
            return $this->properties[$property] = $value;
        }
    }

    protected function addProperty($property, $defaultValue = null, $isMutable = true)
    {
        if(isset($this->properties[$property]))
        {
            trigger_error("Property " . get_class($this) . "::$" . $property . " already defined", E_USER_ERROR);
        }

        $this->properties[$property] = $defaultValue;
        $this->isPropertyMutable[$property] = $isMutable;
    }

    protected function updateProperty($property, $value, $isMutable = null)
    {
        if(! isset($this->properties[$property]))
        {
            trigger_error("Undefined property: " . get_class($this) . "::$" . $property, E_USER_ERROR);
        }

        $this->properties[$property] = $value;

        if(! is_null($isMutable))
        {
            $this->isPropertyMutable[$property] = $isMutable;
        }
    }

    protected function getProperty($property)
    {
        if(! isset($this->properties[$property]))
        {
            trigger_error("Undefined property: " . get_class($this) . "::$" . $property, E_USER_ERROR);
        }

        return $this->properties[$property];
    }
}
