<?php
include_once __DIR__ . "/database.php";
include_once __DIR__ . "/client.php";
class model_account {

    const TYPE_ADMIN = 1;
    const TYPE_CLIENT = 0;

    var $id_account;
    var $username;
    var $pass;
    var $type;

    public static function create($username, $pass, $type){
        $db = model_database::instance();
        $sql = 'INSERT INTO accounts (account_username, account_pass, account_type)
                VALUES (\'' . $username . '\', \'' .  md5($pass) . '\', ' . $type . ');';
        $db->execute($sql);
        $sql = 'SELECT account_id
                FROM accounts where username=\'' . $username . '\' && pass=\'' . md5($pass) . '\';';
       if($result = $db->execute($sql)){
           $new_id_account = $db->last_insert_id();
           return model_account::load_by_id($new_id_account);
       }
        return false;
    }

    public function validate($username, $pass)
    {
        $db = model_database::instance();
        $sql = 'SELECT account_type
                FROM accounts
                WHERE account_username = "' . mysql_real_escape_string($username) . '"
				AND account_pass = "' . md5($pass) . '"';

        if ($result = $db->get_row($sql))
        {

            if ($result['account_type'] == 1)
            {
                $this->account_type = self::TYPE_ADMIN;
            }
            else
            {
                $this->account_type = self::TYPE_CLIENT;
            }
        }
        return $result['account_type'];
    }

    public function update($username, $pass, $type)
    {
        $db = model_database::instance();
        $sql = 'UPDATE accounts
                SET account_username =\'' . $username . '\', account_pass = \'' . md5($pass) . '\', account_type = \'' . $type .'\'
                WHERE account_id = \'' . $this->id_account . '\'
                limit 1';

        if($db->execute($sql) == 1){
            return true;
        }
        return false;
    }

    public static function delete($id_account)
    {
        $db = model_database::instance();
        $sql = 'DELETE FROM accounts
                WHERE account_id = \'' . $id_account . '\';';
        if($db->execute($sql)){
            return true;
        }
        return false;

    }

    public static function get_client($id_account){
        $db = model_database::instance();
        $sql = 'SELECT * FROM clients where client_id_account = \'' . $id_account . '\';';
        if($result = $db->get_row($sql)){
            $obj = new model_client();
            $obj->account_id = $id_account;
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
            $obj->id_account = $account_id;
            $obj->pass = $result['account_pass'];
            $obj->type = $result['account_type'];
            $obj->username = $result['account_username'];
            return $obj;
        }
        return false;
    }
}
