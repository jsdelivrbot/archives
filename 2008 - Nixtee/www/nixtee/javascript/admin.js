var nb_moderer=0;

function moderer(act, id) {
	
	$.ajax({
		  type: "GET",
		  url: "pages/admin/commentaires/ajax_moderer.php?act="+act+"&id="+id,
		  dataType: "text",
		  success: function(id){
			$("#com_"+id).remove();
			}
		})
	nb_moderer++;
	
	$("#nb").text(parseInt($("#nb").text()-1));
	
	if (nb_moderer==20) {
		window.location.replace("admin.php?commentaires-amoderer");	
	}
	
}


function modalDialogShow_IE(url,width,height) //IE
	{
	return window.showModalDialog(url,window,
		"dialogWidth:"+width+"px;dialogHeight:"+height+"px;edge:Raised;center:Yes;help:No;Resizable:Yes;Maximize:Yes");
	}
function modalDialogShow_Moz(url,width,height) //Moz
    {
    var left = screen.availWidth/2 - width/2;
    var top = screen.availHeight/2 - height/2;
    activeModalWin = window.open(url, "", "width="+width+"px,height="+height+",left="+left+",top="+top);
    window.onfocus = function(){if (activeModalWin.closed == false){activeModalWin.focus();};};
    }
var sActiveAssetInput;
function setAssetValue(v) //required by the asset manager
    {
    document.getElementById(sActiveAssetInput).value = v;
	if (document.getElementById('img_select')) document.getElementById('img_select').src=v;
    }
function openAsset(s)
	{
	sActiveAssetInput = s
	if(navigator.appName.indexOf('Microsoft')!=-1){
		document.getElementById(sActiveAssetInput).value=modalDialogShow_IE("javascript/editor3/assetmanager/assetmanager.php?lang=french",640,465); //IE
		if (document.getElementById('img_select')) document.getElementById('img_select').src=document.getElementById(sActiveAssetInput).value; }
	else {
		modalDialogShow_Moz("javascript/editor3/assetmanager/assetmanager.php?lang=french",640,465); //Moz	
		}
	}
	
	
	
	
/*
 * 
 * TableSorter 2.0 - Client-side table sorting with ease!
 * Version 2.0.1
 * @requires jQuery v1.2.1
 * 
 * Copyright (c) 2007 Christian Bach
 * Examples and docs at: http://tablesorter.com
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 * 
 */
