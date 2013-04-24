<?php

class model_cart
{
    /**
     * This function loads all carts.
     * @return model_cart
     */
    public static function load()
    {
        return new model_cart();
    }

    /**
     * Thos function adds a cake to cart.
     * @param $cake_id
     * @param $quantity
     * @return bool
     */
    public function add_cake($cake_id, $quantity)
    {
        $_SESSION['myshop']['cart'][$cake_id]['cake_id'] = $cake_id;

        if (isset($_SESSION['myshop']['cart'][$cake_id]['quantity'])) {
            $quantity += $_SESSION['myshop']['cart'][$cake_id]['quantity'];
        }

        $_SESSION['myshop']['cart'][$cake_id]['quantity'] = $quantity;

        return TRUE;
    }

    /**
     * This function updates a cake from cart.
     * @param $cake_id
     * @param $quantity
     * @return bool
     */
    public function update_cake($cake_id, $quantity)
    {
        if (isset($_SESSION['myshop']['cart'][$cake_id])) {
            if (intval($quantity)) {
                $_SESSION['myshop']['cart'][$cake_id]['quantity'] = $quantity;
                return TRUE;
            } else {
                return $this->remove_cake($cake_id);
            }
        }
        return FALSE;
    }

    /**
     * This function removes a cake from cart.
     * @param $cake_id
     * @return bool
     */
    public function remove_cake($cake_id)
    {
        if (isset($_SESSION['myshop']['cart'][$cake_id])) {
            unset($_SESSION['myshop']['cart'][$cake_id]);
        }
        return TRUE;
    }

    /**
     * This function gets all cakes from cart.
     * @return array
     */
    public function get_cakes()
    {
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