<?php
include_once __DIR__. "/database.php";
include_once __DIR__ . "/account.php";
include_once __DIR__ . "/order.php";
class model_client {
    var $id;
    var $name;
    var $address;
    var $phone;
    var $account_id;

    public static function load_by_id($id){
        $db = model_database::instance();
        $sql = 'SELECT *
                FROM clients
                WHERE client_id_account = \'' . $id . '\';';
        if($result = $db->get_row($sql) )
        {
            $obj = new model_client();
            $obj->id = $result['client_id_account'];
            $obj->name = $result['client_name'];
            $obj->address = $result['client_address'];
            $obj->phone = $result['client_phone'];
            return $obj;
        }
        return false;
    }

    public static function load_by_account_id($id_account){
        $db = model_database::instance();
        $sql = 'SELECT account_id, account_username, account_pass, account_type
                FROM accounts
                WHERE account_id = \'' . $id_account . '\';';
        if($result = $db -> get_row($sql) )
        {
            $obj = new model_account();
            $obj->id_account = $result['account_id'];
            $obj->username = $result['account_username'];
            $obj->pass =$result['account_pass'];
            $obj->type = $result['account_type'];
            return $obj;
        }
        return false;
    }

    public static function create($account_id, $name, $address, $phone){
        $db = model_database::instance();
        $sql = 'INSERT INTO clients
                    (client_id_account, client_name, client_address, client_phone)
                VALUES
                    (\'' . $account_id . '\', \'' .  $name .  '\', \'' . $address . '\',\'' .  $phone . '\') ;';
        if($result = $db->execute($sql)){
            return model_client::load_by_id($account_id);
        }
        return false;
    }

    public function update($name, $address, $phone, $account_id)
    {
        $db = model_database::instance();
        $sql = 'UPDATE clients
                SET client_name =\'' . $name . '\', client_address = \'' . $address . '\', client_phone = \'' . $phone . '\'
                WHERE client_id_account = \'' . $account_id . '\'
                limit 1';
        if($db->execute($sql)){
            return true;
        }
        return false;
    }

    public static function delete($id){
        $db = model_database::instance();
        $sql = 'DELETE FROM clients
                where client_id_account = \'' . $id . '\';';
        if($db->execute($sql)){
            return true;
        }
    return false;
    }

    public function get_account($id_account){
        $db = model_database::instance();
        $sql = 'SELECT * FROM accounts
                WHERE account_id = \'' . $id_account . '\'';
        if($result = $db->get_row($sql)){
            $obj = new model_account();
            $obj->account_id = $id_account;
            $obj->username = $result['account_username'];
            $obj->pass = $result['account_pass'];
            $obj->type = $result['account_type'];
            return $obj;

        }
        return false;
    }

    public function get_orders(){
        $db = model_database::instance();
        $sql = 'SELECT order_id, order_id_client, order_pickup_date FROM orders WHERE order_id = \'' . $this->id . '\'';
        if ($rows = $db->get_rows($sql)){
            $return = null;
            foreach($rows as $row){
                $orders = model_order::get_by_order_id($row['order_id']);
                $return[] = $orders;
            }
            return $return;
        }
        return false;
    }
}
$model = model_client::load_by_id(3);
$rsl = $model->get_orders();
var_dump($rsl);

