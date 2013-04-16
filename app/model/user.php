<?php
include_once __DIR__. "/database.php";
class model_user {
    var $name;
    var $adress;
    var $phone;
    var $username;
    var $pass;
    var $account_type; // 1 for admin, 0 for normal user.

    function __construct($username,$pass)
    {
        $this->username = $username;
        $this->pass = $pass;
    }

    public function  valid($username, $pass)
    {
        $db = model_database::instance();
        $sql = 'SELECT type
                FROM account
                WHERE username = "' . mysql_real_escape_string($username) . '"
				AND pass = "' . md5($pass) . '"';

        if ($result = $db->get_row($sql))
        {

            if ($result['type'] == 1)
            {
                $this->account_type = 1;
            }
            else
            {
                $this->account_type = 0;
            }
        }
    }
    public function addaccount($name, $adress, $phone, $username, $pass, $type)
    {
        $db = model_database::instance();
        $sql = 'INSERT INTO client
                (name_client, adress, phone)
                VALUES
                (\'' . $name . '\', \'' . $adress . '\', \'' . $phone . '\');';
        $db->execute($sql);
        $sql = 'INSERT INTO account (username, pass, type)
                VALUES (\'' . $username . '\', \'' . $pass . '\', ' . $type . ');';
        $db->execute($sql);
    }

    public function updateclient($name, $adress, $phone)
    {
        $db = model_database::instance();
        $sql = 'UPDATE account
                SET  name_client =\'' . $name . '\', adress = \'' . $adress . ', phone = \'' . $phone . '\'
                WHERE name = \'' . $name . '\' ';
        $db->execute($sql);
    }

    public function updateaccount($username, $pass)
    {
        $db = model_database::instance();
        $sql = 'UPDATE account
                SET username =\'' . $username . '\', pass = \'' . $pass . '\'
                WHERE username = \'' . $username . '\'
                limit 1';
        $db->execute($sql);
    }

    public function deleteaccount($id)
    {
        $db = model_database::instance();
        $sql = 'DELETE FROM client
                where id_client = \'' . $id . '\';';
        $db->execute($sql);
        $sql = 'DELETE FROM account
                WHERE id_client = \'' . $id . '\';';
        $db->execute($sql);
    }
}
