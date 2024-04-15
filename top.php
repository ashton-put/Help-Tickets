<?php
$phpSelf = htmlspecialchars($_SERVER['PHP_SELF']);
$pathParts = pathinfo($phpSelf);
?>
<!-- the top document, all the head stuff and meta stuff and links to the connecting to the DB files -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>UVM 2024 Hackathon</title>
        <meta name="author" content="Ashton Putnam - 2024 CS Crew Treasurer">
        <meta name="description" content="This website is the help ticket system for the UVM 2024 Hackathon.">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="SHORTCUT ICON" type="image/x-icon" href="images/logo.ico">
        <link rel="stylesheet" href="css/style.css?version=<?php print time(); ?>" type="text/css">
        <link rel="stylesheet" media="(max-width: 600px)" href="css/custom-style.css?version=<?php print time(); ?>" type="text/css">
    </head>

<?php
print '<body id="' . $pathParts['filename'] . '">';

include 'connect-DB.php';

include 'header.php';

include 'nav.php';
?>