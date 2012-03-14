<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author Harish
 */
require_once '../config/config.php';
require_once '../Helpers/DatabaseHelper.php';

class User {
    //put your code here
    
    public $id;
    public $email;
    public $password;
    public $date_registered;
    
    public static function FindById($id)
    {
        $db = new DatabaseHelper(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $sql = "SELECT * FROM users WHERE user_id = \"{$id}\" LIMIT 1;";
        $result = $db->query($sql);
        
        $row = $db->fetch_assoc($result);
        
        $user                   = new User();
        $user->id               = $row['user_id'];
        $user->email            = $row['email'];
        $user->password         = $row['password'];
        $user->date_registered  = $row['date_registered'];
        
        return $user;
    }
    
    public static function Authenticate($email, $password)
    {
        $db = new DatabaseHelper(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $sql = "SELECT * FROM users 
                WHERE email = \"{$email}\"
                AND password = \"".sha1($password)."\"
                LIMIT 1;";
        $result = $db->query($sql);
        
        return ($db->num_rows($result) == 1) ? true : false;
    }
    
    public static function FindByEmail($email)
    {
        $db = new DatabaseHelper(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $sql = "SELECT * FROM users WHERE email = \"{$email}\" LIMIT 1;";
        $result = $db->query($sql);
        
        if($db->num_rows($result) == 1)
        {
            $row = $db->fetch_assoc($result);

            $user                   = new User();
            $user->id               = $row['user_id'];
            $user->email            = $row['email'];
            $user->password         = $row['password'];
            $user->date_registered  = $row['date_registered'];

            return $user;
        }
        else
        {
            return NULL;
        }
    }
    
    public function Save()
    {
        if(!isset($this->id))
        {
            return $this->Create();
        }
        else
        {
            return false;
        }
    }
    
    public function Create()
    {
        $db = new DatabaseHelper(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $sql = "INSERT INTO users(email, password, date_registered)
                    VALUES(\"{$this->email}\", \"{$this->password}\", \"{$this->date_registered}\");";
        $db->query($sql);
        if($db->affected_rows() == 1)
        {
            $this->id = $db->insert_id();
            return true;
        }
        else
        {
            return false;
        }
    }
}

?>
