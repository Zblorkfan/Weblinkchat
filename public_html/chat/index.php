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
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title>Weblinkchat</title>
          <link rel="icon" type="image/x-icon" href="images/weblink(1).ico">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script href="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script href="getMessage.js" type="text/javascript"></script>
        <script src="oXHR.js" type="text/javascript" ></script>
        <script type="text/javascript" src="script.js"></script>
        <script src="script_ancMsg.js" type="text/javascript" ></script>
    </head>
    
  
    <style type="text/css">
  body{
      background-color: violet; 
  }
  #cadre_chat
{
  border: 3px solid grey;
  text-align: justify;
  width: 99%;
  height: 550px;
  overflow: auto;
  background-color : whitesmoke;
  padding: 3px;
   }
#hello{
    background-color: white; 
    padding: 2px; 
    border-radius: 2px; 
} 
* {
  box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column1 {
  float: left;
  width: 65%;
  padding: 10px;
  height: 100%; /* Should be removed. Only for demonstration */
}
.column2 {
  float: left;
  width: 35%;
  padding: 10px;
  height: 100%; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
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
    <body onLoad="request(readData), request_status(readData_status)" onUnload="go('deconnect.php')\">
    <noscript>
    <meta http-equiv="refresh" content="0;URL=./script/no-js.htm">
    </noscript>

<div class="row">
  <div class="column1" style="background-color: violet;">
    <span id="hello" >
    <?php
    hello(); 
    ?>
    </span><br><br>
    <div id="cadre_chat">

</div>

<br> <div id="inputmsg1">
        <label for="message"></label><input style="width: 80%; " onKeyPress="if(event.keyCode==13){post(); clear();}" name="message" id="message" maxlength="100" placeholder="Type in your message ..."/>
        <input type="button" onClick="post(), clear()" value="Send message" />
 </div> 

  </div>
  <div class="column2" style="background-color: violet;">

  <span id="deconnexion">
<h1 style="float: left; font-size: 60px; font-family: courier new; color: white">WEBLINKCHAT</h1><br><br><br>
     </span> <a href="./script/deconnexion.php" style="text-decoration: none; background-color: blueviolet; color: white; padding: 4px; border-radius: 2px; float: right">Log out</a><br>
<br>    <br><br><br>
    <div id="change" style="background-color: white; border-radius: 3px; padding: 4px">
     <h3><a href="change.php?action=1" style="color: blueviolet; font-weight: bold; text-decoration: none">Change password</a></h3>
     <h3><a href="changebio.php?action=4" style="color: blueviolet; font-weight: bold; text-decoration: none">Change bio</a></h3>
     <h3><a href="change.php?action=4" style="color: blueviolet; font-weight: bold; text-decoration: none">Change pseudo</a></h3>
     <h3><a href="change.php?action=3" style="color: blueviolet; font-weight: bold; text-decoration: none">Delete my account</a></h3>
</div>
<br><br>
    <div style="background-color: white; border-radius: 3px">
    <span id="ad" style="text-decoration: underline"><h3>Online members : </h3></span>
    <div id="membres_connectes" style="color: blueviolet">
    </div>
    </div>
    
  </div>
</div>
   
  <script>


function go( laPagePHP )

{

document.location.href = laPagePHP;

}

</script>
  

    </body>
</html>
<?php
}
?>