<?php
include_once "../model/ingredient.php";
class Controller {

    public static function action_ingredients()
    {
        $ingredients = model_ingredient::get_all();
        @include APP_PATH . 'view/admin_ingredients.tpl.php';
        return $ingredients;
        //var_dump($ingredients);
    }
}
