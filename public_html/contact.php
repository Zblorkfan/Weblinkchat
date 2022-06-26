<?php
/*
    ********************************************************************************************
    CONFIGURATION
    ********************************************************************************************
*/
// destinataire est votre adresse mail. Pour envoyer à plusieurs à la fois, séparez-les par une virgule
$destinataire = 'contact@weblinkchat.pq.lu';

// copie ? (envoie une copie au visiteur)
$copie = 'oui';

// Action du formulaire (si votre page a des paramètres dans l'URL)
// si cette page est index.php?page=contact alors mettez index.php?page=contact
// sinon, laissez vide
$form_action = '';

$message_envoye = "Message sent successfully";
$message_non_envoye = "Failed, please try again.";

/*
    ********************************************************************************************
    FIN DE LA CONFIGURATION
    ********************************************************************************************
*/


/*
 * cette fonction sert à nettoyer et enregistrer un texte
 */
function Rec($text)
{
    $text = htmlspecialchars(trim($text), ENT_QUOTES);
    if (1 === get_magic_quotes_gpc())
    {
        $text = stripslashes($text);
    }

    $text = nl2br($text);
    return $text;
};

/*
 * Cette fonction sert à vérifier la syntaxe d'un email
 */
function IsEmail($email)
{
    $value = preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $email);
    return (($value === 0) || ($value === false)) ? false : true;
}

// formulaire envoyé, on récupère tous les champs.
$nom     = (isset($_POST['nom']))     ? Rec($_POST['nom'])     : '';
$email   = (isset($_POST['email']))   ? Rec($_POST['email'])   : '';
$objet   = (isset($_POST['objet']))   ? Rec($_POST['objet'])   : '';
$message = (isset($_POST['message'])) ? Rec($_POST['message']) : '';

// On va vérifier les variables et l'email ...
$email = (IsEmail($email)) ? $email : ''; // soit l'email est vide si erroné, soit il vaut l'email entré
$err_formulaire = false; // sert pour remplir le formulaire en cas d'erreur si besoin

if (isset($_POST['envoi']))
{
    if (($nom != '') && ($email != '') && ($objet != '') && ($message != ''))
    {
        // les 4 variables sont remplies, on génère puis envoie le mail
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'From:'.$nom.' <'.$email.'>' . "\r\n" .
                'Reply-To:'.$email. "\r\n" .
                'Content-Type: text/plain; charset="utf-8"; DelSp="Yes"; format=flowed '."\r\n" .
                'Content-Disposition: inline'. "\r\n" .
                'Content-Transfer-Encoding: 7bit'." \r\n" .
                'X-Mailer:PHP/'.phpversion();

        // envoyer une copie au visiteur ?
        if ($copie == 'oui')
        {
            $cible = $destinataire.';'.$email;
        }
        else
        {
            $cible = $destinataire;
        };

        // Remplacement de certains caractères spéciaux
        $message = str_replace("&#039;","'",$message);
        $message = str_replace("&#8217;","'",$message);
        $message = str_replace("&quot;",'"',$message);
        $message = str_replace('<br>','',$message);
        $message = str_replace('<br />','',$message);
        $message = str_replace("&lt;","<",$message);
        $message = str_replace("&gt;",">",$message);
        $message = str_replace("&amp;","&",$message);

        // Envoi du mail
        $num_emails = 0;
        $tmp = explode(';', $cible);
        foreach($tmp as $email_destinataire)
        {
            if (mail($email_destinataire, $objet, $message, $headers))
                $num_emails++;
        }

        if ((($copie == 'oui') && ($num_emails == 2)) || (($copie == 'non') && ($num_emails == 1)))
        {
            echo '<p>'.$message_envoye.'</p>';
            header('Location: https://weblinkchat.pq.lu/chat/login.php'); 
        }
        else
        {
            echo '<p>'.$message_non_envoye.'</p><a href="https://weblinkchat.pq.lu/chat/login.php">Back to login</a>';
            
        };
    }
    else
    {
        // une des 3 variables (ou plus) est vide ...
        echo '<p>'.$message_formulaire_invalide.'</p>';
        $err_formulaire = true;
    };
}; // fin du if (!isset($_POST['envoi']))

if (($err_formulaire) || (!isset($_POST['envoi'])))
{
    // afficher le formulaire
    echo '
    <head>
    <title>Contact | Weblinkchat</title>
  <link rel="icon" href="chat/images/weblink(1).ico">

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
    </head>
    <body style="background-color: violet">
    <form id="contact" method="post" action="'.$form_action.'">
    
        <p><label for="nom">Name :</label><br><input style="width: 250px" type="text" id="nom" name="nom" value="'.stripslashes($nom).'" tabindex="1" /></p>
        <p><label for="email">Mail :</label><br><input style="width: 250px" type="text" id="email" name="email" value="'.stripslashes($email).'" tabindex="2" /></p>
        <p><label for="objet">Topic :</label><br><input style="width: 250px" type="text" id="objet" name="objet" value="'.stripslashes($objet).'" tabindex="3" /></p>
        <p><label for="message">Message :</label><br><textarea style="width: 500px; height: 200px; font-family: serif" id="message" name="message" tabindex="4" cols="30" rows="8">'.stripslashes($message).'</textarea></p>
    

    <div style="text-align: left;"><input type="submit" name="envoi" value="Send" /></div>
    </form>
    <p>Sinon : <br>contact@weblinkchat.pq.lu</p></body>';
};
?>