<?php

class controller_account
{

    /**
     * Login page.
     */
    function action_login($params)
    {
        // If the form was submitted, validate credentials.
        $form_error = FALSE;
        if (isset($_POST['form']['action'])) {
            $account_id = model_account::validate($_POST['form']['user'], $_POST['form']['password']);
            if ($account_id)
            {
                $account = model_account::load_by_id($account_id);
                $_SESSION['myshop']['account_id'] = $account_id;
                if ($account->type == 1) {
                    // Account is admin.
                    $_SESSION['myshop']['account_type'] = "admin";
                    header('Location: ' . APP_URL . 'admin');
                    die;
                }
                if ($account->type == 0) {
                    // Account is client.
                    $_SESSION['myshop']['account_type'] = "client";
                    header('Location: ' . APP_URL);
                    die;
                }
            }
            $form_error = TRUE;
        }
        // Include view for this page.
        include_once APP_PATH . 'view/account_login.tpl.php';
    }

    function action_created($params){
        // Include view for this page.
        include_once APP_PATH . 'view/account_created.tpl.php';
    }

    /**
     * Logout action.
     */
    function action_logout($params) {
        // Unset session variable.
        session_destroy();

        // Redirect to login form.
        header('Location: ' . APP_URL . 'account/login');
        die;
    }

    function action_create($params){
        if (isset($_POST['form'])){
            $account = model_account::create($_POST['form']['user'], $_POST['form']['password'], $_POST['form']['type']);
            model_client::create($account->id, $_POST['form']['name'], $_POST['form']['address'], $_POST['form']['phone']);
            header('Location:' . APP_URL . 'account/created');
            die;
        }
        @include_once APP_PATH . 'view/account_create.tpl.php';
    }

    function action_updated($params) {
        // Include view for this page
        @include_once APP_PATH . 'view/account_updated.tpl.php';

    }

    function action_edit($params)
    {
        @include_once APP_PATH . '/model/account.php';
        $account = model_account::load_by_id($params[0]);

        if (isset($_POST['form']['action'])) {
            $account->update($_POST['form']['username'], $_POST['form']['pass'], $_POST['form']['type']);
            header('Location: ' . APP_URL . 'account/updated/');

        }
        @include APP_PATH . 'view/account_edit.tpl.php';

    }

    function action_view($params)
    {
        $id = $_SESSION['myshop']['account_id'];
        $account = model_account::load_by_id($id);
        $client = model_client::load_by_account_id($id);

        @include_once APP_PATH . 'view/account_view.tpl.php';
    }
}