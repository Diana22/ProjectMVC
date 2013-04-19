<?php
class controller_cake
{
    public function action_list($params)
    {
        $cake = model_cake::load_by_id($params[0]);
        $cakes = model_cake::get_all();
        // Include view for this page
        @include_once APP_PATH . 'view/cake_list.tpl.php';
    }

    /*
     * View a specific cake.
     */
    public function action_view($params)
    {
        @include_once APP_PATH . 'model/cake.php';
        $cake = model_cake::load_by_id($params[0]);
        @include_once APP_PATH . 'view/cake_view.tpl.php';
    }


    public function action_deleted()
    {
        // Include view for this page
        @include_once APP_PATH . 'view/cake_deleted.tpl.php';

    }

    public function action_edit($params)
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
    public function action_delete($params)
    {
        @include_once APP_PATH . 'model/cake.php';
        $cake = model_cake::load_by_id($params[0]);
        if ($cake->delete()){
            header('Location:' . APP_URL . 'cake/deleted');
        }
    }
}
