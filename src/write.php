<?php
require_once __DIR__ ."/../vendor/autoload.php";
use League\Csv\Writer;
use WCal\WorkoutData as WorkoutData;

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "POST"){
  $timestamp = filter_input(\INPUT_POST, 'timestamp', FILTER_SANITIZE_STRING);
  $value = filter_input(\INPUT_POST, 'value', FILTER_SANITIZE_NUMBER_INT);
}

$date = DateTime::createFromFormat('d.m.Y', $timestamp);
$timestamp = $date->getTimestamp();

$writer = Writer::createFromPath('../data.csv', 'a+');

$writer->insertOne(new WorkoutData($timestamp, $value));
