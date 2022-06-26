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
   xhr.open("GET", "./script/get-message.php?action=" + action, true);
    xhr.send(null);
     
    
}
 
function readData(sData) {    
    if (sData.length > 0) {
	document.getElementById('cadre_chat').innerHTML = sData;
	}
	else {
	document.getElementById('cadre_chat').innerHTML = '<center><b>No messages for the moment</b></center>';
	}
}
setInterval('request(readData)',400);
function request_status(callback) {
    var xhr = getXMLHttpRequest();
     
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            callback(xhr.responseText);
        }
    };
 
   
     
    xhr.open("GET", "./script/get-status.php", true);
    xhr.send(null);
}
 
function readData_status(sData) {
    document.getElementById('membres_connectes').innerHTML = sData;
}
setInterval('request_status(readData_status)',200);
function post() {
  var xhr = getXMLHttpRequest();
     
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            callback(xhr.responseText);
         write(msg);
        }
    };
    msg = (document.getElementById("message").value);
    urls = [];
    if (msg.includes("http://") || msg.includes("https://")) {
   var reg=new RegExp("((https?://)[a-zA-Z0-9/.]+)+","gi");
   msg = msg.replace(reg, "<A href='$1' target=_blank>$1</A>") + "<BR>";
    } else if  (msg.includes("@")){
       var reg=new RegExp("(()[a-zA-Z0-9/.]+)+","gi");
   msg = msg.replace(reg, "<A href='https://weblinkchat.pq.lu/chat/profile.php?user=$1'  target=_blank>$1</A>") + "<BR>";
    } else{
        msg = msg; 
    }
      xhr.open("POST", "https://weblinkchat.pq.lu/chat/script/post.php?message=" + msg, true);
      xhr.send(null);
	  
      document.getElementById("message").value = '';
      }
      
function postprivate() {
  var xhr = getXMLHttpRequest();
     
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            callback(xhr.responseText);
         write(msg);
        }
    };
    var msg = (document.getElementById("message").value);
      xhr.open("GET", "./script/postprivate.php?message=" + msg, true);
      xhr.send(null);
	  
      document.getElementById("message").value = '';
      }
      
function set_status() {
  var xhr = getXMLHttpRequest();
     
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            callback(xhr.responseText);
            ;
        }
    };
    var status = encodeURIComponent(document.getElementById("status").value);
      xhr.open("GET", "./script/set_status.php?status=" + status, true);
      xhr.send(null);
      }
