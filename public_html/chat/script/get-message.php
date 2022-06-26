<?php
header("Content-Type: text/plain");
require('functions.php');
$bdd = bdd_connect();
if($_GET['action'] == 'new') {
$reponse = $bdd->query('SELECT pseudo, message_text FROM chat_messages ORDER BY message_id DESC LIMIT 0, 50');


while ($donnees = $reponse->fetch())
{
    $pseudo = $donnees['pseudo'];
    $texte = $donnees['message_text'];
    $message = smiley($texte);
	echo '<p  style="background-color: #C8C8C8"><span style="color: red;">' . $pseudo . '</span><br><span style="font-weight: bolder"> ' . $message . '</span></p>';
	
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