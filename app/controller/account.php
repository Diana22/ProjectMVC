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
            $account = new model_account();
            $account_id = $account->validate($_POST['form']['user'], $_POST['form']['password']);
            if (isset($account_id))
            {
                $_SESSION['myshop']['account_id'] = $account_id;
                if ($account_id == 1) {
                    // Account is admin.
                    header('Location: ' . APP_URL . 'admin');
                    die;
                }
                if ($account_id == 0) {
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
}