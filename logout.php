<?php

/*
 *	Description	: Logout page
 *	Contributors: harish2k9
 *	File created: 12/03/2012
 *	Last updated: 13/03/2012
 */

session_start();

unset($_SESSION['user_id']);

header("Location: login.php");
?>