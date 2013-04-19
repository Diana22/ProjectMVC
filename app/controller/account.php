<?php
@include_once __DIR__ . "/../model/user.php";
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

    function action_created(){
        // Include view for this page.
        include_once APP_PATH . 'view/account_created.tpl.php';
    }

    /**
     * Logout action.
     */
    function action_logout() {
        // Unset session variable.
        session_destroy();

        // Redirect to login form.
        header('Location: ' . APP_URL . 'account/login');
        die;
    }

    function action_create(){
        if (isset($_POST['form'])){
            $account = model_account::create($_POST['form']['user'], $_POST['form']['password'], $_POST['form']['0']);
            model_client::create($account->id, $_POST['form']['name'], $_POST['form']['address'], $_POST['form']['phone']);
            header('Location:' . APP_URL . 'account/login');
            die;
        }
        @include_once APP_PATH . 'view/account_create.tpl.php';
    }
}