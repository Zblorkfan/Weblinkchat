
<?php
session_start();
require('functions.php');
$bdd = bdd_connect();
$pseudo = "'".$_SESSION["pseudo"]."'"; 
$for = "'".$_GET["user"]."'" ;
if($_GET['action'] == 'new') {

$reponse = $bdd->query("SELECT fromwho, forwho, text FROM private_messages WHERE fromwho = $for AND forwho = $pseudo OR fromwho = $pseudo AND forwho = $for ORDER BY time DESC LIMIT 10  ");


while ($donnees = $reponse->fetch())
{
    $pseudo = $donnees['fromwho'];
    $texte = $donnees['text'];
	echo '<p  style="background-color: #C8C8C8"><span style="color: red;">' . $pseudo . '</span><br><span style="font-weight: bolder"> ' . $texte . '</span></p>';
	
}

$reponse->closeCursor();
}
if ($_GET['action'] == 'anc') {
  $reponse_2 = $bdd->query('SELECT pseudo, message FROM ancien_message ORDER BY id DESC ');


while ($donnees_2 = $reponse_2->fetch())
{
    $pseudo_2 = $donnees_2['pseudo'];
    $texte_2 = $donnees_2['message'];
    $message_2 = smiley($texte_2);
	echo '<p style="background-color: #C8C8C8"><span style="color: red;">' . $pseudo_2 . '</span><br><span> ' . $message_2 . '</span></p>';
}

$reponse_2->closeCursor();
}
