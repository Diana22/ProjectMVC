<?php

class controller_about {


    function action_index($params) {
        // Include view for this page
        @include_once APP_PATH . 'view/about_index.tpl.php';
    }
}
