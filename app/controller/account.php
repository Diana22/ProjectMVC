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
            $account = model_account::load_by_id($account_id);
            if ($account_id)
            {
                $_SESSION['myshop']['account_id'] = $account_id;
                if ($account->type == 1) {
                    // Account is admin.
                    header('Location: ' . APP_URL . 'admin');
                    die;
                }
                if ($account->type == 0) {
                    // Account is client.
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
    function action_logout($params) {
        // Unset session variable.
        unset($_SESSION['myshop']['account_id']);
        // Redirect to login form.
        header('Location: ' . APP_URL . 'account/login');
        die;
    }
}