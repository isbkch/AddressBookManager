/*Fonction permattant de recuperer une cookie par son nom et de tester si elle exsite
	@param c_name : nom du cookie
	return Nom du cookie 
*/
function getCookie(c_name){
	if (document.cookie.length>0) {
	c_start=document.cookie.indexOf(c_name + "=");
		if (c_start!=-1){
			c_start=c_start + c_name.length+1;
			c_end=document.cookie.indexOf(";",c_start);
			if (c_end==-1) c_end=document.cookie.length;
			return unescape(document.cookie.substring(c_start,c_end));
		}
	}
	return "";
}
/*Fonction permattant d'ecrire une cookie
	@param c_name : nom du cookie
	@param value : valeur du cookie
	@param expiredays : délais d'expiration du cookie
*/
function setCookie(c_name,value,expiredays){
	var exdate=new Date();
	exdate.setDate(exdate.getDate()+expiredays);
	document.cookie=c_name+ "=" +escape(value)+
	((expiredays==null) ? "" : ";expires="+exdate.toUTCString());
}	

/*Fonction permattant de tester si un cookie existe*/
function checkCookieRec(){
	v_cookie=getCookie('lang');
	if (!v_cookie){ //L'internaute vient de visiter la page pour la premiere fois, pas de cookies
		updateStatus();
	}
	if ( v_cookie != null && v_cookie == 'fr'){ 
		updateStatus();
		//L'internaute a deja visité le site au moins une fois les 3 dernieres jours
	}		
}