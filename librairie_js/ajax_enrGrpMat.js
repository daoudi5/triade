enrGrpMat = function (idclasse,listeMatiere,nomgrp,leap,retourAffiche)
{
	var divid=retourAffiche;
	var myAjax = new Ajax.Request(
		"ajaxEnrGrpMat.php",
		{	method: "post",
			asynchronous: true,
			parameters: "idclasse="+idclasse+"&listeMatiere="+listeMatiere+"&nomgrp="+nomgrp+"&leap="+leap,
			timeout: 5000,
			onComplete: function (request) {
				if ("ok" == request.responseText)  {
					$(divid).innerHTML="<i>Mati�res enregistr�es.</i>";
				}else{
					$(divid).innerHTML="<b>Mati�re non enregistr� !!!</b>";
				}
			}
		}
	);
	
	var myGlobalHandlers = {
		onLoading: function(){$(divid).innerHTML = '&nbsp;&nbsp;&nbsp;<font class="T2" color="black">Sauvegarde en cours ...</font> <img src="./image/temps1.gif" align="center" />';}
	};
	Ajax.Responders.register(myGlobalHandlers);

}
