<?php
namespace WCal;

class WorkoutData
{
    private $timestamp;
    private $value;

    public function __construct($timestamp, $value)
    {
        $this->timestamp = $timestamp;
        $this->value = $value;
    }

    public function __toString()
    {
        return $this->timestamp.','.$this->value;
    }
}
