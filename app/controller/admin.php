<?php
/**
 * Controller for handling admin user actions: login etc.
 */
class controller_admin {

	/**
	 * Main admin page.
	 */
	function action_index($params) {

		// Admin must be logged in to access this page
		if (isset($_SESSION) && $_SESSION['myshop']['account_type'] != "admin") {
			header('Location: ' . APP_URL . 'account/login/');
			die;
		}

		// Include view for this page
		@include_once APP_PATH . 'view/admin_index.tpl.php';
	}

	/**
	 * Lists ingredients.
	 */
	function action_ingredients($params) {

		$ingredients = model_ingredient::get_all();

		// Include view for this page
		@include_once APP_PATH . 'view/admin_ingredients.tpl.php';
	}

    function action_orders($params)
    {
        $orders = model_order::get_all();
        @include APP_PATH . 'view/admin_orders.tpl.php';
    }

    function action_cakes($params){
        $cakes = model_cake::get_all();
        // Include view for this page
        @include_once APP_PATH . 'view/admin_cake_list.tpl.php';
    }

    function action_cake($params){
        $cake = model_cake::load_by_id($params[0]);
        @include_once APP_PATH . 'view/admin_cake_view.tpl.php';
    }
}