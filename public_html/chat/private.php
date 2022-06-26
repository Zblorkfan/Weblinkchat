<?php
session_start();
require ('./script/functions.php');
$bdd = bdd_connect();

delete_msg();

if ($_SESSION['pseudo'] == NULL) {
    header('Location: login.php');
    }
      else {
?>
<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=mtmgetce_chat', 'mtmgetce_chat', '@Nn1vers@1re'); // création de l'instance
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // les erreurs deviennent des exceptions
    $pseudo = "'".$_SESSION['pseudo']."'"; 
    $for = "'".$_GET['user']."'";
    

    $reponse = $bdd->query("SELECT fromwho, forwho, text FROM private_messages WHERE fromwho = $for AND forwho = $pseudo OR fromwho = $pseudo AND forwho = $for ");
 
    // Affichage du résultat
    while ($donnees = $reponse->fetch(PDO::FETCH_ASSOC)) {
        echo $donnees['fromwho']." says ".$donnees['text']."<br>";
       
    
    }
     $reponse->closeCursor(); 
} catch (PDOException $e) {
    // S'il y a une erreur, on affiche le code de l'exception ainsi que le message
    exit('PDOException #' . $e->getCode() . ': ' . $e->getMessage());
}

?>
  
    <?php
}
?>