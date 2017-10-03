<script>
function getRequete2() {
	if (window.XMLHttpRequest) { 
        	result = new XMLHttpRequest();     // Firefox, Safari, ...
	}else { 
	      if (window.ActiveXObject)  {
	      result = new ActiveXObject("Microsoft.XMLHTTP");    // Internet Explorer 
	      }
       	}
	return result;
}

function CnxEnCours() {
	var requete = getRequete2();
	var corps="nb="+encodeURIComponent(nb);
	if (requete != null) {
		requete.open("POST","verifConnex2.php",true);
		requete.onreadystatechange = function() { 
	    		if(requete.readyState == 4) {
	       			if(requete.status == 200) {
					if (requete.responseText == "2") {
						alertSessionClose();
					}
					if (requete.responseText == "1") {
						location.href='verrou.php';
					}	
				}
  			};
		} 
		requete.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  		requete.send(corps); 
	}
}

var nb=0;
function CnxAjax() {
	CnxEnCours(nb);
	nb++;
	window.setTimeout("CnxAjax()","300000"); //300000 -> 5 minutes
}
CnxAjax();

</script>
