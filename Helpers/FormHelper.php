<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormHelper
 *
 * @author Harish
 */
class FormHelper {
    //put your code here
    
    public static function begin($action=NULL, $method="post", $error=NULL)
    {
        if($action == NULL)
        {
            $action = $_SERVER['PHP_SELF'];
        }
        $return = "\n<form action=\"{$action}\" method=\"{$method}\">";
        if($error != NULL || !empty($error))
        {
            $return .= "\n<p class=\"error\">{$error}</p>";
        }
        return $return;
    }
    
    public static function end($params = NULL)
    {
        if($params == NULL || empty($params) || !is_array($params))
        {
            $params['name'] = "submit";
            $params['value'] = "Submit";
        }
        else
        {
            if(!isset($params['name']))
            {
                $params['name'] = "submit";
            }
            if(!isset($params['value']))
            {
                $params['value'] = "Submit";
            }
        }
        
        $return = "\n<div>";
        $return .= "\n<input type=\"submit\" name=\"{$params['name']}\" value=\"{$params['value']}\" />";
        $return .= "\n</div>";
        $return .= "\n</form>";
        return $return;
    }
    
    public static function input($type, $params = NULL)
    {
        switch($type)
        {
            case "email":
                return self::email($params);
                break;
            case "password":
                return self::password($params);
                break;
            default:
                return "input type not supported!";
                break;
        }
    }
    
    public static function email($params = NULL)
    {
        if($params == NULL || empty($params) || !is_array($params))
        {
            $params['id'] = "email";
            $params['name'] = "email";
            $params['value'] = "";
        }
        else
        {
            if(!isset($params['name']))
            {
                $params['name'] = "email";
            }
            if(!isset($params['id']))
            {
                $params['id'] = "email";
            }
            if(!isset($params['value']))
            {
                $params['value'] =  "";
            }
        }
        $return ="<div>";
        if(isset($params['label']))
        {
            $return .= "\n<label for=\"{$params['id']}\">{$params['label']}</label>";
        }
        if(isset($params['error']))
        {
            $return .= "\n<p class=\"error\">{$params['error']}</p>";
        }
        $return .= "\n<input type=\"email\" name=\"{$params['name']}\" value=\"{$params['value']}\" id=\"{$params['id']}\" />";
        $return .= "\n</div>";
        
        return $return;
    }
    
    public static function password($params = NULL)
    {
        if($params == NULL || empty($params) || !is_array($params))
        {
            $params['id'] = "password";
            $params['name'] = "password";
            $params['value'] = "";
        }
        else
        {
            if(!isset($params['name']))
            {
                $params['name'] = "password";
            }
            if(!isset($params['id']))
            {
                $params['id'] = "password";
            }
            if(!isset($params['value']))
            {
                $params['value'] =  "";
            }
        }
        $return ="\n<div>";
        if(isset($params['label']))
        {
            $return .= "\n<label for=\"{$params['id']}\">{$params['label']}</label>";
        }
        if(isset($params['error']))
        {
            $return .= "\n<p class=\"error\">{$params['error']}</p>";
        }
        $return .= "\n<input type=\"password\" name=\"{$params['name']}\" value=\"{$params['value']}\" id=\"{$params['id']}\" />";
        $return .= "\n</div>";
        
        return $return;
    }
}

?>
