<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Andrada
 * Date: 4/17/13
 * Time: 10:29 AM
 * To change this template use File | Settings | File Templates.
 */
class controller_cake
{
    public function  action_list($params) {
        $cakes = model_cake::get_all();

        // Include view for this page
        @include_once APP_PATH . 'view/cake_list.tpl.php';
    }

    /*
     * View a specific cake.
     */
    public function action_view($params)
    {

        $cake = model_cake::load_by_id($params[0]);

        @include_once APP_PATH . 'view/cake_view.tpl.php';
    }


    public function action_deleted()
    {
        // Include view for this page
        @include_once APP_PATH . 'view/cake_deleted.tpl.php';

    }

    /*
     * Delete a specific cake by id.
     */
    public function action_delete($params)
    {
        @include_once APP_PATH . 'model/cake.php';
        $cake = model_cake::load_by_id($params[0]);
        if ($cake->delete()){
            header('Location:' . APP_URL . 'cake/deleted');
        }
    }
}
