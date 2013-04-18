<?php
@include_once "../model/ingredient.php";
class controller_ingredient {

    public static function action_updated() {
        include APP_PATH . 'view/ingredient_updated.tpl.php';

    }
}