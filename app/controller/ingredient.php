<?php
@include_once "../model/ingredient.php";
class controller_ingredient {

    function action_updated($params) {
        include APP_PATH . 'view/ingredient_updated.tpl.php';
    }

    function action_edit($params) {
        $e = $params[0];
        $ingredient = model_ingredient::load_by_id($e);
        $form_error = FALSE;
        if (isset($_POST['form']['action'])) {
            $ingredient->edit($_POST['form']['name']);
            header('Location: ' . APP_URL . 'ingredient/updated');
            $form_error = TRUE;
        }
        include APP_PATH . 'view/ingredient_edit.tpl.php';

    }

    function action_added($params) {
        include APP_PATH . 'view/ingredient_added.tpl.php';
    }

    function action_add($params) {
        $ingredient = new model_ingredient();
        $form_error = FALSE;
        if (isset($_POST['form']['action'])) {
            $ingredient->create($_POST['form']['name']);
            header('Location:' .APP_URL . 'ingredient/updated');
            $form_error = TRUE;
        }
        include APP_PATH . 'view/ingredient_add.tpl.php';
    }


}
