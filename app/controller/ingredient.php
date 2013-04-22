<?php
@include_once "../model/ingredient.php";
class controller_ingredient {

    public static function action_updated() {
        include APP_PATH . 'view/ingredient_updated.tpl.php';
    }

    public function action_edit($params) {
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

    public function action_added() {
        include APP_PATH . 'view/ingredient_added.tpl.php';
    }

    public function action_add($params) {
        $ingredient = new model_ingredient();
        $form_error = FALSE;
        if (isset($_POST['form']['action'])) {
            $ingredient->create($_POST['form']['name']);
            header('Location:' .APP_URL . 'ingredient/updated');
            $form_error = TRUE;
        }
        include APP_PATH . 'view/ingredient_add.tpl.php';
    }

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
