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
        $form_error = FALSE;
        if (isset($_POST['form']['action']) && model_validate::validate_array($_POST['form'])) {
            $ingredient->edit($_POST['form']['name']);
            header('Location: ' . APP_URL . 'ingredient/updated');
        }
        elseif (isset($_POST['form']['action']) && !model_validate::validate_array($_POST['form'])){
            $form_error = TRUE;
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
        $form_error = FALSE;
        if (isset($_POST['form']['action']) && model_validate::validate_array($_POST['form'])) {
            $ingredient->create($_POST['form']['name']);
            header('Location:' . APP_URL . 'ingredient/updated');
        }
        elseif (isset($_POST['form']['action']) && !model_validate::validate_array($_POST['form'])){
            $form_error = TRUE;
        }
        include APP_PATH . 'view/ingredient_add.tpl.php';
    }


}
