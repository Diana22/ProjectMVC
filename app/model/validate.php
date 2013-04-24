<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Vyktor
 * Date: 24.04.2013
 * Time: 14:48
 * To change this template use File | Settings | File Templates.
 */

class model_validate {
    /*
     * @Return true: admin is logged in, false otherwise.
     */
    public static function validation(){
        if (isset($_SESSION) && $_SESSION['myshop']['account_type'] == "admin"){
            return true;
        }
        return false;
    }

}