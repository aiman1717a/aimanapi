<?php
namespace App\CustomClass;

class Error{

    private $my_error = null;
    public function __construct(){
        $this->my_error = array(
            "create" => 'Insertion Failed',
            "read" => 'Invalid Data',
            "update" => 'Update Failed',
            "delete" => 'Deletion Failed',
        );
    }
    public function printCreateError($custom_string = null){
        if($custom_string !== null){
            return $custom_string;
        }
       return $this->my_error['create'];
    }
    function printReadError($custom_string = null){
        if($custom_string !== null){
            return $custom_string;
        }
        return $this->my_error['read'];
    }
    public function printUpdateError($custom_string = null){
        if($custom_string !== null){
            return $custom_string;
        }
        return $this->my_error['update'];
    }
    public function printDeleteError($custom_string = null){
        if($custom_string !== null){
            return $custom_string;
        }
        return $this->my_error['delete'];
    }
}
