<?php
class client {
    public function action_updated($params)
    {
        // Include view for this page
        include_once APP_PATH . 'view/client_updated.tpl.php';
    }
}