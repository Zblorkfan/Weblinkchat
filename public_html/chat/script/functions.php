<?php
function bdd_connect() {
$dsn = 'mysql:dbname=your-dbname;host=localhost';
$user = 'your-username';
$password = 'your_password';
try {
    $bdd = new PDO($dsn, $user, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed' . $e->getMessage();
}
return $bdd;
    }
function psw_verif() {
  $password = htmlspecialchars($_POST['password']);
  $password_confirm = htmlspecialchars($_POST['password_confirm']);
    if ($password == $password_confirm) {
        $psw_verif = true;
        }
          else {
            $psw_verif = false;
            }
            return $psw_verif;
            }

function crypt_mdp ($mdp_a_crypte) {
$mdp = $mdp_a_crypte;
for ($i=0;$i<65535;$i++) { 
$mdp = sha1($mdp);
$mdp = md5($mdp);
}
return $mdp;
}
function inscription() {
 $verif_mail = verif_mail();
 if ($verif_mail == true) {
 $psw_verif = psw_verif();
  if ($psw_verif == true) {
      $bdd = bdd_connect();
   
 
    $query = $bdd->prepare("SELECT * FROM chat_accounts WHERE account_login = :login");
    $query->execute(array(
        'login' => htmlspecialchars($_POST['pseudo'])
          ));
          $count=$query->rowCount();
            if($count == 0)
              {
                $insert = $bdd->prepare('
                  INSERT INTO chat_accounts (account_login, account_pass, mail, prenom, bio)
                  VALUES(:account_login, :account_pass, :mail, :prenom, :bio)
                  ');
                  $insert->execute(array(
                    'account_login' => htmlspecialchars($_POST['pseudo']),
                    'account_pass' => crypt_mdp(htmlspecialchars($_POST['password'])),
                    'mail' => htmlspecialchars($_POST['email']),
                    'prenom' => htmlspecialchars($_POST['prenom']),
                    'bio' => htmlspecialchars($_POST['bio']),
                    ));
                    echo "<head>
                    <style>
                    
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
                    <title>Registration completed</title>  <link rel='icon' type='image/x-icon' href='https://weblinkchat.pq.lu/chat/images/weblink(1).ico'></head><body style='background-color: violet'><h1 style='margin: auto'>Registration completed successfully ! <a href='./../login.php'>Home</a></h1></body>";
                    header('Refresh: 4; URL=httpS://weblinkchat.pq.lu/chat/login.php');
                    }
                      else {
                        echo 'This pseudo already exist';
                        }
      
        }
        else {
        echo 'The two passwords are differents !';
        }
   
  }
               else {
                  echo 'An account already uses this email';
                  }
                  
                  }
                  
                  
function delete_msg() {
  $bdd = bdd_connect();
  $time_out = time()-900;
  $recup_message = $bdd->prepare('SELECT * FROM chat_messages WHERE timestamp < :time');
  $recup_message->execute(array(
  'time' => $time_out
  ));
  while ($message = $recup_message->fetch()) {
      $query_1 = $bdd->prepare('INSERT INTO ancien_message (message, pseudo) VALUES (:message, :pseudo)');
      $query_1->execute(array(
      'message' => $message['message_text'],
      'pseudo' => $message['pseudo'],
      ));
      }
  $query = $bdd->prepare("DELETE FROM chat_messages WHERE timestamp < :time");
  $query->execute(array(
      'time' => $time_out
      ));
   
      }
function user_connect() {
  $pseudo = htmlspecialchars($_POST['pseudo']);
  $ip = $_SERVER["REMOTE_ADDR"];
  $bdd = bdd_connect($ip, $pseudo);
    $query = $bdd->prepare("
        INSERT INTO chat_online (online_ip, online_user, online_time)
        VALUES(:online_ip, :online_user, :online_time)
        ");
        $query->execute(array(
        'online_ip' => $ip,
        'online_user' => $pseudo,
        'online_time' => time(),
        ));
        }
  function is_user_connect($pseudo) {
      $bdd = bdd_connect();
      
      $ip = $_SERVER["REMOTE_ADDR"];
      $query = $bdd->prepare('
      SELECT * FROM chat_online WHERE online_user = :pseudo 
      ');
      $query->execute(array(
      'pseudo' => $pseudo,
    
      ));
      $count = $query->rowCount();
          if ($count == 0) {
              $is_user_connect = false;
              }
              else {
                $is_user_connect = true;
                }
                return $is_user_connect;
                }
 function delete_user($ip_suppr) {
    $bdd = bdd_connect();
    $time_out = time()-60;
      $query = $bdd->prepare('
      DELETE FROM chat_online WHERE online_ip = :ip 
      '); 
      $query->execute(array(
      'ip' => $ip_suppr,
      ));
      }
 function maj_connect() {
    $bdd = bdd_connect();
    $ip = $_SERVER["REMOTE_ADDR"];
    $pseudo = $_SESSION['pseudo'];
    $time = time();
    $query = $bdd->prepare('
    SELECT * FROM chat_online WHERE online_user = :pseudo
    ');
    $query->execute(array(
    'pseudo' => $pseudo,
    ));
    $count = $query->rowCount();
      if ($count == 0) {
          $maj = $bdd->prepare("
            INSERT INTO chat_online (online_ip, online_user, online_time)
        VALUES(:online_ip, :online_user, :online_time)
        ");
        $maj->execute(array(
        'online_ip' => $ip,
        'online_user' => $pseudo,
        'online_time' => time(),
        ));
            }
            else {}
            }
function hello() {
  $heure = date("H");
  $bdd = bdd_connect();
  $query = $bdd->prepare("
    SELECT account_login FROM chat_accounts WHERE account_login = :pseudo
    ");
    $query->execute(array(
    'pseudo' => $_SESSION['pseudo'],
    ));
    $reponse = $query->fetch();
      $ps = $reponse['account_login'];
      echo 'You come to chat, '. $ps .' ?' ;
       }
function verif_mail() {
$bdd = bdd_connect();
$mail = htmlspecialchars($_POST['email']);
$query = $bdd->prepare('
  SELECT * FROM chat_accounts WHERE mail = :mail
  ');
  $query->execute(array(
  'mail' => $mail,
  ));
$count = $query->rowCount();
    if ($count == 0)
     {
        $verif_mail = true;
        }
      else
      {
          $verif_mail = false;
          }
     return $verif_mail;
  }
function deconnexion() {
  session_destroy();
  
  }
function smiley($texte) {
 
return $texte;
}

function user_connecte() {
  $bdd = bdd_connect();
  $reponse = $bdd->query('SELECT * FROM chat_online');
  while ($donnees = $reponse->fetch()) {
      
      $user_status = $donnees['online_status'];
      
      if ($user_status == 0) {
          echo '<a class="lien_info" style="text-decoration:none;color:black;" href="user_info.php?user='.$donnees['online_user'].'" />'.$donnees['online_user'].'</a>'.'    <img src="/image/vert.png" alt="En ligne"/><br />';
          }
              elseif ($user_status == 1) {
                echo '<a class="lien_info" style="text-decoration:none;color:black;" href="user_info.php?user='.$donnees['online_user'].'" />'.$donnees['online_user'].'</a>'.'    <img src="/image/orange.png" alt="Occupé"/><br />';
                }
                    elseif ($user_status == 2) {
                      echo '<a class="lien_info" style="text-decoration:none;color:black;" href="user_info.php?user='.$donnees['online_user'].'" />'.$donnees['online_user'].'</a>'.'    <img src="/image/rouge.png" alt="Absent"/><br />';
                      }
                     else {
                      echo '<a class="lien_info" style="text-decoration:none;color:black;" href="user_info.php?user='.$donnees['online_user'].' />"'.$donnees['online_user'].'</a>'.'    <img src="/image/vert.png" /><br />';
                      }
      
      
      
      }
      }
      

    function get_message() {
      $bdd = bdd_connect();
        $reponse = $bdd->query('SELECT pseudo, message_text FROM chat_messages ORDER BY message_id ASC LIMIT 0, 50');


while ($donnees = $reponse->fetch())
{
    $pseudo = $donnees['pseudo'];
    $texte = htmlspecialchars($donnees['message_text']);
    $message = char(smiley($texte));
	echo '<p><strong>' . $pseudo . '</strong> : ' . $message . '</p>';
}

$reponse->closeCursor();
    }
    ?>
