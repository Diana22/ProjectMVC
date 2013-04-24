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
     * Returns true if there is and admin logged in.
     */
    public static function validation(){
        if (isset($_SESSION) && $_SESSION['myshop']['account_type'] == "admin"){
            return true;
        }
        return false;
    }

}