<?php
class controller_order
{

    public function action_updated()
    {
        include APP_PATH . 'view/order_updated.tpl.php';
    }

    /**
     * This function edits an order.
     * @param $params
     */
    public function action_edit($params)
    {
        @include_once APP_PATH . '/model/order.php';
        $order = model_order::get_by_order_id($params[0]);

        if (isset($_POST['form']['action'])) {
            $order->update($_POST['form']['id_client'], $_POST['form']['pickup_date']);
            header('Location: ' . APP_URL . 'order/updated/');

        }
        @include APP_PATH . 'view/order_edit.tpl.php';

    }
}