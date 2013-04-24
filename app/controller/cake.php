<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Andrada
 * Date: 4/17/13
 * Time: 10:29 AM
 * To change this template use File | Settings | File Templates.
 */
class controller_cake
{
    public static function  action_list($params)
    {
        $cakes = model_cake::get_all();

        // Include view for this page
        @include_once APP_PATH . 'view/cake_list.tpl.php';
    }

    /*
     * View a specific cake.
     */
    public static function action_view($params)
    {

        $cake = model_cake::load_by_id($params[0]);

        @include_once APP_PATH . 'view/cake_view.tpl.php';
    }


    public function action_deleted()
    {
        // Include view for this page
        @include_once APP_PATH . 'view/cake_deleted.tpl.php';

    }

    public function action_updated()
    {
        // Include view for this page
        @include_once APP_PATH . 'view/cake_updated.tpl.php';

    }

    public function action_edit($params)
    {
        @include_once APP_PATH . 'model/cake.php';
        $cake = model_cake::load_by_id($params[0]);
        $ingredients2 = $cake->get_ingredients();

        if (isset($_POST['form']['action'])) {
            $cake->update($_POST['form']['name'], $_POST['form']['price'], $_POST['form']['weight'], $_POST['form']['calories'],
                $_POST['form']['quantity']);
            $ingredients1 = $_POST['form']['ingredient_id'];

            //Check if there is any new ingredient checked.
            foreach ($ingredients1 as $ingred) {
                $bool = false;
                foreach ($ingredients2 as $ingredient) {
                    if ($ingred == $ingredient->id) {
                        $bool = true;
                    }
                }
                if (!$bool) {

                    $cake->add_ingredient($ingred);
                }
            }

            //Check if there is any ingredient was unchecked.
            foreach ($ingredients2 as $ingredient) {
                $bool = false;
                foreach ($ingredients1 as $ingred) {
                    if ($ingred === $ingredient->id) {
                        $bool = true;
                    }
                }
                if (!$bool) {
                    $cake->delete_ingredient($ingredient->id);
                }
            }

            header('Location: ' . APP_URL . 'cake/updated/');
            die;
        }

        @include APP_PATH . 'view/cake_edit.tpl.php';

    }


    public function action_add($params)
    {
        @include_once APP_PATH . 'model/cake.php';
        $cake = new model_cake;

        if (isset($_POST['form']['action'])) {
            $cake->create($_POST['form']['name'], $_POST['form']['price'], $_POST['form']['weight'], $_POST['form']['calories'],
                $_POST['form']['quantity']);
            header('Location: ' . APP_URL . 'cake/added/');
            die;
        }

        @include APP_PATH . 'view/cake_created.tpl.php';

    }
	
	public function action_search() {
        $cakes = array();
        if(isset($_POST['form']['action'])) {
            $name = $_POST['form']['name'];
            $cakes = model_cake::search_by_ingredient($name);
            @include_once APP_PATH . 'view/cake_list.tpl.php';
            die;
        }
        @include APP_PATH .'view/cake_search.tpl.php';

    }
}
