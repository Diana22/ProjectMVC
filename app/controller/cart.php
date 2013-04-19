<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Andrada
 * Date: 4/19/13
 * Time: 1:13 PM
 * To change this template use File | Settings | File Templates.
 */

class controller_cart
{

    public function action_updated()
    {
        // Include view for this page
        @include_once APP_PATH . 'view/cart_updated.tpl.php';

    }

    public function action_added()
    {
        // Include view for this page
        @include_once APP_PATH . 'view/cart_added.tpl.php';
    }

}