<?php
class controller_cake
{
    function action_list($params)
    {
        $cakes = model_cake::get_all();
        // Include view for this page
        @include_once APP_PATH . 'view/cake_list.tpl.php';
    }

    /*
     * View a specific cake.
     */
    function action_view($params)
    {
        @include_once APP_PATH . 'model/cake.php';
        $cake = model_cake::load_by_id($params[0]);
        @include_once APP_PATH . 'view/cake_view.tpl.php';
    }

    function action_deleted($params)
    {
        // Include view for this page
        @include_once APP_PATH . 'view/cake_deleted.tpl.php';

    }

    function action_updated($params)
    {
        // Include view for this page
        @include_once APP_PATH . 'view/cake_updated.tpl.php';

    }

    function action_edit($params)
    {
        @include_once APP_PATH . 'model/cake.php';
        $cake = model_cake::load_by_id($params[0]);

        $form_error = FALSE;
        if (isset($_POST['form']['action'])) {
            $cake->update($_POST['form']['name'], $_POST['form']['price'], $_POST['form']['weight'], $_POST['form']['calories'],
                $_POST['form']['quantity']);
            header('Location: ' . APP_URL . 'cake/updated');
            die;
        }
        $form_error = TRUE;

        @include APP_PATH . 'view/cake_edit.tpl.php';

    }

    /*
     * Delete a specific cake by id.
     */
    function action_delete($params)
    {
        $cake = model_cake::load_by_id($params[0]);
        if ($cake->delete()){
            header('Location:' . APP_URL . 'cake/deleted');
        }
    }

    /*
     * Add a cake.
     */
    function action_add($params){
        if (isset($_POST['form'])){
            model_cake::create($_POST['form']['name'], $_POST['form']['price'], $_POST['form']['weight'], $_POST['form']['calories'], $_POST['form']['quantity']);
            header('Location:' . APP_URL . 'cake/added');
            die;
        }
        @include_once APP_PATH . "view/cake_add.tpl.php";
    }

    /*
     * Confirms the addition of a cake.
     */
    function action_added($params){
        @include_once APP_PATH . "view/cake_added.tpl.php";
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
