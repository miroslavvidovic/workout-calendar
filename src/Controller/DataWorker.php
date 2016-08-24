<?php

namespace WCal\Controller;

use WCal\Model\Data;
/**
 * Description of DataWorker
 *
 * @author miroslav
 */
class DataWorker
{
    private $data;
    
    public function __construct()
    {
        $this->data = new Data();
    }
    
    function saveData(){
        $this->data->write();
    }
    
    function deleteData($id){
        $this->data->delete($id);
    }
    
    function selectOne($id){
        $res = $this->data->readOne($id);
        return $res;
    }
    
    function update(){
        $this->data->update();
    }
}
