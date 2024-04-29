<?php

class myDB
{     
    private $_connection;
    private static $_instance; //The single instance
    private  $dbhost = "localhost";
    private  $username = "root";
    private  $password = "";
    private  $dbname = "biemmi_db_ecommerce";


    /*
	Get an instance of the Database
	@return Instance
	*/
    public static function getInstance()
    {
        if (!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    // Constructor
    private function __construct()
    {
        try {
            $this->_connection = new mysqli($this->dbhost, $this->username,  $this->password, $this->dbname);
           
            // Error handling
            if (mysqli_connect_errno()) {
                throw new Exception("Could not connect to database.");
            }
        } catch (Exception $e) {
            if (mysqli_connect_error()) {
                echo "Failed to conencto to MySQL: " . mysqli_connect_error() . E_USER_ERROR;
            }
        }
    }

    // Magic method clone is empty to prevent duplication of connection
    private function __clone()
    {
    }

    // Get mysqli connection
    public function getConnection()
    {
        return $this->_connection;
    }


    // Insert a row/s in a Database Table
    public function Insert($query = "", $types = "", $params = [])
    {
        try {

            $stmt = $this->executeStatement($query, $types, $params);
            $stmt->close();

            return $this->_connection->insert_id;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Select a row/s in a Database Table
    public function Select($query = "", $types  = "", $params = [])
    {
        try {

            $stmt = $this->executeStatement($query, $types, $params);

            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //restituisce array
            $stmt->close();

            return $result;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    // Update a row/s in a Database Table
    public function Update($query = "", $types  = "", $params = [])
    {
        try {

            $this->executeStatement($query, $types, $params)->close();

            return true;
        } catch (Exception $e) {
            //throw new Exception($e->getMessage());

            return false;
        }
    }

    // Remove a row/s in a Database Table
    public function Remove($query = "", $types  = "", $params = [])
    {
        try {

            $this->executeStatement($query, $types, $params)->close();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return false;
    }

    public function beginTransaction()
    {
        $this->_connection->begin_transaction();
    }

    public function commit()
    {
        $this->_connection->commit();
    }

    public function rollback()
    {
        $this->_connection->rollback();
    }

    // execute statement
    private function executeStatement($query = "", $types  = "", $params = [])
    {

        try {
            $stmt = $this->_connection->prepare($query);

            if ($stmt === false) {
                throw new Exception("Unable to do prepared statement: " . $query);
            }

            if ($params && $types) {
                //call_user_func_array(array($stmt, 'bind_param'), $params);

                $stmt->bind_param($types, ...$params);
            }

            $stmt->execute();

            return $stmt;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}