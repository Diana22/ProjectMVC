<?php
include_once __DIR__ . "/database.php";
class model_order {

    var $orders;

    public function __construct(){
        $this->orders = null;
    }

    /*
     * Gets the order that has a specific id.
     * @param $id id to search for
     * @return a specific order.
     */
    public function getByOrderId($id){
        $db = model_database::instance();
        $sql = 'SELECT id_order, id_client, name_cake, quantity, due_date
			    FROM orders
			    WHERE id_order = ' . $id . ' LIMIT 1;';
        if ($result = $db->get_row($sql)) {
            $this->orders = array(
                'id_order' => $result['id_order'],
                'id_client' => $result['id_client'],
                'name_cake' => $result['name_cake'],
                'quantity' => $result['quantity'],
                'due_date' => $result['due_date'],
            );
        }
        return $this->orders;
    }

    /*
    * Gets all orders that have been made by a client.
    * @param $id id to search for
    * @return array of orders made by client.
    */
    public function getByClientId($id){
        $db = model_database::instance();
        $sql = 'SELECT id_order, id_client, name_cake, quantity, due_date
			    FROM orders
			    WHERE id_client = ' . $id . ';';
        if ($result = $db->get_rows($sql)) {
            $this->orders = $result;
        }
        return $this->orders;
    }

    /*
    * Gets all orders that have a cake.
    * @param $name String to search for.
    * @return array of orders that have that cake.
    */
    public function getByCakeName($name){
        $db = model_database::instance();
        $sql = 'SELECT id_order, id_client, name_cake, quantity, due_date
			    FROM orders
			    WHERE name_cake = \'' . $name . '\';';
        if ($result = $db->get_rows($sql)) {
            $this->orders = $result;
        }
        return $this->orders;
    }

    /*
    * Gets all orders that have a due_date.
    * @param $date date to search for.
    * @return array of orders that have that due date.
    */
    public function getByDueDate($date){
        $db = model_database::instance();
        $sql = 'SELECT id_order, id_client, name_cake, quantity, due_date
			    FROM orders
			    WHERE due_date = \'' . $date . '\';';
        if ($result = $db->get_rows($sql)) {
            $this->orders = $result;
        }
        return $this->orders;
    }

     /*
     * Adds an order.
     * @param $id client id.
     * @param $name cake name as string.
     * @param $quantity quantity.
     * @param $date due date in format yyyy.mm.yy.
     */
    public function addOrder($id, $name, $quantity, $date){
        $db = model_database::instance();
        $sql = 'INSERT INTO orders
                (id_client, name_cake,quantity, due_date)
                VALUES
                (' . $id . ',\'' . $name . '\', ' . $quantity . ', \'' . $date . '\');';
        $db->execute($sql);
    }

     /*
     * Deletes an order.
     * @param $key criteria by which to delete.
     * @param $val value to delete.
     */
    public function deleteByParam($key, $val){
        $db = model_database::instance();
        $sql = 'DELETE FROM orders
                WHERE ' . $key . '=\'' . $val . '\';';
        $db->execute($sql);
    }

    /*
     * Gets the order that has a specified parameter.
     * @param $key criteria by which to select
     * @param $val value to select.
     * @return a specific order.
     */
    public function getByParam($key, $val){
        $db = model_database::instance();
        $sql = 'SELECT id_order, id_client, name_cake, quantity, due_date
			    FROM orders
			    WHERE ' . $key . ' = \'' . $val . '\';';
        if ($result = $db->get_rows($sql)) {
            $this->orders = $result;
        }
        return $this->orders;
    }

}