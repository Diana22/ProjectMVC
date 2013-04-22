<?php
class controller_client {

    public function action_updated($params) {

        // Include view for this page
        include_once APP_PATH . 'view/client_updated.tpl.php';
    }

    public function action_notice($params) {

        // Include view for this page
        include_once APP_PATH . 'view/client_notice.tpl.php';
    }

    public function action_edit($params) {
        $account_id = $_SESSION['myshop']['account_id'];
        $client = model_client::load_by_account_id($account_id);
        $account = model_account::load_by_id($account_id);
        $form_error = FALSE;
        if (isset($_POST['form']['action'])) {
            $client->update($_POST['form']['name'], $_POST['form']['address'], $_POST['form']['phone'], $account_id);
            $account->update($_POST['form']['username'], $_POST['form']['pass'], $_POST['form']['type']);
            header('Location: ' . APP_URL . 'client/updated');
            $form_error = TRUE;
        }
        include APP_PATH . 'view/client_edit.tpl.php';
    }
}