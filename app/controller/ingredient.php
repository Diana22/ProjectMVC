<?php
@include_once __DIR__ . "../model/ingredient.php";
 * Created by JetBrains PhpStorm.
 * User: Andrada
 * Date: 4/18/13
 * Time: 11:08 AM
 * To change this template use File | Settings | File Templates.
 */
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