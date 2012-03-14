<?php

/*
 *	Description : Registration page
 *	Contributors: harish2k9
 *	File created: 13/03/2012
 *	Last updated: 14/03/2012
 */

require_once "config/config.php";
require_once "Model/User.php";
require_once "Helpers/FormHelper.php";

session_start();

$site_title = "Codders";

if(isset($_SESSION['user_id']))
{
	header("Location: index.php");
}

if(isset($_POST['register']))
{
    $errors = array();
    // validate forms
    if(empty($_POST['email']))
    {
            $errors['email'] = "Required field. Cannot be empty.";
    }
    if(empty($_POST['password']))
    {
            $errors['password'] = "Required field. Cannot be empty.";
    }
    if($_POST['password'] != $_POST['confirm_password'])
    {
            $errors['confirm_password'] = "Passwords do not match.";
    }
    if(empty($errors))
    {
        // check to see if the email already exists
        $user = User::FindByEmail($_POST['email']);
        if($user == NULL)
        {
            $errors['main'] = "Email address already registered!";
        }
        else
        {
            // register the user details and forward them to login page.
            $user = new User();
            $user->email = $_POST['email'];
            $user->password = sha1($_POST['password']);
            $user->date_registered = date("Y-m-d H:i:s");
            if(!$user->save())
            {
                $errors['main'] = "Something went wrong. Try again later!";
            }
            else
            {
                header("Location: login.php");
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register - <?php echo $site_title; ?></title>
        <link rel="stylesheet" href="styles/master.css" type="text/css" />
</head>
<body>
	<?php include("templates/header.inc"); ?>
	<?php include("templates/navigation.inc"); ?>
	<h2>Register</h2>
        <?php
        echo FormHelper::begin(NULL, "post", isset($errors['main']) ? $errors['main'] : NULL);
        echo FormHelper::email(array("label"=>"Email", "name"=>"email",
                    "value"=>isset($_POST['email']) ? $_POST['email'] : NULL,
                    "error"=>isset($errors['email']) ? $errors['email'] : NULL));
        echo FormHelper::password(array("label"=>"Password", "name"=>"password",
                    "error"=>isset($errors['password']) ? $errors['password'] : NULL));
        echo FormHelper::password(array("label"=>"Confirm Password", "name"=>"confirm_password", "id"=>"confirm_password",
                    "error"=>isset($errors['confirm_password']) ? $errors['confirm_password'] : NULL));
        echo FormHelper::end(array("name"=>"register", "value"=>"Register"));
        
        include("templates/footer.inc"); 
        ?>
</body>
</html>