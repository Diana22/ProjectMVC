<?php

class model_cart {
	
	public static function load() {
		return new model_cart();
	}

	public function add_cake($cake_id, $quantity) {
		$_SESSION['myshop']['cart'][$cake_id]['cake_id'] = $cake_id;

		if (isset($_SESSION['myshop']['cart'][$cake_id]['quantity'])) {
			$quantity += $_SESSION['myshop']['cart'][$cake_id]['quantity'];
		}

		$_SESSION['myshop']['cart'][$cake_id]['quantity'] = $quantity;

		return TRUE;
	}

	public function update_cake($cake_id, $quantity) {
		if (isset($_SESSION['myshop']['cart'][$cake_id])) {
			if (intval($quantity)) {
				$_SESSION['myshop']['cart'][$cake_id]['quantity'] = $quantity;
				return TRUE;
			}
			else {
				return $this->remove_cake($cake_id);
			}
		}
		return FALSE;
	}

	public function remove_cake($cake_id) {
		if (isset($_SESSION['myshop']['cart'][$cake_id])) {
			unset($_SESSION['myshop']['cart'][$cake_id]);
		}
		return TRUE;
	}

	public function get_cakes() {
		$response = array();

		if (isset($_SESSION['myshop']['cart'])) {
			foreach ($_SESSION['myshop']['cart'] as $cart_id => $cart_data) {
				if ($cake = model_cake::load_by_id($cart_id)) {
					$cake->order_quantity = $cart_data['quantity'];
					$response[] = $cake;
				}
			}
		}

		return $response;
	}
}