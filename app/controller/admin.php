<?php
/**
 * Controller for handling admin user actions: login etc.
 */
class controller_admin {

	/**
	 * Main admin page.
	 */
	function action_index($params) {
        if (model_validate::validation()){
		@include_once APP_PATH . 'view/admin_index.tpl.php';
        }
        else
        {
            @include_once APP_PATH . 'view/404_admin.tpl.php';
        }
	}

	/**
	 * Lists ingredients.
	 */
	function action_ingredients($params) {
        if (model_validate::validation()){
            $ingredients = model_ingredient::get_all();
            @include_once APP_PATH . 'view/admin_ingredients.tpl.php';
        }
        else @include_once APP_PATH . 'view/404_admin.tpl.php';
	}

    /*
     * Lists orders.
     */
    function action_orders($params)
    {
        if (model_validate::validation()){
            $orders = model_order::get_all();
            @include APP_PATH . 'view/admin_orders.tpl.php';
        }
        else @include_once APP_PATH . 'view/404_admin.tpl.php';
    }

    /*
     * Lists all cakes.
     */
    function action_cakes($params){
        if (model_validate::validation()){
            $cakes = model_cake::get_all();
            // Include view for this page
            @include_once APP_PATH . 'view/admin_cake_list.tpl.php';
        }
        else @include_once APP_PATH . 'view/404_admin.tpl.php';
    }

    /*
     */
    function action_cake($params){
        if (model_validate::validation()){
            $cake = model_cake::load_by_id($params[0]);
            @include_once APP_PATH . 'view/admin_cake_view.tpl.php';
        }
        else @include_once APP_PATH . 'view/404_admin.tpl.php';
    }
}