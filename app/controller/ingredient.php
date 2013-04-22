<?php
@include_once __DIR__ . "../model/ingredient.php";
class controller_ingredient
{
    public function  action_deleted($params)
    {
        // Include view for this page
        @include_once APP_PATH . 'view/ingredient_deleted.tpl.php';
    }

    public function action_delete($params){

        //Check if form was submitted.
        if (isset($_POST['form']['action'])) {
            $ingredient = model_ingredient::load_by_id($_POST['form']['ingredient']['id']);
            $ingredient->delete();
            header('Location: ' . APP_URL . 'ingredient/deleted');
        }
        else
        {
            $ingredient = model_ingredient::load_by_id($params[0]);

        }
        // Include view for this page.
        @include_once APP_PATH . 'view/ingredient_delete.tpl.php';
    }
}