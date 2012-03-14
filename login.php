<?php

/*
 *	Description : Login page
 *	Contributors: harish2k9
 *	File created: 12/03/2012
 *	Last updated: 14/03/2012
 */

require_once "config/config.php";
require_once "Helpers/DatabaseHelper.php";
 
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
        // check if the user exist
        $db = new DatabaseHelper(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $sql = "SELECT * FROM users WHERE email='{$_POST['email']}' AND password='".sha1($_POST['password'])."';";
        $result = $db->query($sql);
        if(!$result)
        {
            die("Error with the query. " . mysql_error());
        }

        if($db->num_rows($result) != 1)
        {
            $errors['main'] = "Email and password combination doesn't exist!";
        }
        else
        {
            // login the user
            $user = $db->fetch_assoc($result);
            $_SESSION['user_id'] = $user['user_id'];
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
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<?php if(isset($errors['main'])) { echo "<p class='error'>{$errors['main']}</p>"; } ?>
		<div>
			<label for="email">Email</label>
			<?php if (isset($errors['email'])) { echo "<p class='error'>{$errors['email']}</p>"; } ?>
			<input type="email" id="email" name="email" placeholder="you@domain.com"
				<?php if(isset($_POST['email'])) echo "value=\"{$_POST['email']}\""; ?>
			/>
		</div>
		<div>
			<label for="password">Password</label>
			<?php if (isset($errors['password'])) { echo "<p class='error'>{$errors['password']}</p>"; } ?>
			<input type="password" id="password" name="password" />
		</div>
		<div>
			<input type="submit" name="login" value="Login" />
		</div>
	</form>
	
	<?php include("templates/footer.inc"); ?>
</body>
</html>