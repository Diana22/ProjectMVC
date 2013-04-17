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

    public static function load_by_id($client_id){
        $db = model_database::instance();
        $sql = 'SELECT *
                FROM clients
                WHERE client_id = \'' . $client_id . '\';';
        if($result = $db->get_row($sql) )
        {
            $obj = new model_client();
            $obj->id = $client_id;
            $obj->account_id = $result['client_id_account'];
            $obj->name = $result['client_name'];
            $obj->address = $result['client_address'];
            $obj->phone = $result['client_phone'];
            return $obj;
        }
        return false;
    }

    public static function load_by_account_id($id_account){
        $db = model_database::instance();
        $sql = 'SELECT *
                FROM clients
                WHERE client_id_account = \'' . $id_account . '\';';
        if($result = $db -> get_row($sql) )
        {
            $obj = new model_client();
            $obj->id = $result['client_id'];
            $obj->id_account = $result['client_id_account'];
            $obj->name = $result['client_name'];
            $obj->address =$result['client_address'];
            $obj->phone = $result['client_phone'];
            return $obj;
        }
        return false;
    }

    public static function create($account_id, $name, $address, $phone){
        $db = model_database::instance();
        $sql = 'INSERT INTO clients
                    (client_id_account, client_name, client_address, client_phone)
                VALUES
                    (\'' . $account_id . '\', \'' .  mysql_real_escape_string($name) .  '\', \'' . mysql_real_escape_string($address) . '\',\'' .  $phone . '\') ;';
        if($db->execute($sql)){
            $new_account_id = $db->last_insert_id();
            return model_client::load_by_id($new_account_id);
        }
        return false;
    }

    public function update($name, $address, $phone, $account_id)
    {
        $db = model_database::instance();
        $sql = 'UPDATE clients
                SET cliemt_of_account =\'' . $account_id . '\', client_name =\'' . mysql_real_escape_string($name) . '\', client_address = \'' . mysql_real_escape_string($address) . '\', client_phone = \'' . $phone . '\'
                WHERE client_id_account = \'' . $this->account_id . '\'
                limit 1';
        if($db->execute($sql)){
            $this->account_id = $account_id;
            $this->name = $name;
            $this->address = $address;
            $this->phone = $phone;
            return true;
        }
        return false;
    }

    public function delete(){
        $db = model_database::instance();
        $sql = 'DELETE FROM clients
                where client_id_account = \'' . $this->id . '\';';
        if($db->execute($sql)){
            $this->id = null;
            $this->account_id = null;
            $this->name = null;
            $this->address = null;
            $this->phone = null;
            return true;
        }
    return false;
    }

    public function get_account(){

        return model_account::load_by_id($this->account_id);

    }

    public function get_orders(){

        return model_order::get_by_client_id($this->id);
    }
}
$model = model_client::load_by_id(3);
$rsl = $model->get_orders();
var_dump($rsl);

