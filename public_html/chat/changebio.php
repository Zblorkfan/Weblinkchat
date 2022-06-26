<?php
session_start();
require ('./script/functions.php');
$bdd = bdd_connect();
delete_msg();
if ($_SESSION['pseudo'] == NULL) {
    header('Location: login.php');
    }
    if(isset($_GET['action']) && $_GET['action'] == 4) {
        echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
              <head>
               <style>
               body{
                background-color: violet; 

               }
               input{
                   width: 200px
               }  
               body div h1 {
  color: #0dd9e3 !important;
  text-shadow: 2px 2px #007e9b !important;
}

div.column2 div {
  border: 2px grey solid;
}

div.column2 div#membres_connectes a {
  background-color:inherit !important;
}

div.column2 div#change a {
  background-color:inherit !important;
  color: #0028ff !important;
}

div#cadre_chat p {
  background-color: #dbdbdb !important;
}

div#cadre_chat a {
  color: #0000ee !important;
}

span#deconnexion h1 {
  color: #0dd9e3 !important;
  text-shadow: 2px 2px #007e9b !important;
}

div.column2 a {
  background-color: #0028ff !important;
}

#membres_connectes {
 border: none !important;
}

#change {
  border: 2px grey solid;
}

#cadre_chat {
  border: 2px #dbdbdb solid !important;;
}

.column1 {
  background-color: inherit !important;;
}

.column2 {
  background-color: inherit !important;
}

#title {
  color: #0dd9e3;
  text-shadow: 2px 2px #007e9b;
}

p {
  color : black;
}

a {
  text-decoration: none;
  color: white;
  font-weight: bold;
}

body { 
  font-family: Courier new;
  background-color: #96ff80 !important;
}

#wrap {
  width: 100%;
  height: 50px;
  z-index: 99;
  position: fixed;
  background-color: #00b536;
}

.navbar {
  height: 50px;
  padding: 0;
  margin: 0;
  float: left;
  position: sticky;
}

.navbar li {
  height: auto;
  width: 135.8px;
  float: left;
  text-align: center;
  list-style: none;
  font: normal bold 13px/1em Arial, Verdana, Helvetica;
  padding: 0;
  background-color: inherit;
}

.navbar a {
  padding: 18px 0;
  text-decoration: none;
  color: white;
  display: block;
}

.navbar li ul {
  display: none;
  height: auto;
  margin: 0;
  padding: 0;
}

.navbar li:hover ul {
  display: block;
}

.navbar li ul li {
  background-color: inherit;
}

a:hover{
    color: #55f7ff;
}
  
.wrapper{
  position: absolute;
  bottom: 110px;
  left: 50px;
  max-width: 365px;
  background: #fff;
  padding: 25px 25px 30px 25px;
  border-radius: 15px;
  box-shadow: 1px 7px 14px -5px rgba(0,0,0,0.15);
  text-align: center;
}

.wrapper.hide{
  opacity: 0;
  pointer-events: none;
  transform: scale(0.8);
  transition: all 0.3s ease;
}

::selection{
  color: #fff;
  background: #FCBA7F;
}

.wrapper img{
  max-width: 90px;
}

.content header{
  font-size: 25px;
  font-weight: 600;
}

.content{
  margin-top: 10px;
}

.content p{
  color: red;
  margin: 5px 0 20px 0;
}

.content .buttons{
  display: flex;
  align-items: center;
  justify-content: center;
}

.buttons button{
  padding: 10px 20px;
  border: none;
  outline: none;
  color: #fff;
  font-size: 16px;
  font-weight: 500;
  border-radius: 5px;
  background: orangered;
  cursor: pointer;
  transition: all 0.2s ease;
}

.buttons button:hover{
  transform: scale(1);
}

.buttons .item{
  margin: 0 10px;
}

.buttons a{
  color: blanchedalmond;
}





  
               </style> 
              <meta charset="utf-8" />
              <title>Change pseudo</title>
              <meta language="FR" />
               <link rel="icon" type="image/x-icon" href="images/weblink(1).ico">
              </head>
              <body>
              <form method="POST" action="change.php?action=8"><center>
              <table>
              <tr><td><label for="mdp">Password :</label><br><input type="password" name="mdp" /></td></tr>
              <tr><td><label for="newpseudo">New bio :</label><br><input type="text" name="newpseudo" /></td></tr>
              <tr><td><input type="submit" value="Change" /></td></tr>
              </table></center></form>
              </body>
              </html>';
        }
          elseif(isset($_GET['action']) && $_GET['action'] == 8) {
          $mdp = crypt_mdp(htmlspecialchars($_POST['mdp']));
          $bdd = bdd_connect();
          $pseudo = $_SESSION['pseudo'];
          $query = $bdd->prepare('SELECT account_pass FROM chat_accounts WHERE account_login = :pseudo');
          $query->execute(array('pseudo' => $_SESSION['pseudo']));
          $mdp2 = $query->fetchColumn();
          if ($mdp == $mdp2) {
           $query_1 = $bdd->prepare('UPDATE chat_accounts SET bio = :newpseudo WHERE account_login = :pseudo');
           $query_1->execute(array(
           'newlogin' => htmlspecialchars($_POST['newpseudo']),
           'pseudo' => $_SESSION['pseudo']
           ));
         
           echo $_SESSION['bio'].' is your new bio';
           echo '<br /><a href="index.php">Back to chat</a>';
           }
           else {
            echo 'Incorrect password';
            echo '<br /><a href="index.php">Back to chat</a>';
            }
            }
           
          
        