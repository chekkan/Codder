<?php
/*
 * 	Description	: Index page
 * 	Contributors: harish2k9
 * 	File created: 12/03/2012
 * 	Last updated: 13/03/2012
 */

session_start();

$site_title = "Codders";
?>

<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $site_title; ?></title>
        <link rel="stylesheet" href="styles/master.css" type="text/css" />
    </head>
    <body>
        <?php include("templates/header.inc"); ?>
        <?php include("templates/navigation.inc"); ?>
        <?php include("templates/footer.inc"); ?>
    </body>
</html>