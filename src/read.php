<?php
require_once __DIR__ . "/../vendor/autoload.php";
use League\Csv\Reader;

$reader = Reader::createFromPath('../data.csv');
$results = $reader->fetch();
foreach ($results as $row) {
    echo $row[0];
    echo "--";
    echo $row[1];
    echo "--";
}
