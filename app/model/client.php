<?php
include_once __DIR__. "/database.php";
class model_client {
    var $id;
    var $name;
    var $adress;
    var $phone;
    var $account_id;

    public static function update($account_id,$name, $adress, $phone)
    {
        $db = model_database::instance();
        $sql = 'UPDATE accounts
                SET  client_name =\'' . $name . '\', client_adress = \'' . $adress . ', client_phone = \'' . $phone . '\'
                WHERE client_id_account = \'' . $account_id . '\' ;';
        if($db->execute($sql)){
            return true;
        }
        return false;
    }

    public static function load_by_account_id($id){
        $db = model_database::instance();
        $sql = 'SELECT client_id_account, client_name, client_address, client_phone
                FROM clients
                WHERE clients_id_account = \'' . $id . '\';';
        if($result = $db ->execute($sql) )
        {
            $obj = new model_client();
            $obj->id = $result['id'];
            $obj->name = $result['name'];
            $obj->address =$result['address'];
            $obj->phone = $result['phone'];
            return $obj;
        }
        return false;
    }

    public static function create($account_id, $name, $address, $phone){
        $db = model_database::instance();
        $sql = 'INSERT INTO clients (client_id_account, client_name, client_address, client_phone)
                VALUES \'' . $account_id . '\', \'' .  $name .  '\', \'' . $address . '\',\'' .  $phone . '\' ;';
        if ($db->execute($sql)){
            $model = new model_client();
            $model->account_id = $account_id;
            $model->adress = $address;
            $model->name = $name;
            $model->phone = $phone;
            return $model;
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
}