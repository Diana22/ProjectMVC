<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Andrada
 * Date: 4/17/13
 * Time: 10:29 AM
 * To change this template use File | Settings | File Templates.
 */
include_once 'C:/wamp/www/cakestore/app/model/cake.php';
class controller_cake
{
    public static function  action_list()
    {
        // Include view for this page
        $cakes = model_cake::get_all();
        @include_once APP_PATH . 'view/cake_list.tpl.php';
        return $cakes;
        //$cakes = model_cake::get_all();
        //var_dump($cakes);
    }
}