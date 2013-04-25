<?php

class model_validate {
    /*
     * @Return true: admin is logged in, false otherwise.
     */
    public static function validation(){
        if (isset($_SESSION))
        {
            if (@$_SESSION['myshop']['account_type'] == "admin")
            {
                return true;
            }
        }
        return false;
    }

    public static function validate_array($params){
        foreach ($params as $key=>$value){
            if (empty($value)){
                return false;
            }
        }
        return true;
    }

}