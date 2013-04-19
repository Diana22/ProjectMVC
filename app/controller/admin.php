<?php
class controller_admin {

    public static function action_ingredients()
    {
        $ingredients = model_ingredient::get_all();
        include APP_PATH . 'view/admin_ingredients.tpl.php';
    }
}
