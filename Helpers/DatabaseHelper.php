<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DatabaseHelper
 *
 * @author Harish
 */
class DatabaseHelper {
    
    private $conn;
    private $selected_db;
    
    public function __construct($server, $user, $password, $dbName) {
        $this->connect($server, $user, $password, $dbName);
    }
    
    private function connect($server, $user, $password, $dbName)
    {
        if(!$this->conn = mysql_connect($server, $user, $password))
        {    
            die("Error connecting to the database!" . mysql_error($this->conn));
        }
        if(!$this->selected_db = mysql_select_db($dbName, $this->conn))
        {
            die("Error selecting the database! " . mysql_error($this->conn));
        }
    }
    
    public function query($sql)
    {
        if(!$result = mysql_query($sql, $this->conn))
        {
            die("Error with the query! " . mysql_error($this->conn));
        }
        
        return $result;
    }
    
    public function fetch_assoc($result)
    {
        return mysql_fetch_assoc($result);
    }
    
    public function num_rows($result)
    {
        return mysql_num_rows($result);
    }
    
    public function affected_rows()
    {
        return mysql_affected_rows($this->conn);
    }
}

?>
