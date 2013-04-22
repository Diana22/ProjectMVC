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
        $client = model_client::load_by_id($account_id);
        $form_error = FALSE;
        if (isset($_POST['form']['action'])) {
            $client->update($_POST['form']['name'], $_POST['form']['address'], $_POST['form']['phone'], $_POST['form']['account_id']);
            header('Location: ' . APP_URL . 'client/updated');
            $form_error = TRUE;
        }
        include APP_PATH . 'view/client_edit.tpl.php';
    }
}