<?php
session_start();
require('functions.php');

$bdd = bdd_connect();
delete_msg();
$req = $bdd->prepare('INSERT INTO private_messages (fromwho, forwho, text, time) VALUES(:pseudo, :forwho, :text, :time)');
$req->execute(array(
  'pseudo' => $_SESSION['pseudo'],
  'forwho' => $_GET['user'],
  'text' => $_GET['message'],
  'time' => time(),
  

  ));

header('Location: index.php');
  

?>
