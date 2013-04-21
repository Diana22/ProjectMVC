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
		if (!($account = model_account::load_by_id($_SESSION['myshop']['account_id'])) || $account->type != model_account::TYPE_ADMIN) {
			header('Location: ' . APP_URL . 'account/login/');
			die;
		}

		// Include view for this page
		@include_once APP_PATH . 'view/admin_index.tpl.php';
	}

	/**
	 * Login page for admin.
	 */
	function action_login($params) {

		// If the form was submitted, validate credentials
		$form_error = FALSE;
		if (isset($_POST['form']['action'])) {
			if ($admin_user_id = model_admin::validate($_POST['form']['user'], $_POST['form']['password'])) {
				$_SESSION['myshop']['admin_user_id'] = $admin_user_id;
				header('Location: ' . APP_URL . 'admin');
				die;
			}
			$form_error = TRUE;
		}

		// Include view for this page
		@include_once APP_PATH . 'view/admin_login.tpl.php';
	}


	/**
	 * Lists ingredients.
	 */
	function action_ingredients($params) {

		$ingredients = model_ingredient::get_all();

		// Include view for this page
		@include_once APP_PATH . 'view/admin_ingredients.tpl.php';
	}

	/**
	 * Logout action.
	 */
	function action_logout($params) {
		unset($_SESSION['myshop']['admin_user_id']);
		header('Location: ' . APP_URL . 'admin/login');
		die;
	}
}