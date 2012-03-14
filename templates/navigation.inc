<nav>
	<ul>
		<li id="home"><a href="index.php" title="Home"><?php echo $site_title; ?></a></li>
		<?php
		if(isset($_SESSION['user_id']))
		{
			echo "<li id=\"logout\"><a href='logout.php' title='Logout'>Logout</a></li>";
		}
		else
		{
			echo "<li id=\"login\"><a href='login.php' title='Login'>Login</a></li>";
			echo "<li id=\"register\"><a href='register.php' title='Register'>Register</a></li>";
		}
		?>
	</ul>
</nav>