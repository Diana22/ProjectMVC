<?php
include_once __DIR__ . "/database.php";
include_once __DIR__ . "/cake.php";
include_once __DIR__ . "/client.php";
class model_order {

    var $id;
    var $id_client;
    var $pickup_date;


    /*
     * Gets the order that has a specific id.
     * @param $id id to search for
     * @return a specific order.
     */
    public static function load_by_id($id){
        $db = model_database::instance();
        $sql = 'SELECT *
			    FROM orders
			    WHERE order_id = ' . $id . '
			    LIMIT 1;';
        if ($result = $db->get_row($sql)) {
            $return = new model_order();
            $return->set_proprieties($result['order_id'],$result['order_id_client'],$result['order_pickup_date']);
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
        $sql = 'SELECT *
			    FROM orders
			    WHERE order_id_client = ' . $id . ';';
        if ($result = $db->get_rows($sql)) {
            $return = array();
            foreach ($result as $array)
            {
                $model = new model_order();
                $model->set_proprieties($array['order_id'],$array['order_id_client'],$array['order_pickup_date']);
                $return[] = $model;
            }
            return $return;
        }
        return false;
    }

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
            if ($db->last_insert_id()){
                return model_order::load_by_id($db->last_insert_id());
            }
        }
        return false;
    }

     /*
     * Deletes an order the entry corresponding to the current object.
     */
    public function delete(){
        $db = model_database::instance();
        $sql = 'DELETE FROM orders
                WHERE order_id=\'' . $this->id . '\';';
        if(!$db->execute($sql)){
            return false;
        }

        $sql = 'DELETE FROM orders_cakes
                WHERE oc_id_order=\'' . $this->id . '\';';
        if(!$db->execute($sql)){
            return false;
        }

        $this->id = null;
        $this->id_client = null;
        $this->pickup_date = null;
        return true;
    }

    /*
     * Updates the current record with new values.
     */
    public function update($client_id, $pickup_date) {
        $db = model_database::instance();
        $sql = 'UPDATE orders
                SET order_id_client=' . $client_id . ', order_pickup_date=\'' . $pickup_date . '\'
                WHERE order_id=' . $this->id;
        if($db->execute($sql)){
            $this->id_client = $client_id;
            $this->pickup_date = $pickup_date;
            return true;
        }
        return false;
    }

    /*
     * Adds new items to the current order.
     */
    public function add_cake($cake_id, $quantity){
        $db = model_database::instance();
        $sql = 'INSERT INTO orders_cakes
                VALUES ('. $this->id . ',' . $cake_id . ',' . $quantity . ')';
        if ($db->execute($sql)){
            return true;
        }
        return false;
    }

    /*
     * Deletes specified cake from current order.
     */
    public function remove_cake($cake_id){
        $db = model_database::instance();
        $sql = 'DELETE FROM orders_cakes
                WHERE oc_id_order=' . $this->id . ' && oc_id_cake=' . $cake_id . ';';
        if ($db->execute($sql)){
            return true;
        }
        return false;
    }

    /*
     * Returnes all cakes within the current order and their quantities.
     */
    public function get_cakes(){
        $db = model_database::instance();
        $sql = 'SELECT *
                FROM orders_cakes
                WHERE oc_id_order=' . $this->id . ';';
        if ($rows = $db->get_rows($sql)){
            $cakes = null;
            foreach($rows as $row){
                $cake = model_cake::load_by_id($row['oc_id_cake']);
                $cake->ordered_quantity = $row['oc_quantity'] ;
                $cakes[] = $cake;
            }
            return $cakes;
        }
        return false;
    }

    /*
     * Returns a client object that is linked to current order.
     */
    public function get_client(){
        return model_client::load_by_account_id($this->id_client);
    }

    /*
     * Sets the object attributes to those of an array with same keys.
     */
    public function set_proprieties($order_id,$order_id_client,$order_pickup_date){
        $this->id = $order_id;
        $this->id_client = $order_id_client;
        $this->pickup_date = $order_pickup_date;
    }
}