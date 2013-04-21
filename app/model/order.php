<?php

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
    public static function load_by_client_id($id){
        $db = model_database::instance();
        $sql = 'SELECT *
			    FROM orders
			    WHERE order_id_client = ' . $id . ';';
        if ($result = $db->get_rows($sql)) {
            $model = new model_order();
            $return = null;
            foreach ($result as $array)
            {
                $return[] = $model->set($array);
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
        if ($db->execute($sql)) {
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
                $cake->cake_quantity = $row['oc_quantity'] ;
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
    public function set($array){
        $this->id = $array['order_id'];
        $this->id_client = $array['order_id_client'];
        $this->pickup_date = $array['order_pickup_date'];
        return $this;
    }
}