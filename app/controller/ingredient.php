<?php
@include_once __DIR__ . "../model/ingredient.php";
/**
 * Created by JetBrains PhpStorm.
 * User: Andrada
 * Date: 4/18/13
 * Time: 11:08 AM
 * To change this template use File | Settings | File Templates.
 */

class controller_ingredient
{
    public function  action_deleted($params)
    {
        // Include view for this page
        @include_once APP_PATH . 'view/ingredient_deleted.tpl.php';
    }

    public function action_delete($params){

        $ingredient = model_ingredient::load_by_id($params[0]);

        //Check if form was submitted.
        if (isset($_POST['form']['action'])) {
            $ingredient->delete();
            header('Location: ' . APP_URL . 'ingredient/deleted');
        }
        // Include view for this page.
        @include_once APP_PATH . 'view/ingredient_delete.tpl.php';
    }
}