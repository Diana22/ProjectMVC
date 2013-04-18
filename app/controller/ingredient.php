<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Andrada
 * Date: 4/18/13
 * Time: 11:08 AM
 * To change this template use File | Settings | File Templates.
 */

class controller_ingredient
{
    public static function  action_deleted($params)
    {
        // Include view for this page
        @include_once APP_PATH . 'view/ingredient_deleted.tpl.php';
    }
}