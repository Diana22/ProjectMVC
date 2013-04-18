<?php
include_once __DIR__ . "/database.php";
include_once __DIR__ . "/client.php";
class model_account {

    const TYPE_ADMIN = 1;
    const TYPE_CLIENT = 0;

    var $id;
    var $username;
    var $pass;
    var $type;

    public static function create($username, $pass, $type){
        $db = model_database::instance();
        $sql = 'INSERT INTO accounts (account_username, account_pass, account_type)
                VALUES (\'' . mysql_real_escape_string($username) . '\', \'' .  md5($pass) . '\', ' . $type . ');';
        $db->execute($sql);
        $new_id = $db->last_insert_id();
        return model_account::load_by_id($new_id);

    }

    public static function validate($username, $pass)
    {
        $db = model_database::instance();
        $sql = 'SELECT account_id
                FROM accounts
                WHERE account_username = "' . mysql_real_escape_string($username) . '"
				AND account_pass = "' . md5($pass) . '"';
        if ($result = $db->execute($sql))
        {
            return $result['account_id'];
        }
       return false;
    }

    public function update($username, $pass, $type)
    {
        $db = model_database::instance();
        $sql = 'UPDATE accounts
                SET account_username =\'' .  mysql_real_escape_string($username) . '\', account_pass = \'' . md5($pass) . '\', account_type = \'' . $type .'\'
                WHERE account_id = \'' . $this->id . '\'
                limit 1';

        if($result = $db->execute($sql)){
            $this->username = $result['account_username'];
            $this->pass = $result['account_pass'];
            $this->type = $result['account_type'];
            return true;
        }
        return false;
    }

    public function delete()
    {
        $db = model_database::instance();
        $sql = 'DELETE FROM accounts
                WHERE account_id = \'' . $this->id . '\';';
        if($db->execute($sql)){
            $this->id = null;
            $this->username = null;
            $this->pass = null;
            $this->type = null;
                return true;
        }
        return false;

    }

    public function get_client(){
        $db = model_database::instance();
        $sql = 'SELECT * FROM clients where client_id = \'' . $this->id . '\';';
        if($result = $db->get_row($sql)){
            $obj = new model_client();
            $obj->account_id = $this->id;
            $obj->name = $result['client_name'];
            $obj->adress = $result['client_address'];
            $obj->phone = $result['client_phone'];
            return $obj;
        }
        return false;
    }

    public static function load_by_id($account_id){
        $db = model_database::instance();
        $sql = 'SELECT * FROM accounts where account_id=' . $account_id;
        if ($result = $db->get_row($sql)){
            $obj = new model_account();
            $obj->id = $account_id;
            $obj->pass = $result['account_pass'];
            $obj->type = $result['account_type'];
            $obj->username = $result['account_username'];
            return $obj;
        }
        return false;
    }
}
