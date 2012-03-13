<nav>
	<ul>
		<li><a href="index.php" title="Home">Home</li>
		<?php
		if(isset($_SESSION['user_id']))
		{
			echo "<li><a href='logout.php' title='Logout'>Logout</a></li>";
		}
		else
		{
			echo "<li><a href='login.php' title='Login'>Login</a></li>";
			echo "<li><a href='register.php' title='Register'>Register</a></li>";
		}
		?>
	</ul>
</nav>