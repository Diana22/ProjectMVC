<?php
include_once __DIR__. "\\database.php";
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
           $a = new model_account();
           $a->username = $result['username'];
           $a->pass = $result['pass'];
           $a->type = $result['type'];
           $a->id_account = $result['id_account'];
       }
        return false;
    }

    public function valid($username, $pass)
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

    public static function update_account($username, $pass)
    {
        $db = model_database::instance();
        $sql = 'UPDATE accounts
                SET account_username =\'' . $username . '\', pass = \'' . md5($pass) . '\'
                WHERE account_username = \'' . $username . '\'
                limit 1';

        if($result = $db->execute($sql)){
            return true;
        }
        return false;
    }

    public static function delete_account($id_account)
    {
        $db = model_database::instance();
        $sql = 'DELETE FROM clients
                where account_id = \'' . $id_account . '\';';
        $db->execute($sql);
        $sql = 'DELETE FROM accounts
                WHERE account_id = \'' . $id_account . '\';';
        $db->execute($sql);
        return true;

    }
}
