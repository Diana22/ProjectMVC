<?php
@include_once "../model/ingredient.php";
class controller_adminn {

    public static function action_ingredients()
    {
        $ingredients = model_ingredient::get_all();
        include APP_PATH . 'view/admin_ingredients.tpl.php';
    }
}
