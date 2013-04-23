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
}