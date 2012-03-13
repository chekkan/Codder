<?php

/*
 *	Description	: Registration page
 *	Contributors: harish2k9
 *	File created: 13/03/2012
 *	Last updated: 13/03/2012
 */

session_start();

$site_title = "Codders";

if(isset($_SESSION['user_id']))
{
	header("Location: index.php");
}

if(isset($_POST['register']))
{
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
		$conn = mysql_connect("localhost", "root", "");
		if(!$conn)
		{
			die("Cannot connect to the server." . mysql_error());
		}
		$selected_db = mysql_select_db("codders");
		if(!$selected_db)
		{
			die("Cannot select database. " . mysql_error());
		}
		$sql = "SELECT user_id FROM users WHERE email=\"{$_POST['email']}\";";
		if(!$result = mysql_query($sql))
		{
			die("Error with query! " . mysql_error());
		}
		if(mysql_num_rows($result) == 1)
		{
			$errors['main'] = "Email address already registered!";
		}
		else
		{
			// register the user details and forward them to login page.
			$sql = "INSERT INTO users(email, password, date_registered)
					VALUES(\"{$_POST['email']}\", \"".sha1($_POST['password'])."\", \"".date("Y-m-d H:i:s")."\");";
			if(!$result = mysql_query($sql))
			{
				die("Error with query! " . mysql_error());
			}
			if(mysql_affected_rows($conn) == 0)
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
</head>
<body>
	<?php include("templates/header.inc"); ?>
	<?php include("templates/navigation.inc"); ?>
	<h2>Register</h2>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<?php if(isset($errors['main'])) echo "<p class=\"email\">{$errors['main']}</p>"; ?>
		<div>
			<label for="email">Email</label>
			<?php if(isset($errors['email'])) echo "<p class='error'>{$errors['email']}</p>"; ?>
			<input type="email" id="email" name="email" placeholder="you@domain.com"
				<?php if(isset($_POST['email'])) echo "value=\"{$_POST['email']}\""; ?>
			/>
		</div>
		<div>
			<label for="password">Password</label>
			<?php if(isset($errors['password'])) echo "<p class='error'>{$errors['password']}</p>"; ?>
			<input type="password" id="password" name="password" />
		</div>
		<div>
			<label for="confirm_password">Confirm Password</label>
			<?php if(isset($errors['confirm_password'])) echo "<p class='error'>{$errors['confirm_password']}</p>"; ?>
			<input type="password" id="confirm_passsword" name="confirm_password" />
		</div>
		<div>
			<input type="submit" name="register" value="Register" />
		</div>
	</form>
	<?php include("templates/footer.inc"); ?>
</body>
</html>