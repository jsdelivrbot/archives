
function showWriteCom() 
{

	$("#posterComDetail").DropInUp(1000, function() { 
		$("#posterCom").fadeTo('fast', 0.01);
	});
}

function comSend() {
	_mess=escape($('#messageBG').val());
	_id=escape($('#id_breve').val());
	
	if (_mess.length<10) { alert('Votre message est trop court !'); return false }
	if (_id==0) { alert('Erreur : News inconnue'); return false }
	
	$("#submitbreve").val("Envoie en cours...");
	$("#submitbreve").attr('disable');
	ajax('post', 'pages/breves_ajax.php?act=com_send','message='+_mess+'&id='+_id, 'comSend2');
	
	

}

function comSend2(r) {
	
	if (unescape(r)!="ok") { alert('Une erreur est survenue durant l\'envoie de votre message.'); }
	else {
		$('#posterCom').html("<span style='color:#00A8FF; font-weight:bold'>Votre commentaire a �t� post� avec succ�s !</span>");
		$("#posterComDetail").fadeOut(1000);
		$("#posterCom").DropInDown(1000);	
		
	}
	
}

// Avis aux amateurs : sa ne sert � rien d'essayer de hacker le site via ses fonctions, si je les est laiss� visibles,
// c'est bien entendu car il n'y a aucun risque.
// La page appel� en ajax v�rifiera bien entendu si vous �tes admin :)
function adSuppr(id, idBreve) {
	ajax('get', 'pages/breves_ajax.php','act=com_suppr&id='+id+'&idBreve='+idBreve, 'adSuppr2');
}
function adSuppr2(r) {
	$("#com"+unescape(r)).remove();
}
function adEdit(id) {
	var offset = {}; 
	$("#com"+id).offset({ scroll: false }, offset);
	topp = offset['top'];
	
	$("#window").css({height:'255px', width:'460px', top:topp+'px'});
	$('#windowContent').css({height:'200px', width:'420px'});
	$("#windowContent").load(_URL+"pages/breves_ajax.php?act=com_edit&id="+id, null, function() { ouvrirFenetreTransfert('com'+id); } );
}