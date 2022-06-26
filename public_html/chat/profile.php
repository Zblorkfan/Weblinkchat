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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  <html  xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
    <title><?php
      echo $_GET['user'];
      echo ' | Weblinkchat'
      ?>
      </title>
      <style>
      body{
          background-color: violet; 
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
.mpopup {
    display: none;
    position: fixed;
    z-index: 1;
    padding-top: 75px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.4);
}
.modal-content {
    position: relative;
    background-color: #fff;
    margin: auto;
    padding: 0;
    width: 1100px;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s;
    border-radius: 0.3rem;
}
.modal-header {
    padding: 2px 12px;
    background-color: #ffffff;
    color: #333;
    border-bottom: 1px solid #e9ecef;
    border-top-left-radius: 0.3rem;
    border-top-right-radius: 0.3rem;
}
.modal-header h2{
    font-size: 1.25rem;
    margin-top: 14px;
    margin-bottom: 14px;
}
.modal-body {
    padding: 2px 12px;
}
.modal-footer {
    padding: 1rem;
    background-color: #ffffff;
    color: #333;
    border-top: 1px solid #e9ecef;
    border-bottom-left-radius: 0.3rem;
    border-bottom-right-radius: 0.3rem;
    text-align: right;
}

.close {
    color: #888;
    float: right;
    font-size: 28px;
    font-weight: bold;
}
.close:hover, .close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

/* add animation effects */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}





      </style>
       <script href="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script href="getMessage.js" type="text/javascript"></script>
        <script src="oXHR.js" type="text/javascript" ></script>
        <script type="text/javascript" src="script.js"></script>
        <script src="script_ancMsg.js" type="text/javascript" ></script>
          <link rel="icon" type="image/x-icon" href="images/weblink(1).ico">
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="./css/style_info.css" />
    </head>
    <body onload="reloadiframe(1)>
      <span id="lien_chat"><a href="index.php" style="text-decoration: none; background-color: white; color: violet; margin-left: 5px; padding: 3px">Back to chat</a></span>
    <div id="user_name">
    <center><h2>
    <?php
    echo '<h1 style="font-size: 50px; color: darkblue">@'.''.$_GET['user'].''."</h1>"; 

    ?>
    </h2></center>
    </div>
    <div id="user_info"><center>
    
    <?php
    $bdd = bdd_connect();
    $reponse_status = $bdd->prepare('SELECT online_status FROM chat_online WHERE online_user = :pseudo');
    $reponse_status->execute(array('pseudo' => $_GET['user']));

    
    $reponse = $bdd->prepare('SELECT * FROM chat_accounts WHERE account_login = :pseudo');
    $reponse->execute(array('pseudo' => $_GET['user']));
    $count = $reponse->rowCount();
    if ($count = 1) {
    while ($donnees = $reponse->fetch()) {
      echo $donnees['bio'];
     
      }
        }
       else {
        echo '<h2>User Not found</h2>';
        }
    ?>
    <br>
    <?php
    $bdd = bdd_connect();
    $reponse_status = $bdd->prepare('SELECT online_status FROM chat_online WHERE online_user = :pseudo');
    $reponse_status->execute(array('pseudo' => $_GET['user']));
    
    $reponse = $bdd->prepare('SELECT * FROM chat_accounts WHERE account_login = :pseudo');
    $reponse->execute(array('pseudo' => $_GET['user']));
    $count = $reponse->rowCount();
    if ($count = 1) {
    while ($donnees = $reponse->fetch()) {
      echo $donnees['mail'];
     
      }
        }
       else {
        echo '<h2>User Not found</h2>';
        }
    ?>
    
    </div>
    <div id="messagesprofil" style="background-color: whitesmoke; width: 65%; height: auto; margin: auto;  ">
    <?php
    echo '<center><h1>Last messages : </h1></center>';
    $bdd = bdd_connect();
    $reponse_status = $bdd->prepare('SELECT online_status FROM chat_online WHERE online_user = :pseudo');
    $reponse_status->execute(array('pseudo' => $_GET['user']));
    
    $reponse = $bdd->prepare('SELECT * FROM chat_messages WHERE pseudo = :pseudo');
    $reponse->execute(array('pseudo' => $_GET['user']));
    $count = $reponse->rowCount();
    if ($count = 1) {
    while ($donnees = $reponse->fetch()) {
      echo "<h4 style='text-align: left; margin-left: 10px; color: green'>".' '.$donnees['message_text'].' '."</h4>";
      }
        }
       else {
        echo '<h2>User Not found</h2>';
        }
    ?>
    </center>
    </div>
   
      <br>
       <a href="javascript:void(0);" class="btn btn-primary" id="mpopupLink">
      <h3>Chat with @<?php
      echo $_GET['user']; ?></h3></a>

