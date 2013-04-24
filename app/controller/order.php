<?php
class controller_order
{

    public function action_updated($params)
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
        $order = model_order::load_by_id($params[0]);

        if (isset($_POST['form']['action'])) {
            $order->update($_POST['form']['id_client'], $_POST['form']['pickup_date']);
            header('Location: ' . APP_URL . 'order/updated/');
            die;
        }
        @include APP_PATH . 'view/order_edit.tpl.php';

    }

    /*
     * Displays all orders made by current account
     */
    public function action_current($params)
    {
        $id = $_SESSION['myshop']['account_id'];
        if ($orders = model_order::get_by_client_id($id))
        {
            @include_once APP_PATH . "view/snippets/header.tpl.php";
            foreach($orders as $order){
                @include APP_PATH . "view/order_current.tpl.php";
            }
            @include_once APP_PATH . "view/snippets/footer.tpl.php";
        }
        else @include_once APP_PATH . "view/order_empty.tpl.php";
    }

    public function action_view($params)
    {
        $id = $params[0];
        $order = model_order::load_by_id($id);
        $cake = model_cake::load_by_id($id);

        @include_once APP_PATH . 'view/order_view.tpl.php';
    }

    public function action_delete($params){
        $order = model_order::load_by_id($params[0]);
        $order->delete();

        @include_once APP_PATH . "view/order_deleted.tpl.php";
    }

    public function action_remove($params){
        $order = model_order::load_by_id($params[0]);
        $order->remove_cake($params[1]);
        @include_once APP_PATH . "view/order_removed.tpl.php";
    }
}