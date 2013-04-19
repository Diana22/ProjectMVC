<?php
@include_once "../model/ingredient.php";
class controller_ingredient {

    public static function action_updated() {
        include APP_PATH . 'view/ingredient_updated.tpl.php';
    }

    public function action_edit($params) {
        $ingredient = model_ingredient::load_by_id($params[0]);
        $form_error = FALSE;
        if (isset($_POST['form']['action'])) {
            $ingredient->edit($_POST['form']['name']);
            header('Location: ' . APP_URL . 'ingredient/updated');
            $form_error = TRUE;
        }

        include APP_PATH . 'view/ingredient_edit.tpl.php';

    }
}