<!-- Modal popup box -->
<div id="mpopupBox" class="mpopup">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">×</span>
            <h2>Private chat with @<?php
      echo $_GET['user']; ?> </h2>
        </div>
        <div class="modal-body">
        <div id="cadre_chat_prive">
         
  
    </div>
  </div>
  <div id="inputmsg1">
        <label for="message"></label><input style="width: 80%; " onKeyPress="if(event.keyCode==13){postprivate(); clear();}" name="message" id="message" maxlength="100" placeholder="Type in your message ..."/>
        <input type="button" onClick="postprivate(), clear()" value="Send message" />
 
 <br><br></div> 
        
    </div>
</div>
      
<br> 

 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
 </script>

<script>


</script>  

    <script>
    var mpopup = document.getElementById('mpopupBox');

// Select trigger link
var mpLink = document.getElementById("mpopupLink");

// Select close action element
var close = document.getElementsByClassName("close")[0];

// Open modal once the link is clicked
mpLink.onclick = function() {
    mpopup.style.display = "block";
};

// Close modal once close element is clicked
close.onclick = function() {
    mpopup.style.display = "none";
};

// Close modal when user clicks outside of the modal box
window.onclick = function(event) {
    if (event.target == mpopup) {
        mpopup.style.display = "none";
    }
};
    function getXMLHttpRequest() {
    var xhr = null;
     
    if (window.XMLHttpRequest || window.ActiveXObject) {
        if (window.ActiveXObject) {
            try {
                xhr = new ActiveXObject("Msxml2.XMLHTTP");
            } catch(e) {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
        } else {
            xhr = new XMLHttpRequest();
        }
    } else {
        alert("Change your browser");
        return null;
    }
     
    return xhr;
}

function request(callback) {
    var xhr = getXMLHttpRequest();
     
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            
      callback(xhr.responseText);
            
        }
    };
 var action  = encodeURIComponent('new');
   xhr.open("GET", "./script/get-message-private.php?user=<?php
      echo $_GET['user']; ?>&action=" + action, true);
    xhr.send(null);
     
    
}
 
function readData(sData) {    
    if (sData.length > 0) {
  document.getElementById('cadre_chat_prive').innerHTML = sData;
  }
  else {
  document.getElementById('cadre_chat_prive').innerHTML = '<center><b>No messages for the moment</b></center>';
  }
}
setInterval('request(readData)',1000);
function postprivate() {
  var xhr = getXMLHttpRequest();
     
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            callback(xhr.responseText);
         write(msg);
        }
    };
    var msg = document.getElementById("message").value;

        if (msg.includes("http://") || msg.includes("https://")) {
   var reg=new RegExp("((https?://)[a-zA-Z0-9/.]+)+","gi");
   msg = msg.replace(reg, "<A href='$1' target=_blank>$1</A>") + "<BR>";
    } else if  (msg.includes("@")){
       var reg=new RegExp("(()[a-zA-Z0-9/.]+)+","gi");
   msg = msg.replace(reg, "<A href='https://weblinkchat.pq.lu/chat/profile.php?user=$1'  target=_blank>$1</A>") + "<BR>";
    } else{
        msg = msg; 
    }
      xhr.open("GET", "./script/postprivate.php?user=<?php
      echo $_GET['user']; ?>&message=" + msg, true);
      xhr.send(null);
	  
      document.getElementById("message").value = '';
      }

    </script>
  
    </body>
    </html>
    
    <?php
}
?>