<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Andrada
 * Date: 4/19/13
 * Time: 1:13 PM
 * To change this template use File | Settings | File Templates.
 */

class controller_cart
{
    /**
     * Redirects us to the file that creates the updated cart confirmation page.
     * @param $params
     */
    function action_updated($params)
    {
        // Include view for this page
        @include_once APP_PATH . 'view/cart_updated.tpl.php';

    }

    /**
     * This sends the command for processing.
     * @param $params
     */
    function action_send($params)
    {
        // Client must be logged in to access this page
        if (!($account = model_account::load_by_id($_SESSION['myshop']['account_id'])) || $account->type != model_account::TYPE_CLIENT) {
            header('Location: ' . APP_URL . 'client/notice');
            die;
        }

        $cart = model_cart::load();
        if ($cakes = $cart->get_cakes()) {
            $client = $account->get_client();
            if ($order = model_order::create($client->id, date('Y-m-d'))) {
                foreach ($cakes as $cake) {
                    if ($order->add_cake($cake->id, $cake->order_quantity)) {
                        $cart->remove_cake($cake->id);
                        $cake->sell_cakes($cake->order_quantity);
                    }
                }
            }
        }
        header('Location: ' . APP_URL . 'cart/sent');
        die;
    }

    /**
     * Removes all cakes from cart.
     * @param $params
     */
    function action_empty($params)
    {
        $cart = model_cart::load();
        if ($cakes = $cart->get_cakes()) {
            foreach ($cakes as $cake) {
                $cart->remove_cake($cake->id);
            }
        }
        header('Location: ' . APP_URL . 'cart/emptied');
        die;
    }

    /**
     * Updates a cake using "update_cake" function and redirects us to the file that makes the updated cart confirmation page.
     * @param $params
     */
    function action_update($params)
    {
        if (isset($_POST['form']['action'])) {
            $cart = model_cart::load();
            foreach ($_POST['form']['cake'] as $cake_id => $quantity) {
                $cart->update_cake($cake_id, $quantity);
            }
            header('Location: ' . APP_URL . 'cart/updated');
            die;
        }
        header('Location: ' . APP_URL);
        die;
    }

    /**
     * Adds a cake to cart.
     * @param $params
     */
    function action_add($params)
    {
        if (isset($_POST['form']['action'])) {
            if ($cake = model_cake::load_by_id($_POST['form']['cake_id'])) {
                $cart = model_cart::load();
                if ($cart->add_cake($cake->id, $_POST['form']['quantity'])) {
                    header('Location: ' . APP_URL . 'cart/added');
                    die;
                }
            }
        }
    
        header('Location: ' . APP_URL);
        die;
    }

    /**
     * Loads all carts.
     * @param $params
     */
    function action_index($params)
    {
        $cart = model_cart::load();

        // Include view for this page
        @include_once APP_PATH . 'view/cart_index.tpl.php';
    }

    /**
     * Redirects us to the file that creates the added caart confirmation page.
     * @param $params
     */
    function action_added($params)
    {
        // Include view for this page
        @include_once APP_PATH . 'view/cart_added.tpl.php';
    }

    /**
     * Redirects us to the file that creates the emptied cart confirmation page.
     * @param $params
     */
    function  action_emptied($params)
    {
        // Include view for this page
        @include_once APP_PATH . 'view/cart_emptied.tpl.php';
    }

    /**
     * Redirects us to the file that creates the sent cart confirmation page.
     * @param $params
     */
    function action_sent($params)
    {
        // Include view for this page
        @include_once APP_PATH . 'view/cart_sent.tpl.php';

    }

}