eval(function(p,a,c,k,e,d){e=function(c){return(c<a?"":e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('(8($){$.1V({I:D 8(){7 C=[],1d=[];k.2v={28:"3Z",2b:"48",29:"49",2P:"4a",2D:"4b",1I:1E,1w:"25",C:{},1d:[],1m:{S:["2c","2L"]},x:{},2u:K,2Q:13,u:[],1y:[],1l:"2O",J:K};8 17(s,d){1h(s+","+(D T().1e()-d.1e())+"4c")}k.17=17;8 1h(s){q(1u 1P!="2S"&&1u 1P.J!="2S"){1P.1h(s)}N{2V(s)}}8 1T(6,$x){q(6.f.J){7 1O=""}7 G=6.L[0].G;q(6.L[0].G[0]){7 Z=[],12=G[0].12,l=12.w;y(7 i=0;i<l;i++){7 p=K;q($.1o&&($($x[i]).16()&&$($x[i]).16().1g)){p=1K($($x[i]).16().1g)}N q((6.f.x[i]&&6.f.x[i].1g)){p=1K(6.f.x[i].1g)}q(!p){p=22(6.f,12[i])}q(6.f.J){1O+="1D:"+i+" 1B:"+p.B+"\\n"}Z.R(p)}}q(6.f.J){1h(1O)}m Z};8 22(f,V){7 l=C.w;y(7 i=1;i<l;i++){q(C[i].O($.1M(1Q(f,V)))){m C[i]}}m C[0]}8 1K(1x){7 l=C.w;y(7 i=0;i<l;i++){q(C[i].B.14()==1x.14()){m C[i]}}m K}8 1U(6){q(6.f.J){7 23=D T()}7 19=(6.L[0]&&6.L[0].G.w)||0,2r=(6.L[0].G[0]&&6.L[0].G[0].12.w)||0,C=6.f.C,F={1c:[],1j:[]};y(7 i=0;i<19;++i){7 c=6.L[0].G[i],1p=[];F.1c.R($(c));y(7 j=0;j<2r;++j){1p.R(C[j].H(1Q(6.f,c.12[j]),6,c.12[j]))}1p.R(i);F.1j.R(1p);1p=1E};q(6.f.J){17("2W F y "+19+" G:",23)}m F};8 1Q(f,V){q(!V)m"";7 t="";q(f.1w=="25"){q(V.1L[0]&&V.1L[0].2X()){t=V.1L[0].1S}N{t=V.1S}}N{q(1u(f.1w)=="8"){t=f.1w(V)}N{t=$(V).1i()}}m t}8 1G(6,F){q(6.f.J){7 2U=D T()}7 c=F,r=c.1c,n=c.1j,19=n.w,1J=(n[0].w-1),2h=$(6.L[0]),G=[];y(7 i=0;i<19;i++){G.R(r[n[i][1J]]);q(!6.f.20){7 o=r[n[i][1J]];7 l=o.w;y(7 j=0;j<l;j++){2h[0].32(o[j])}}}q(6.f.20){6.f.20(6,G)}G=1E;q(6.f.J){17("4d 6:",2U)}1z(6)};8 2x(6){q(6.f.J){7 1f=D T()}7 1o=($.1o)?13:K,27=[];y(7 i=0;i<6.1t.G.w;i++){27[i]=0};$1r=$("35 37",6);$1r.1s(8(1F){k.1a=0;k.1D=1F;k.18=2B(6.f.2P);q(2d(k)||2e(6,1F))k.1C=13;q(!k.1C){$(k).1q(6.f.28)}6.f.1y[1F]=k});q(6.f.J){17("3a x:",1f);1h($1r)}m $1r};8 2K(6,G,1c){7 1k=[],r=6.1t.G,c=r[1c].12;y(7 i=0;i<c.w;i++){7 11=c[i];q(11.41>1){1k=1k.3b(2K(6,3c,1c++))}N{q(6.1t.w==1||(11.3e>1||!r[1c+1])){1k.R(11)}}}m 1k};8 2d(11){q(($.1o)&&($(11).16().1g===K)){m 13};m K}8 2e(6,i){q((6.f.x[i])&&(6.f.x[i].1g===K)){m 13};m K}8 1z(6){7 c=6.f.1d;7 l=c.w;y(7 i=0;i<l;i++){1Z(c[i]).H(6)}}8 1Z(1x){7 l=1d.w;y(7 i=0;i<l;i++){q(1d[i].B.14()==1x.14()){m 1d[i]}}};8 2B(v){q(1u(v)!="3i"){i=(v.14()=="3j")?1:0}N{i=(v==(0||1))?v:0}m i}8 2E(v,a){7 l=a.w;y(7 i=0;i<l;i++){q(a[i][0]==v){m 13}}m K}8 1W(6,$x,Z,S){$x.1H(S[0]).1H(S[1]);7 h=[];$x.1s(8(3L){q(!k.1C){h[k.1D]=$(k)}});7 l=Z.w;y(7 i=0;i<l;i++){h[Z[i][0]].1q(S[Z[i][1]])}}8 2z(6,$x){7 c=6.f;q(c.2u){7 1v=$(\'<1v>\');$("2j:3l 3H",6.L[0]).1s(8(){1v.3G($(\'<3o>\').S(\'2l\',$(k).2l()))});$(6).3r(1v)}}8 2M(6,u){7 c=6.f,l=u.w;y(7 i=0;i<l;i++){7 s=u[i],o=c.1y[s[0]];o.1a=s[1];o.1a++}}8 1Y(6,u,F){q(6.f.J){7 2m=D T()}7 Y="7 2k = 8(a,b) {",l=u.w;y(7 i=0;i<l;i++){7 c=u[i][0];7 18=u[i][1];7 s=(2s(6.f.C,c)=="1i")?((18==0)?"2n":"2o"):((18==0)?"2p":"2q");7 e="e"+i;Y+="7 "+e+" = "+s+"(a["+c+"],b["+c+"]); ";Y+="q("+e+") { m "+e+"; } ";Y+="N { "}7 1N=F.1j[0].w-1;Y+="m a["+1N+"]-b["+1N+"];";y(7 i=0;i<l;i++){Y+="}; "}Y+="m 0; ";Y+="}; ";3t(Y);F.1j.3u(2k);q(6.f.J){17("3w 3x "+u.3z()+" 3A 3B "+18+" 1f:",2m)}m F};8 2n(a,b){m((a<b)?-1:((a>b)?1:0))};8 2o(a,b){m((b<a)?-1:((b>a)?1:0))};8 2p(a,b){m a-b};8 2q(a,b){m b-a};8 2s(C,i){m C[i].Q};k.2f=8(2w){m k.1s(8(){q(!k.1t||!k.L)m;7 $k,$3E,$x,F,f,3F=0,3I;k.f={};f=$.1V(k.f,$.I.2v,2w);$k=$(k);$x=2x(k);k.f.C=1T(k,$x);F=1U(k);7 1X=[f.29,f.2b];2z(k);$x.3K(8(e){7 19=($k[0].L[0]&&$k[0].L[0].G.w)||0;q(!k.1C&&19>0){7 $11=$(k);7 i=k.1D;k.18=k.1a++%2;q(!e[f.2D]){f.u=[];q(f.1I!=1E){7 a=f.1I;y(7 j=0;j<a.w;j++){f.u.R(a[j])}}f.u.R([i,k.18])}N{q(2E(i,f.u)){y(7 j=0;j<f.u.w;j++){7 s=f.u[j],o=f.1y[s[0]];q(s[0]==i){o.1a=s[1];o.1a++;s[1]=o.1a%2}}}N{f.u.R([i,k.18])}};$k.1R("3S");1W($k[0],$x,f.u,1X);3T(8(){1G($k[0],1Y($k[0],f.u,F));$k.1R("3U")},0);m K}}).3V(8(){q(f.2Q){k.3X=8(){m K};m K}});$k.1n("3Y",8(){k.f.C=1T(k,$x);F=1U(k)}).1n("2J",8(e,Z){f.u=Z;7 u=f.u;2M(k,u);1W(k,$x,u,1X);1G(k,1Y(k,u,F))}).1n("44",8(){1G(k,F)}).1n("45",8(e,B){1Z(B).H(k)}).1n("47",8(){1z(k)});q($.1o&&($(k).16()&&$(k).16().2N)){f.u=$(k).16().2N}q(f.u.w>0){$k.1R("2J",[f.u])}1z(k)})};k.P=8(1B){7 l=C.w,a=13;y(7 i=0;i<l;i++){q(C[i].B.14()==1B.B.14()){a=K}}q(a){C.R(1B)}};k.2R=8(21){1d.R(21)};k.U=8(s){7 i=2Y(s);m(26(i))?0:i};k.2Z=8(s){7 i=30(s);m(26(i))?0:i};k.33=8(6){q($.34.36){8 2I(){38(k.2a)k.39(k.2a)}2I.3d(6.L[0])}N{6.L[0].1S=""}}}});$.3f.1V({I:$.I.2f});7 M=$.I;M.P({B:"1i",O:8(s){m 13},H:8(s){m $.1M(s.14())},Q:"1i"});M.P({B:"3k",O:8(s){m/^\\d+$/.15(s)},H:8(s){m $.I.U(s)},Q:"W"});M.P({B:"3m",O:8(s){m/^[3n�$3p��?.]/.15(s)},H:8(s){m $.I.U(s.X(D 1b(/[^0-9.]/g),""))},Q:"W"});M.P({B:"3s",O:8(s){m s.2G(D 1b(/^(\\+|-)?[0-9]+\\.[0-9]+((E|e)(\\+|-)?[0-9]+)?$/))},H:8(s){m $.I.U(s.X(D 1b(/,/),""))},Q:"W"});M.P({B:"3v",O:8(s){m/^\\d{2,3}[\\.]\\d{2,3}[\\.]\\d{2,3}[\\.]\\d{2,3}$/.15(s)},H:8(s){7 a=s.3y("."),r="",l=a.w;y(7 i=0;i<l;i++){7 1A=a[i];q(1A.w==2){r+="0"+1A}N{r+=1A}}m $.I.U(r)},Q:"W"});M.P({B:"3J",O:8(s){m/^(2y?|2A|2C):\\/\\/$/.15(s)},H:8(s){m 2T.1M(s.X(D 1b(/(2y?|2A|2C):\\/\\//),\'\'))},Q:"1i"});M.P({B:"3P",O:8(s){m/^\\d{4}[\\/-]\\d{1,2}[\\/-]\\d{1,2}$/.15(s)},H:8(s){m $.I.U((s!="")?D T(s.X(D 1b(/-/g),"/")).1e():"0")},Q:"W"});M.P({B:"3Q",O:8(s){m/^\\d{1,3}%$/.15(s)},H:8(s){m $.I.U(s.X(D 1b(/%/g),""))},Q:"W"});M.P({B:"3R",O:8(s){m s.2G(D 1b(/^[A-3W-z]{3,10}\\.? [0-9]{1,2}, ([0-9]{4}|\'?[0-9]{2}) (([0-2]?[0-9]:[0-5][0-9])|([0-1]?[0-9]:[0-5][0-9]\\s(40|42)))$/))},H:8(s){m $.I.U(D T(s).1e())},Q:"W"});M.P({B:"43",O:8(s){m/\\d{1,2}[\\/\\-]\\d{1,2}[\\/\\-]\\d{2,4}/.15(s)},H:8(s,6){7 c=6.f;s=s.X(/\\-/g,"/");q(c.1l=="2O"){s=s.X(/(\\d{1,2})[\\/\\-](\\d{1,2})[\\/\\-](\\d{4})/,"$3/$1/$2")}N q(c.1l=="46"){s=s.X(/(\\d{1,2})[\\/\\-](\\d{1,2})[\\/\\-](\\d{4})/,"$3/$2/$1")}N q(c.1l=="2t/24/2g"||c.1l=="2t-24-2g"){s=s.X(/(\\d{1,2})[\\/\\-](\\d{1,2})[\\/\\-](\\d{2})/,"$1/$2/$3")}m $.I.U(D T(s).1e())},Q:"W"});M.P({B:"1f",O:8(s){m/^(([0-2]?[0-9]:[0-5][0-9])|([0-1]?[0-9]:[0-5][0-9]\\s(3g|3h)))$/.15(s)},H:8(s){m $.I.U(D T("3q/2i/2i "+s).1e())},Q:"W"});M.P({B:"3D",O:8(s){m K},H:8(s,6,11){7 c=6.f,p=(!c.2F)?\'3M\':c.2F;m $(11).16()[p]},Q:"W"});M.2R({B:"31",H:8(6){q(6.f.J){7 1f=D T()}$("2j:3C",6.L[0]).2H(\':2c\').1H(6.f.1m.S[1]).1q(6.f.1m.S[0]).3O().2H(\':2L\').1H(6.f.1m.S[0]).1q(6.f.1m.S[1]);q(6.f.J){$.I.17("3N 4e 21",1f)}}})})(2T);',62,263,'||||||table|var|function|||||||config|||||this||return||||if||||sortList||length|headers|for|||id|parsers|new||cache|rows|format|tablesorter|debug|false|tBodies|ts|else|is|addParser|type|push|css|Date|formatFloat|node|numeric|replace|dynamicExp|list||cell|cells|true|toLowerCase|test|data|benchmark|order|totalRows|count|RegExp|row|widgets|getTime|time|sorter|log|text|normalized|arr|dateFormat|widgetZebra|bind|meta|cols|addClass|tableHeaders|each|tHead|typeof|colgroup|textExtraction|name|headerList|applyWidget|item|parser|sortDisabled|column|null|index|appendToTable|removeClass|sortForce|checkCell|getParserById|childNodes|trim|orgOrderCol|parsersDebug|console|getElementText|trigger|innerHTML|buildParserCache|buildCache|extend|setHeadersCss|sortCSS|multisort|getWidgetById|appender|widget|detectParserForColumn|cacheTime|mm|simple|isNaN|tableHeadersRows|cssHeader|cssDesc|firstChild|cssAsc|even|checkHeaderMetadata|checkHeaderOptions|construct|yy|tableBody|01|tr|sortWrapper|width|sortTime|sortText|sortTextDesc|sortNumeric|sortNumericDesc|totalCells|getCachedSortType|dd|widthFixed|defaults|settings|buildHeaders|https|fixColumnWidth|ftp|formatSortingOrder|file|sortMultiSortKey|isValueInArray|parserMetadataName|match|filter|empty|sorton|checkCellColSpan|odd|updateHeaderSortCount|sortlist|us|sortInitialOrder|cancelSelection|addWidget|undefined|jQuery|appendTime|alert|Building|hasChildNodes|parseFloat|formatInt|parseInt|zebra|appendChild|clearTableBody|browser|thead|msie|th|while|removeChild|Built|concat|headerArr|apply|rowSpan|fn|am|pm|Number|desc|integer|first|currency|�|col|�|2000|prepend|floating|eval|sort|ipAddress|Sorting|on|split|toString|and|dir|visible|metadata|document|shiftDown|append|td|sortOrder|url|click|offset|sortValue|Applying|end|isoDate|percent|usLongDate|sortStart|setTimeout|sortEnd|mousedown|Za|onselectstart|update|header|AM|colSpan|PM|shortDate|appendCache|applyWidgetId|uk|applyWidgets|headerSortUp|headerSortDown|asc|shiftKey|ms|Rebuilt|Zebra'.split('|'),0,{}))


