<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="refresh" content="1,URL=./../index.php">
<meta charset="utf-8" />
</head>
<body>
<?php
require ('functions.php');
delete_user($_SESSION['ip']);
deconnexion();
?></body>
</html>