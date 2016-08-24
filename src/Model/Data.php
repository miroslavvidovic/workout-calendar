<?php

namespace WCal\Model;

use League\Csv\Reader;
use League\Csv\Writer;
use WCal\Model\WorkoutData;
use DateTime;
/**
 * Description of Data
 *
 * @author miroslav
 */
class Data
{
    private $data_file = __DIR__."/../data/data.csv";
    
    public function write(){
        if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "POST"){
            $timestamp = filter_input(\INPUT_POST, 'timestamp', FILTER_SANITIZE_STRING);
            $value = filter_input(\INPUT_POST, 'value', FILTER_SANITIZE_NUMBER_INT);
        }

        $date = DateTime::createFromFormat('d.m.Y', $timestamp);
        $timestamp = $date->getTimestamp();

        $writer = Writer::createFromPath($this->data_file, 'a+');

        $writer->insertOne(new WorkoutData($timestamp, $value));

        // Redirect to home after saving the data
        header('Location: /');
    }
    
    public function readAll(){
        $reader = Reader::createFromPath($this->data_file);
        $results = $reader->fetch();
        return $results;
    }
    
    public function readOne($row_num){
        $reader = Reader::createFromPath($this->data_file);
        $result = $reader->fetchOne($row_num);
        return $result;
    }
    
    public function update(){
        if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "POST"){
            $id = filter_input(\INPUT_POST, 'id', FILTER_SANITIZE_STRING);
            $new_timestamp = filter_input(\INPUT_POST, 'timestamp', FILTER_SANITIZE_STRING);
            $new_value = filter_input(\INPUT_POST, 'value', FILTER_SANITIZE_NUMBER_INT);
        }
        $date = DateTime::createFromFormat('d.m.Y', $new_timestamp);
        $new_timestamp = $date->getTimestamp();
        // all the data
        $results = $this->readAll();
        
        $rows = array();
        foreach ($results as $key => $value) {
            if (($key == $id)){
                $value[0] = $new_timestamp;
                $value[1] = $new_value;
            }
            array_push($rows, $value[0].','.$value[1]);

        }
        $writer = Writer::createFromPath($this->data_file, 'w+');
        $writer->insertAll($rows); 
        
        header('Location: /data/');
    }
    
    public function delete($id){
        $results = $this->readAll();

        $rows = array();
        foreach ($results as $key => $value) {
            if (!($key == $id)){
                array_push($rows, $value[0].','.$value[1]);
            }
        }
        
        $writer = Writer::createFromPath($this->data_file, 'w+');
        $writer->insertAll($rows); 
        
        header('Location: /data/');
    }
}