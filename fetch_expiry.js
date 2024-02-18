// JavaScript Document
function expire(str)
{ alert(str);
	
	if (str == "") {
        document.getElementById("edate").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("edate").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","fetch_expiry.php?e="+str,true);
        xmlhttp.send();
    }

	
	
}
// JavaScript Document