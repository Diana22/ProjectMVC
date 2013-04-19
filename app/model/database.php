<?php
/**
 * Class for handling database connections.
 */
<<<<<<< HEAD
include_once "../config/config.php";
=======

>>>>>>> 1c016585f2512610d378e8703b516ce9487c3e92
class model_database {

	// Connection object
	var $connection = NULL;

	// Singleton instance for database connection
	static $instance = NULL;

	/**
	 * Returns singleton database connection. If connection doesn't exist it is created.
	 */
	public static function instance() {

		// First it checks if connection was already created
		if (isset(self::$instance)) {
			return self::$instance;
		}

		// Creates the singleton instance for database connection
		global $config;
		self::$instance = new model_database;
		self::$instance->connect($config['database']['server'], $config['database']['user'], 
			$config['database']['password'], $config['database']['name']);

		return self::$instance;
	}

	/**
	 * Connects to database.
	 *
	 * @param $server MySQL server
	 * @param $user MySQL user
	 * @param $password MySQL password
	 * @param $name MySQL database
	 * @return Boolean
	 */
	private function connect($server, $user, $password, $name) {

		// Connects to mysql
		$this->connection = mysql_connect($server, $user, $password) 
			or die('Eroare conexiune mysql');

		// Selects DB
    	if (!mysql_select_db($name, $this->connection)) {
    		die('Eroare selectare baza de date');
    	}

    	return TRUE;
	}

	/**
	 * Does a query on database and returns all rows.
	 */
	public function get_rows($sql) {
	    $result = mysql_query($sql, $this->connection);
	    $rows = array();
	    while ($row = mysql_fetch_assoc($result)) {
	      $rows[] = $row;
	    }
	    return $rows;
	}

	/**
	 * Does a query on database and returns first row.
	 */
<<<<<<< HEAD
	public  function get_row($sql) {
	    $result = mysql_query($sql, $this->connection);
	    return mysql_fetch_assoc($result);
=======
	public function get_row($sql) {
	    if ($result = mysql_query($sql, $this->connection)) {
		    return mysql_fetch_assoc($result);
	    }
	    return FALSE;
>>>>>>> 1c016585f2512610d378e8703b516ce9487c3e92
	}

	/**
	 * Executes a query on database and number of affected columns.
	 */
	public function execute($sql) {
	    $result = mysql_query($sql, $this->connection);
	    return mysql_affected_rows($this->connection);
	}
    public function last_insert_id(){
        return mysql_insert_id ($this->connection);
    }

}
