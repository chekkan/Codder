<?php

/*
 *	Description : Login page
 *	Contributors: harish2k9
 *	File created: 12/03/2012
 *	Last updated: 14/03/2012
 */

require_once "config/config.php";
require_once "Model/User.php";
require_once "Helpers/FormHelper.php";
 
session_start();

if(isset($_SESSION['user_id']))
{
	header("Location: index.php");
}
 
$site_title = "Codders";

if(isset($_POST['login']))
{
    $errors = array();
    // check if the forms are valid
    if(empty($_POST['email']))
    {
        $errors['email'] = "Required field. Cannot be empty!";
    }
    if(empty($_POST['password']))
    {
    	$errors['password'] = "Required field. Cannot be empty!";
    }
	
    if(empty($errors))
    {
        if(!User::Authenticate($_POST['email'], $_POST['password']))
        {
            $errors['main'] = "Email and password combination doesn't exist!";
        }
        else
        {
            // login the user
            $user = User::FindByEmail($_POST['email']);
            $_SESSION['user_id'] = $user->id;
            header("Location: index.php");
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login - <?php echo $site_title; ?></title>
        <link rel="stylesheet" href="styles/master.css" type="text/css" />
</head>
<body>
	<?php include("templates/header.inc"); ?>
	<?php include("templates/navigation.inc"); ?>
	<h2>Login</h2>
	<?php
        echo FormHelper::begin(NULL, "post", isset($errors['main'])? $errors['main'] : NULL);
        echo FormHelper::email(array("label"=>"Email", "name="=>"email", 
                            "value"=>isset($_POST['email'])? $_POST['email'] : NULL,
                            "error"=>isset($errors['email']) ? $errors['email'] : NULL));
        echo FormHelper::password(array("label"=>"Password", "name"=>"password",
                        "error"=>isset($errors['password']) ? $errors['password'] : NULL));
        echo FormHelper::end(array("name"=>"login", "value"=>"Login"));
	
        include("templates/footer.inc"); ?>
</body>
</html>