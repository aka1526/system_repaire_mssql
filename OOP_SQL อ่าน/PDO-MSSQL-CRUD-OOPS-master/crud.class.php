<?php

/* 
 * @author Rohan Shah
 * NovumLogic
 * @imrohan22
 */

class Database {
    /*
     * Extra variables that are required by other function such as boolean con variable
     */
    private $conn = false; // Check to see if the connection is active
    private $result = array(); // Any results from a query will be stored here
    private $myQuery = ""; // used for debugging process with SQL return
    private $numResults = ""; // used for returning the number of rows
    //
    // Function to make connection to database
    // Change following details fro your connection. 
    // DONT KEEP SQUARE BRACKETS i.e. '[]'
    private $server = "sqlsrv:Server=[SERVER_NAME];Database=[DatabaseName]";
    private $user = "[USERNAME]";
    private $pass = "[PASSWORD]";
//    private $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,);
    protected static $connection;
    protected $con;

    /**
     * Connect to the database     * 
     * @return bool false on failure / PDO object instance on success
     */
    public function connect() {
        try {
            // Try and connect to the database
            if (!isset($this->con)) {
                $this->con = new PDO($this->server, $this->user, $this->pass);
                $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $this->con;
            }
        } catch (PDOException $e) {
            echo "There is some problem in connection: " . $e->getMessage();
        }
    }

    public function sql($sql) {
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $this->myQuery = $sql; // Pass back the SQL

        if ($stmt->rowCount() > 0) {
            // If the query returns >= 1 assign the number of rows to numResults
            $this->numResults = $stmt->rowCount();
            // Loop through the query results by the number of rows returned
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($this->result, $row);
            }
            return true; // Query was successful
        } else {
            return false; // No rows where returned
        }
    }

    // Function to SELECT from the database
    public function select($table, $rows = '*', $join = null, $where = null, $order = null, $limit = null) {
        // Create query from the variables passed to the function
        $q = 'SELECT ' . $rows . ' FROM ' . $table;
        if ($join != null) {
            $q .= ' JOIN ' . $join;
        }
        if ($where != null) {
            $q .= ' WHERE ' . $where;
        }
        if ($order != null) {
            $q .= ' ORDER BY ' . $order;
        }
        if ($limit != null) {
            $q .= ' LIMIT ' . $limit;
        }
        // Check to see if the table exists
        if ($this->tableExists($table)) {
            $this->myQuery = $q; // Pass back the SQL
            $stmt = $this->con->prepare($q);
            $stmt->execute();
            $this->numResults = $stmt->rowCount();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($this->result, $row);
            }
            return true;
        } else {
            return false; // Table does not exist
        }
    }

    // Function to insert into the database
    public function insert($table, $params = array()) {
        // Check to see if the table exists
        if ($this->tableExists($table)) {
            $sql = "INSERT INTO " . $table . " (" . implode(", ", array_keys($params)) . ") VALUES ('" . implode("', '", $params) . "')";
            $this->myQuery = $sql; // Pass back the SQL
            // Make the query to insert to the database
            try {
                $stmt = $this->con->prepare($sql);
                $stmt->execute();
                array_push($this->result, $this->con->lastInsertId());
                return true; // The data has been inserted
            } catch (PDOException $exception) {
                array_push($this->result, $exception->getMessage());
                return false; // The data has not been inserted                
            }
        } else {
            return false; // Table does not exist
        }
    }

    //Function to delete table or row(s) from database
    public function delete($table, $where = null) {
        // Check to see if table exists
        if ($this->tableExists($table)) {
            // The table exists check to see if we are deleting rows or table
            if ($where == null) {
                $delete = 'DELETE ' . $table; // Create query to delete table
            } else {
                $delete = 'DELETE FROM ' . $table . ' WHERE ' . $where; // Create query to delete rows
            }
            // Submit query to database
            try {
                $stmt = $this->con->prepare($delete);
                $stmt->execute();
                array_push($this->result, $stmt->rowCount());
                $this->myQuery = $delete; // Pass back the SQL
                return true; // Update has been successful
            } catch (PDOException $exception) {
                array_push($this->result, $exception->getMessage());
                return false; // Update has not been successful
            }
        } else {
            return false; // The table does not exist
        }
    }

    // Function to update row in database
    public function update($table, $params = array(), $where) {
        // Check to see if table exists
        if ($this->tableExists($table)) {
            // Create Array to hold all the columns to update
            $args = array();
            foreach ($params as $field => $value) {
                // Seperate each column out with it's corresponding value
                $args[] = $field . "='" . $value . "'";
            }
            // Create the query
            $sql = 'UPDATE ' . $table . ' SET ' . implode(',', $args) . ' WHERE ' . $where;
            // Make query to database
            $this->myQuery = $sql; // Pass back the SQL
            try {
                $stmt = $this->con->prepare($sql);
                $stmt->execute();
                array_push($this->result, $stmt->rowCount());
                return true; // Update has been successful
            } catch (PDOException $exception) {
                array_push($this->result, $exception->getMessage());
                return false; // Update has not been successful
            }
        } else {
            return false; // The table does not exist
        }
    }

    // Private function to check if table exists for use with queries
    private function tableExists($table) {
        // Try a select statement against the table
        // Run it in try/catch in case PDO is in ERRMODE_EXCEPTION.
        try {
            $result = $this->con->query("select top 1 * from $table");
        } catch (Exception $e) {
            // We got an exception == table not found
            return FALSE;
        }
        // Result is either boolean FALSE (no table found) or PDOStatement Object (table found)
        return $result !== FALSE;
    }

    // Public function to return the data to the user
    public function getResult() {
        $val = $this->result;
        $this->result = array();
        return $val;
    }

    //Pass the SQL back for debugging
    public function getSql() {
        $val = $this->myQuery;
        $this->myQuery = array();
        return $val;
    }

    //Pass the number of rows back
    public function numRows() {
        $val = $this->numResults;
        $this->numResults = array();
        return $val;
    }

}
