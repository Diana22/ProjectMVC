<?php
@include_once "../model/ingredient.php";
class controller_ingredient
{

    /**
     * Redirects us to the file that creates the updated ingredient confirmation page.
     * @param $params
     */
    function action_updated($params)
    {
        include APP_PATH . 'view/ingredient_updated.tpl.php';
    }

    /**
     * Redirects us to the file that creates the edit ingredient confirmation page.
     * @param $params
     */
    function action_edit($params)
    {
        $e = $params[0];
        $ingredient = model_ingredient::load_by_id($e);
        if (isset($_POST['form']['action'])){
            model_ingredient::validate($_POST['form']['name']);
            if ($_SESSION['form']['error'] == 0) {
                $ingredient->edit($_POST['form']['name']);
                header('Location: ' . APP_URL . 'ingredient/updated');
                die;
            }
        }
        include APP_PATH . 'view/ingredient_edit.tpl.php';

    }

    /**
     * Redirects us to the file that creates the added ingredient confirmation page.
     * @param $params
     */
    function action_added($params)
    {
        include APP_PATH . 'view/ingredient_added.tpl.php';
    }

    /**
     * This function allows us to add a new ingredient.
     * @param $params
     */
    function action_add($params)
    {
        $ingredient = new model_ingredient();
        if (isset($_POST['form']['action'])){
            model_ingredient::validate($_POST['form']['name']);
            if ($_SESSION['form']['error'] == 0) {
                $ingredient->create($_POST['form']['name']);
                header('Location:' . APP_URL . 'ingredient/updated');
                die;
            }
        }
        include APP_PATH . 'view/ingredient_add.tpl.php';
    }


}
