<?php
include_once __DIR__ . "/database.php";
class model_order {

    var $id;
    var $id_client;
    var $pickup_date;


    /*
     * Gets the order that has a specific id.
     * @param $id id to search for
     * @return a specific order.
     */
    public static function get_by_order_id($id){
        $db = model_database::instance();
        $sql = 'SELECT order_id, order_id_client, order_pickup_date
			    FROM orders
			    WHERE order_id = ' . $id . ' LIMIT 1;';
        if ($result = $db->get_row($sql)) {
            $return = new model_order();
            $return->set($result);
            return $return;
        }
        return false;
    }

    /*
    * Gets all orders that have been made by a client.
    * @param $id id to search for
    * @return array of orders made by client.
    */
    public static function get_by_client_id($id){
        $db = model_database::instance();
        $sql = 'SELECT order_id, order_id_client, order_pickup_date
			    FROM orders
			    WHERE order_id_client = ' . $id . ';';
        if ($result = $db->get_rows($sql)) {
            $model = new model_order();
            foreach ($result as $array)
            {
                $return[] = $model->set($array);
            }
            return $return;
        }
    }

    /*
    * Gets all orders that have a cake.
    * @param $name String to search for.
    * @return array of orders that have that cake.
     *
     *
     * modify for get_cakes.
    */

    public static function get_by_cake_name($name){
        $db = model_database::instance();
        $sql = 'SELECT order_id, order_id_client, order_pickup_date
			    FROM orders
			    INNER JOIN orders_cakes
			    ON order_id = oc_id_order
			    INNER JOIN cakes
			    ON oc_id_cake = cake_id
			    WHERE cake_name = \'' . $name . '\';';
        if ($result = $db->get_rows($sql)) {
            $model = new model_order();
            foreach ($result as $array)
            {
                $return[] = $model->set($array);
            }
            return $return;
        }
    }

//    /*
//    * Gets all orders that have a due_date.
//    * @param $date date to search for.
//    * @return array of objects  that have that pickup date.
//    */
//    public static function get_by_pickup_date($date){
//        $db = model_database::instance();
//        $sql = 'SELECT order_id, order_id_client, order_pickup_date
//			    FROM orders
//			    WHERE pickup_date = \'' . $date . '\';';
//        if ($result = $db->get_rows($sql)) {
//            $model = new model_order();
//            foreach ($result as $array)
//            {
//                $return[] = $model->set($array);
//            }
//            return $return;
//        }
//    }

     /*
     * Adds an order.
     * @param $id client id.
     * @param $pickup date in format yyyy.mm.yy.
     */
    public static function create($client_id, $date){
        $db = model_database::instance();
        $sql = 'INSERT INTO orders
                (order_id_client, order_pickup_date)
                VALUES
                (' . $client_id . ',\'' . $date . '\');';
        $db->execute($sql);
        if ($db->get_affected_rows() > 0)
        {
            $sql = 'SELECT order_id, order_id_client, order_pickup_date
			    FROM orders
			    WHERE order_pickup_date = \'' . $date . '\'
			    && order_id_client = ' . $client_id . ';';

            if ($result = $db->get_row($sql)) {
                $return = new model_order();
                $return->set($result);
                return $return;
            }
        }
        return false;
    }

     /*
     * Deletes an order the entry corresponding to the current object.
     */
    public function delete(){
        $success = 1;
        // work in progress.
        $db = model_database::instance();
        $sql = 'DELETE FROM orders
                WHERE id_order=\'' . $this->id . '\';';
        $db->execute($sql);
        if($db->get_affected_rows() < 1){
            $success = 0;
        }
        $sql = 'DELETE FROM orders_cakes
                WHERE id_order=\'' . $this->id . '\';';
    }

//    /*
//     * Gets the order that has a specified parameter.
//     * @param $key criteria by which to select
//     * @param $val value to select.
//     * @return a specific order.
//     */
//    public static function get_by_param($key, $val){
//        $db = model_database::instance();
//        $sql = 'SELECT order_id, order_id_client, order_pickup_date
//			    FROM orders
//			    WHERE ' . $key . ' = \'' . $val . '\';';
//        if ($result = $db->get_rows($sql)) {
//            $model = new model_order();
//            foreach ($result as $array)
//            {
//                $return[] = $model->set($array);
//            }
//            return $return;
//        }
//    }

    public function set($array){
        $this->id = $array['order_id'];
        $this->id_client = $array['order_id_client'];
        $this->pickup_date = $array['order_pickup_date'];
        return $this;
    }

}

var_dump(model_order::get_by_cake_name('asd'));