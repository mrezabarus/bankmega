// <script>

function bs_onerror(msg, popup) {
	errwin = this;
	if(popup) errwin = window.open("","","scrollbars=yes,width=500,height=400,resizable=yes", true);
	errwin.document.write("<table width=\"100%\" height=\"100%\"><tr><td align=\"center\" valign=\"middle\">");
	errwin.document.write("<font face=\"arial\" size=\"2\">");
	errwin.document.write(msg);
	errwin.document.write("</font>");
	errwin.document.write("</td></tr></table>");
}

<?

function jsformat($str) {
	$result = $str;
	$result = str_replace("\\","\\\\",$result); $result = str_replace("\f","\\f",$result); $result = str_replace("\b","\\b",$result); $result = str_replace("\r","\\r",$result);
	$result = str_replace("\t","\\t",$result); $result = str_replace("\'","\\'",$result); $result = str_replace("\"","\\\"",$result); $result = str_replace("\n","\\n",$result);
	return $result;
}

function ErrorHandler($errno, $errstr, $errfile, $errline) {
?>
	errlevel = 2;
	bs_onerror("<?=jsformat($errstr)?><hr>File : <?=jsformat($err)?> Line : <?=jsformat($errline)?>", true);
<?
}

error_reporting(0);
$old_error_handler = set_error_handler("Errorhandler");

?>

errlevel = 0;

var bs_oldbscmd;

bsObjects = new Array();
var bsFieldnames = new Array();
var DHTMLSafe;
var bs_count;
var bs_hot;
var bs_oldfontfamily=''; 
var bs_oldfontsize='';
var bs_HTMLMode = new Array();

var tableparamobj=new ActiveXObject("DEInsertTableParam.DEInsertTableParam");
tableparamobj.NumRows=3;
tableparamobj.NumCols=3;   
tableparamobj.Caption="";
tableparamobj.TableAttrs="border=0 cellpadding=0 cellspacing=0 width=100%";
tableparamobj.CellAttrs="";


var is_ie4 = ((parseInt(navigator.appVersion)  == 4) && (navigator.userAgent.toLowerCase().indexOf("msie 5")==-1) && (navigator.userAgent.toLowerCase().indexOf("msie 6")==-1) );

function bs_initialize(num) {
	this.onError = void(null);
	bs_count=num;
	thisContentItem=eval("document.all.bs_tx_content"+num);
	thisForm=thisContentItem;
	while(thisForm.tagName!="FORM"&&thisForm.tagName!="HTML") {
		thisForm=thisForm.parentElement; 
	}
	if(thisForm.tagName!="HTML") {		
		DHTMLSafe = eval("thisForm.DHTMLSafe"+num);
		bsObjects[num] = DHTMLSafe;
		bsObjects[thisContentItem.name] = DHTMLSafe;
		bsFieldnames[num] = thisContentItem.name;		
		thisForm.onsubmit = bs_onSubmit;
	}
	else {
			alert("BSWEBEDIT must be contained in a form.", "", true);
		return;
	}
	DHTMLSafe.NewDocument();
	DHTMLSafe.BaseURL=bs_baseurl[num];
 	set_tbstates(num);
	bs_onLoad(num);
	bs_HTMLMode[num] = false;
}

function bs_onLoad(num) {
	DHTMLSafe=bsObjects[num];
	if(DHTMLSafe.Busy) {
		setTimeout("bs_onLoad("+num+");", 100);	
		return;
	}
	if(num==1) window.onunload = bs_onUnload;
	if(oSel=eval('document.all.oQuickFormat'+num)) { 
		var f=new ActiveXObject("DEGetBlockFmtNamesParam.DEGetBlockFmtNamesParam");
	    DHTMLSafe.ExecCommand(DECMD_GETBLOCKFMTNAMES,OLECMDEXECOPT_DODEFAULT,f);
		vbarr = new VBArray(f.Names);
		arr = vbarr.toArray();
		for (var i=0;i<arr.length;i++) {
			oOption = document.createElement("OPTION");
			oSel.options.add(oOption);
			oOption.text=arr[i];
			oOption.name=arr[i];
		}
	}
	thisContentItem=eval("document.all.bs_tx_content"+num);
	if(thisContentItem.value.length)
		bsObjects[num].DOM.body.innerHTML = thisContentItem.value;	
	else
		bsObjects[num].DOM.body.innerHTML = " ";
	bs_initbodycss(num);
	set_tbstates(num);
	if(typeof(bsapi_local_onLoad)=='function')
		bsapi_local_onLoad(DHTMLSafe, bsFieldnames[num]);
	if (typeof(bsapi_onLoad)=='function')
		bsapi_onLoad(DHTMLSafe, bsFieldnames[num]);
		
}

function bs_onUnload() {
	var bs_content = "";
	var i;
	for(i=1;i<=bs_count;i++) {
		DHTMLSafe=bsObjects[i];
		thisContentItem = eval("document.all.bs_tx_content"+i);
		if(bs_sourceview[i]) bs_editsourceinline(i,false);
		var content = DHTMLSafe.DOM.body.innerHTML;
		thisContentItem.value = content;
	}
}

function bs_onSubmit() {
	var bs_content = "";
	var i;
	for(i=1;i<=bs_count;i++) {
		DHTMLSafe=bsObjects[i];
		if(bs_sourceview[i]) bs_editsourceinline(i,false);
		thisContentItem = eval("document.all.bs_tx_content"+i);
		if(typeof(bsapi_local_onBeforeSave)=='function')
			bs_content = bsapi_local_onBeforeSave(DHTMLSafe, bsFieldnames[i]);
		else if (typeof(bsapi_onBeforeSave)=='function')
			bs_content = bsapi_onBeforeSave(DHTMLSafe, bsFieldnames[i]);
		else
			bs_content = bs_onBeforeSave(DHTMLSafe, bsFieldnames[i]);
		thisContentItem.value = bs_content;
	}
}

function bs_onkeypress(num) {
	var sel;
	DHTMLSafe=bsObjects[num];
	if(bs_sourceview[num]) {
		switch(DHTMLSafe.DOM.parentWindow.event.keyCode) {
			case 10:
				DHTMLSafe.DOM.parentWindow.event.keyCode = 13;			
				break;
			case 13:
				if(DHTMLSafe.QueryStatus(DECMD_UNORDERLIST)!=DECMDF_LATCHED) {
					DHTMLSafe.DOM.parentWindow.event.returnValue = false;		
					sel = DHTMLSafe.DOM.selection.createRange();
					sel.pasteHTML("<br />");
					sel.collapse(false);
					sel.select();
				}
				break;
			default:
				break;
		}
	}
}

function bs_onmousedown(num) {
	if(typeof(document.all.frame1) != "undefined") {
		if(document.all.frame1.style.visibility == "visible") {
			cancelTable(false);
			return;
		}
	}
}

function bs_onclick(num) {
	set_tbstates(num);
}

function bs_ondisplaychange(num) {
 	set_tbstates(num);
}

function bs_onmenuaction(itemIndex, num) {
	bs_onCommand(ContextMenu[itemIndex].cmdId, num);
}

function bs_onCommand(cmdId, num) {
	if(cmdId==null) cmdid=eval(window.event.srcElement.cid);
	else cmdid=cmdId;
	if (bs_HTMLMode[num]&&cmdid!=DECMD_HELP&&cmdid!=DECMD_FINDTEXT&&cmdid!=DECMD_UNDO&&cmdid!=DECMD_REDO&&cmdid!=DECMD_COPY&&cmdid!=DECMD_CUT&&cmdid!=DECMD_PASTE&&cmdid!=DECMD_TOGGLE_DETAILS) { return; }
	if(typeof(num)=="undefined") {
		num=bs_hot;
	}
	DHTMLSafe=bsObjects[num];
	bsFocus=true;	
	switch(parseInt(cmdid)) {
		case DECMD_HR:
			insertHTML("<HR>",num);
			break;
		case DECMD_SETBODYBGCOLOR:
			onFrame1Obj("document.all.bs_bbgc"+num,inc + "colorpalette.php?task=1&instance=" + num,num,172,230);
			bsFocus=false;
			break;
		case DECMD_IMAGE:
			onImagewin(num);
			bsFocus=false;
			break;
		case DECMD_FILE:
			onFilewin(num);
			bsFocus=false;
			break;
		case DECMD_INSERTTABLE:
			onTableWin(num);
			bsFocus=false;
			break;
		case DECMD_EDITSOURCE:
			bs_editsourceinline(num);
			break;
		case DECMD_HELP:
			bs_help();
			bsFocus=false;
			break;
		case DECMD_TOGGLE_DETAILS:
			bs_onToggleDetails(null, num);
			break;
		case DECMD_SAVE:
			bs_submit_form(bs_form, bsFieldnames[num],num);
			break;
		case DECMD_EDITTABLE:
			editTableWin(num);
			bsFocus=false;
			break;
		case DECMD_HYPERLINK:
			bs_hyperlinkwin(num);
			bsFocus=false;
			break;
		case DECMD_SPECIAL_CHARS:
			onFrame1Obj("document.all.bs_sc"+num,inc + "specialchars.php?instance=" + num,num,200,285);
			bsFocus=false;
			break;
		case DECMD_FONT_COLOR:
			onFrame1Obj("document.all.bs_qfc"+num,inc + "colorpalette.php?instance=" + num,num,172,230);
			bsFocus=true;
			break;
		case DECMD_TOGGLE_BORDERS:
			DHTMLSafe.ShowBorders = !DHTMLSafe.ShowBorders;
			bsFocus=true;
			break;
		default:
			if(DHTMLSafe.QueryStatus(cmdid)!=DECMDF_DISABLED) {
				DHTMLSafe.ExecCommand(cmdid, OLECMDEXECOPT_DODEFAULT);
			}
			break;
	}
	if (bsFocus) DHTMLSafe.focus();
}

function bs_onToggleDetails(bVal, num) {
	DHTMLSafe=bsObjects[num];
	if (bVal == null) {
		DHTMLSafe.ShowDetails = !(DHTMLSafe.ShowDetails);
	}
	else {
		DHTMLSafe.ShowDetails = bVal;
	}
}

function editTableWin(num) {
	var trSel = DHTMLSafe.DOM.selection.createRange();
	trSel.collapse();
	trSel.select();
	thisCell = DHTMLSafe.DOM.selection.createRange().parentElement();
	while(thisCell.tagName!="TD"&&thisCell.tagName!="HTML")
		thisCell = thisCell.parentElement;
	if(thisCell.tagName=="HTML") {
		alert("Selection is not in a table cell");
		return;
	}
	thisRow = thisCell;
	while(thisRow.tagName!="TR"&&thisRow.tagName!="HTML") 
		thisRow = thisRow.parentElement;
	if(thisRow.tagName=="HTML") {
		alert("Missing TR tag."); 
		return;
	}
	thisTable = thisRow;
	while(thisTable.tagName!="TABLE"&&thisTable.tagName!="HTML") {
		thisTable = thisTable.parentElement;
	}
	if(thisTable.tagName=="HTML") {
		alert("Missing TABLE tag.");
		return;
	}
	var vIn = new Array();
	vIn["table_border"] = thisTable.getAttribute("BORDER");
	vIn["table_bordercolor"] = thisTable.getAttribute("BORDERCOLOR");
	vIn["table_bordercolorlight"] = thisTable.getAttribute("BORDERCOLORLIGHT");
	vIn["table_bordercolordark"] = thisTable.getAttribute("BORDERCOLORDARK");
	vIn["table_cellpadding"] = thisTable.getAttribute("CELLPADDING");
	vIn["table_cellspacing"] = thisTable.getAttribute("CELLSPACING");
	vIn["table_width"] = thisTable.getAttribute("WIDTH");
	vIn["table_height"] = thisTable.getAttribute("HEIGHT");
	vIn["table_bgcolor"] = thisTable.getAttribute("BGCOLOR");
	vIn["table_background"] = thisTable.getAttribute("BACKGROUND");
	vIn["table_class"] = thisTable.getAttribute("CLASS");
	vIn["table_style"] = thisTable.style.cssText;
	vIn["table_align"] = thisTable.getAttribute("ALIGN");
	vIn["tr_class"] = thisRow.getAttribute("CLASS");
	vIn["tr_style"] = thisRow.style.cssText;
	vIn["tr_bgcolor"] = thisRow.getAttribute("BGCOLOR");
	vIn["tr_bordercolor"] = thisRow.getAttribute("BORDERCOLOR");
	vIn["tr_bordercolorlight"] = thisRow.getAttribute("BORDERCOLORLIGHT");
	vIn["tr_bordercolordark"] = thisRow.getAttribute("BORDERCOLORDARK");
	vIn["td_width"] = thisCell.getAttribute("WIDTH");
	vIn["td_height"] = thisCell.getAttribute("HEIGHT");
	vIn["td_colspan"] = thisCell.getAttribute("COLSPAN");
	vIn["td_rowspan"] = thisCell.getAttribute("ROWSPAN");
	vIn["td_background"] = thisCell.getAttribute("BACKGROUND");
	vIn["td_bgcolor"] = thisCell.getAttribute("BGCOLOR");
	vIn["td_bordercolor"] = thisCell.getAttribute("BORDERCOLOR");
	vIn["td_bordercolorlight"] = thisCell.getAttribute("BORDERCOLORLIGHT");
	vIn["td_bordercolordark"] = thisCell.getAttribute("BORDERCOLORDARK");
	vIn["td_valign"] = thisCell.getAttribute("VALIGN");
	vIn["td_align"] = thisCell.getAttribute("ALIGN");
	vIn["td_class"] = thisCell.getAttribute("CLASS");
	vIn["td_style"] = thisCell.style.cssText;
	vIn["td_nowrap"] = thisCell.getAttribute("NOWRAP");
	
	vOut = parent.showModalDialog(inc + 'tableprop.htm',vIn,"dialogWidth:407px; dialogHeight:296px;help:0;status:no;");
	if (vOut != null) {
		for ( elem in vOut ) {
			switch (elem) {
				case "td_nowrap" : thisCell.setAttribute("NOWRAP",vOut[elem],0); break;
				case "td_width" : if (vOut[elem]=="") thisCell.setAttribute("WIDTH",vOut[elem],0); else thisCell.removeAttribute("WIDTH", 0); break;
				case "td_height" : if (vOut[elem]=="") thisCell.setAttribute("HEIGHT",vOut[elem],0); else thisCell.removeAttribute("HEIGHT", 0); break;
				case "td_colspan" : if (vOut[elem]!="") thisCell.setAttribute("COLSPAN",vOut[elem],0); else thisCell.removeAttribute("COLSPAN", 0); break;
				case "td_rowspan" : if (vOut[elem]!="") thisCell.setAttribute("ROWSPAN",vOut[elem],0); else thisCell.removeAttribute("ROWSPAN", 0); break;
				case "td_background" : if (vOut[elem]!="") thisCell.setAttribute("BACKGROUND",vOut[elem],0); else thisCell.removeAttribute("BACKGROUND", 0); break;
				case "td_bgcolor" : if (vOut[elem]!="") thisCell.setAttribute("BGCOLOR",vOut[elem],0); else thisCell.removeAttribute("BGCOLOR", 0); break;
				case "td_bordercolor" : if (vOut[elem]!="") thisCell.setAttribute("BORDERCOLOR",vOut[elem],0); else thisCell.removeAttribute("BORDERCOLOR", 0); break;
				case "td_bordercolorlight" : if (vOut[elem]!="") thisCell.setAttribute("BORDERCOLORLIGHT",vOut[elem],0); else thisCell.removeAttribute("BORDERCOLORLIGHT", 0); break;
				case "td_bordercolordark" : if (vOut[elem]!="") thisCell.setAttribute("BORDERCOLORDARK",vOut[elem],0); else thisCell.removeAttribute("BORDERCOLORDARK", 0); break;
				case "td_valign" : if (vOut[elem]!="") thisCell.setAttribute("VALIGN",vOut[elem],0); else thisCell.removeAttribute("VALIGN", 0); break;
				case "td_align" : if (vOut[elem]!="") thisCell.setAttribute("ALIGN",vOut[elem],0); else thisCell.removeAttribute("ALIGN", 0); break;
				case "td_class" : if (vOut[elem]!="") thisCell.setAttribute("CLASS",vOut[elem],0); else thisCell.removeAttribute("CLASS", 0); break;
				case "td_style" : if (vOut[elem]!="") thisCell.style.cssText = vOut[elem]; else thisCell.style.cssText = ""; break;
				case "tr_class" : if (vOut[elem]!="") thisRow.setAttribute("CLASS",vOut[elem],0); else thisRow.removeAttribute("CLASS", 0); break;
				case "tr_style" : if (vOut[elem]!="") thisRow.style.cssText = vOut[elem]; else thisRow.style.cssText = ""; break;
				case "tr_bgcolor" : if (vOut[elem]!="") thisRow.setAttribute("BGCOLOR",vOut[elem],0); else thisRow.removeAttribute("BGCOLOR", 0); break;
				case "tr_bordercolor" : if (vOut[elem]!="") thisRow.setAttribute("BORDERCOLOR",vOut[elem],0); else thisRow.removeAttribute("BORDERCOLOR", 0); break;
				case "tr_bordercolorlight" : if (vOut[elem]!="") thisRow.setAttribute("BORDERCOLORLIGHT",vOut[elem],0); else thisRow.removeAttribute("BORDERCOLORLIGHT", 0); break;
				case "tr_bordercolordark" : if (vOut[elem]!="") thisRow.setAttribute("BORDERCOLORDARK",vOut[elem],0); else thisRow.removeAttribute("BORDERCOLORDARK", 0); break;
				case "table_align" : if (vOut[elem]!="") thisTable.setAttribute("ALIGN",vOut[elem],0); else thisTable.removeAttribute("ALIGN", 0); break;
				case "table_border" : if (vOut[elem]!="") thisTable.setAttribute("BORDER",vOut[elem],0); else thisTable.removeAttribute("BORDER", 0); break;
				case "table_bordercolor" : if (vOut[elem]!="") thisTable.setAttribute("BORDERCOLOR",vOut[elem],0); else thisTable.removeAttribute("BORDERCOLOR", 0); break;
				case "table_bordercolorlight" : if (vOut[elem]!="") thisTable.setAttribute("BORDERCOLORLIGHT",vOut[elem],0); else thisTable.removeAttribute("BORDERCOLORLIGHT", 0); break;
				case "table_bordercolordark" : if (vOut[elem]!="") thisTable.setAttribute("BORDERCOLORDARK",vOut[elem],0); else thisTable.removeAttribute("BORDERCOLORDARK", 0); break;
				case "table_cellpadding" : if (vOut[elem]!="") thisTable.setAttribute("CELLPADDING",vOut[elem],0); else thisTable.removeAttribute("CELLPADDING", 0); break;
				case "table_cellspacing" : if (vOut[elem]!="") thisTable.setAttribute("CELLSPACING",vOut[elem],0); else thisTable.removeAttribute("CELLSPACING", 0); break;
				case "table_width" : if (vOut[elem]!="") thisTable.setAttribute("WIDTH",vOut[elem],0); else thisTable.removeAttribute("WIDTH", 0); break;
				case "table_height" : if (vOut[elem]!="") thisTable.setAttribute("HEIGHT",vOut[elem],0); else thisTable.removeAttribute("HEIGHT", 0); break;
				case "table_background" : if (vOut[elem]!="") thisTable.setAttribute("BACKGROUND",vOut[elem],0); else thisTable.removeAttribute("BACKGROUND", 0); break;
				case "table_bgcolor" : if (vOut[elem]!="") thisTable.setAttribute("BGCOLOR",vOut[elem],0); else thisTable.removeAttribute("BGCOLOR", 0); break;
				case "table_class" : if (vOut[elem]!="") thisTable.setAttribute("CLASS",vOut[elem],0); else thisTable.removeAttribute("CLASS", 0); break;
				case "table_style" : if (vOut[elem]!="") thisTable.style.cssText = vOut[elem]; else thisTable.style.cssText = ""; break;
			}
		}
	}
}

function onTableWin(num) {	
	DHTMLSafe=bsObjects[num];
	if(DHTMLSafe.QueryStatus(DECMD_INSERTTABLE) == DECMDF_DISABLED) {
   	DHTMLSafe.focus();
 		return;
	}	
	bs_hot = num;
	vOut = window.showModalDialog(inc + "tablecreate.htm","","dialogHeight: 215px; dialogWidth: 264px; center: Yes; help: No; resizable: No; status: No;");
	if (vOut != null) {
	  var arr = vOut;
	  rows = arr["rows"];
	  cols = arr["columns"];
	  attrs = "width=" + arr["width"] +" border=" + arr["border"] + " cellpadding=" + arr["padding"] + " cellspacing=" + arr["spacing"] + "style='" + arr["style"] + "'";	 
	  insertTable(rows,cols,attrs);
	}
}

function onTable(num) {
	if (bs_HTMLMode[num]) { return; }
	DHTMLSafe=bsObjects[num];
	if(DHTMLSafe.QueryStatus(DECMD_INSERTTABLE) == DECMDF_DISABLED) 
	{
	   	DHTMLSafe.focus();
  		return;
	}
	if(	document.all.frame1.style.visibility == "visible" ) {
		cancelTable();
		return;
	}
	var str = "<div id=\"tblsel\" style=\"background-color:blue;position:absolute;";
	str = str + "width:0;height:0;z-index:-1;\"></div>";
	str = str + makeTable(4,5);
	str = str + "<div style=\"background-color:buttonface;text-align:center;font-family:verdana,helvetica;font-size:8pt;padding:5px\" id=\"tblstat\">1 by 1 Table</div>";
	var ifrm = document.frames("frame1");
	var obj=eval("document.all.bs_tbtn"+num);
	var x=0;
	var y=0;
	ifrm.document.body.innerHTML=str;
	ifrm.document.body.style.cssText="background-color:buttonface;border:2px outset";
	while(obj.tagName!="BODY") {
		x+=obj.offsetLeft;
		y+=obj.offsetTop;
		obj=obj.offsetParent;
	}	
	document.all.frame1.style.pixelTop = y + 24;
	document.all.frame1.style.pixelLeft = x;
	document.all.frame1.style.pixelWidth = 0;
	document.all.frame1.style.pixelHeight = 0;
	document.all.frame1.style.visibility = "visible";
	bs_hot=num;
	document.frames("frame1").document.body.onmouseover = paintTable;	
	document.frames("frame1").document.body.onclick = insertTable;
	if(typeof(document.onmousedown)=="function")
		bs_oldbscmd = document.onmousedown;
	else bs_olddoccmd=null;
	document.onmousedown = cancelTable;
	DHTMLSafe.onmousedown = cancelTable;
	event.cancelBubble = true;
	ifrm.document.body.onselectstart=new Function("return false;");
	document.all.frame1.style.pixelWidth = ifrm.document.all.oTable.offsetWidth + 3
	document.all.frame1.style.pixelHeight = ifrm.document.all.oTable.offsetHeight + 3 + ifrm.document.all.tblstat.offsetHeight;
}

function onFrame1Obj(btnname,urlloc,num,w,h) {
	if (bs_HTMLMode[num]) { return; }
	DHTMLSafe=bsObjects[num];
	if(	document.all.frame1.style.visibility == "visible" ) {
		cancelTable();
		return;
	}
	var ifrm = document.frames("frame1");
	var obj=eval(btnname);
	var x=0;
	var y=0;
	ifrm.document.write("<body style=\"background-color:buttonface;border:outset 2px\"><table width=\"100%\" height=\"100%\"><tr><td align=\"center\" valign=\"middle\" style=\"font-family:verdana,helvetica;font-size:10px\">Loading...</td></tr></table></body>");
	ifrm.location=urlloc;
	while(obj.tagName!="BODY") {
		x+=obj.offsetLeft;
		y+=obj.offsetTop;
		obj=obj.offsetParent;
	}	
	document.all.frame1.style.pixelTop = y + 24;
	document.all.frame1.style.pixelLeft = x;
	document.all.frame1.style.pixelWidth = 0;
	document.all.frame1.style.pixelHeight = 0;
	document.all.frame1.style.visibility = "visible";
	bs_hot=num;
	document.frames("frame1").document.body.onmouseover = null;	
	document.frames("frame1").document.body.onclick = null;
	if(typeof(document.onmousedown)=="function") bs_oldbscmd = document.onmousedown;
	else bs_olddoccmd = null;
	document.onmousedown = cancelTable;
	DHTMLSafe.onmousedown = cancelTable;
	event.cancelBubble = true;
	ifrm.document.body.onselectstart=new Function("return false;");
	document.all.frame1.style.pixelWidth = w;
	document.all.frame1.style.pixelHeight = h;
}

//onbs_sc = onFrame1Obj("document.all.bs_sc"+num,inc + "specialchars.php?instance=" + num,num,200,285);
//onbs_sc = onFrame1Obj("document.all.bs_qfc"+num,inc + "colorpalette.php?instance=" + num,num,172,230);

function setBodyBGColor(col,num) {
	if(typeof(num)=="undefined") num=bs_hot;
	DHTMLSafe=bsObjects[num];
	DHTMLSafe.DOM.body.style.backgroundColor = col;
	DHTMLSafe.focus();
}

function insertTable(rows, cols, attrs, num) {
	if(typeof(num)=="undefined") num=bs_hot;
	DHTMLSafe=bsObjects[num];
	if (typeof(rows) == "undefined") {
		var se = document.frames('frame1').window.event.srcElement;
		if(se.tagName!='TD') {
			cancelTable();
			return;
		}
		tableparamobj.NumRows = se.parentElement.rowIndex + 1;
		tableparamobj.NumCols = se.cellIndex + 1;
	  	tableparamobj.TableAttrs = "border=0 cellPadding=0 cellSpacing=0 width=100%";
		cancelTable();
	}
	else {
		tableparamobj.NumRows = rows;
		tableparamobj.NumCols = cols;
		tableparamobj.TableAttrs = attrs;
	}
	DHTMLSafe.ExecCommand(DECMD_INSERTTABLE,OLECMDEXECOPT_DODEFAULT, tableparamobj);    
	DHTMLSafe.focus();
}

function paintTable() {
	var se = document.frames('frame1').window.event.srcElement;
	var sr, sc, tbl, fAll;
	fAll = document.frames('frame1').document.all;
	if(se.tagName!='TD') {
		sr = 0;
		sc = 0;
		var str="&nbsp;Cancel";
		fAll.tblsel.style.width = 0;
		fAll.tblsel.style.height = 0;
		return;
	}
	tbl=fAll.oTable;
	sr=se.parentElement.rowIndex;
	sc=se.cellIndex;
	if(!is_ie4) {
		if(tbl.rows.length == sr+1) {
			var r = tbl.insertRow(-1);
			var td;
			for(var i=0;i<tbl.rows(1).cells.length;i++) {
				td = r.insertCell(-1);
				td.innerHTML = "&nbsp;";
				td.style.pixelWidth = 20;
				td.style.pixelHeight = 20;
			}
				var bdy = document.frames("frame1").document.body;			
				var ifrm = document.frames("frame1");
				document.all.frame1.style.pixelWidth = ifrm.document.all.oTable.offsetWidth + 3
				document.all.frame1.style.pixelHeight = ifrm.document.all.oTable.offsetHeight + 3 + ifrm.document.all.tblstat.offsetHeight;
		}
		if(tbl.rows(1).cells.length == sc+1) {
			var td;
			for(var i=0;i<tbl.rows.length;i++) {
				td = tbl.rows(i).insertCell(-1);
				td.innerHTML = "&nbsp;";
				td.style.pixelWidth = 20;
				td.style.pixelHeight = 20;
			}			
				var bdy = document.frames("frame1").document.body;
				document.all.frame1.style.pixelWidth = bdy.createTextRange().boundingWidth + 5;
				document.all.frame1.style.pixelHeight = bdy.createTextRange().boundingHeight + 5;
		}
	}
	var str=(sr+1) + " by " + (sc+1) + " Table";
	fAll.tblsel.style.width = se.offsetWidth*(sc+1)+5;
	fAll.tblsel.style.height = se.offsetHeight*(sr+1)+5;
	fAll.tblstat.innerHTML = str;
}

function makeTable(rows, cols) {
	var a, b, str, n;
	str = "<table style=\"table-layout:fixed;border-style:outset 1px;cursor:hand;\" "; 
	str = str + "id=\"oTable\" cellpadding=\"0\" ";
	str = str + "cellspacing=\"0\" cols=" + cols;
	str = str + " border=1>\n";
	for (a=0;a<rows;a++) {
		str = str + "<tr>\n";
		for(b=0;b<cols;b++) {			
			str = str + "<td width=\"20\">" 
			str = str + "&nbsp;</td>\n";	
		}	
		str = str + "</tr>\n";
	}
	str = str + "</table>"
	return str;
}

function cancelTable(a) {
	document.onmousedown=null;
	document.all.frame1.style.visibility = "hidden";
	document.all.frame1.style.pixelWidth = 0;
	document.all.frame1.style.pixelHeight = 0;
	if(a==false) return;
	if(typeof(bs_oldbscmd)=="function") {
		bs_oldbscmd(false);
		document.onmousedown = bs_oldbscmd;
	}
	bs_oldbscmd = null;
	document.all.frame1.style.pixelWidth = 10;
	document.all.frame1.style.pixelHeight = 10;
}

function onImagewin(num) {
	DHTMLSafe=bsObjects[num];
	DHTMLSafe.focus();
	var sURLVars = "";
	if(DHTMLSafe.DOM.selection.type=="Control") {
		var el=DHTMLSafe.DOM.selection.createRange().commonParentElement();
		var tr = DHTMLSafe.DOM.body.createTextRange();
		tr.moveToElementText(el);
		tr.select();
	}
	var trSel=DHTMLSafe.DOM.selection.createRange();
	var coll=DHTMLSafe.DOM.all.tags("IMG");
	var fBreak=false;
	var arr = new Array();
	var st = "";
	for(i=0;i<coll.length&&!fBreak;i++) {
		trLink=DHTMLSafe.DOM.body.createTextRange();
		trLink.moveToElementText(coll[i]);
		if((trSel.compareEndPoints("EndToStart",trLink)==1)&&
			(trSel.compareEndPoints("StartToEnd",trLink)==-1)) {
			if(trSel.compareEndPoints("StartToStart",trLink)==1)
				trSel.setEndPoint("StartToStart",trLink);
			if(trSel.compareEndPoints("EndToEnd",trLink)==-1)
				trSel.setEndPoint("EndToEnd",trLink);
			trSel.select();
			arr["type"]="1";
			arr["src"]=coll[i].src;
			arr["alt"]=coll[i].alt;
			arr["width"]=coll[i].width;
			arr["height"]=coll[i].height;
			arr["hspace"]=coll[i].hspace;
			arr["vspace"]=coll[i].vspace;
			arr["align"]=coll[i].align;
			arr["border"]=coll[i].border;
			arr["style"]=coll[i].style.cssText;
			fBreak=true;
		}
	}
	var coll=DHTMLSafe.DOM.all.tags("EMBED");
	var fbreak=false;
	for(i=0;i<coll.length&&!fbreak;i++) {
		trLink=DHTMLSafe.DOM.body.createTextRange();
		trLink.moveToElementText(coll[i]);
		if((trSel.compareEndPoints("EndToStart",trLink)==1)&&
			(trSel.compareEndPoints("StartToEnd",trLink)==-1)) {
			if(trSel.compareEndPoints("StartToStart",trLink)==1)
				trSel.setEndPoint("StartToStart",trLink);
			if(trSel.compareEndPoints("EndToEnd",trLink)==-1)
				trSel.setEndPoint("EndToEnd",trLink);
			trSel.select();
			arr = new Array();
			arr["type"]="2";
			arr["embedtype"]=coll[i].getAttribute("type",false)==null?"":coll[i].getAttribute("type",false);
			arr["src"]=coll[i].src;
			arr["width"]=coll[i].width;
			arr["height"]=coll[i].height;
			arr["style"]=coll[i].style.cssText;
			fbreak=true;
		}
	}
	sURLVars = "";
	for (elem in arr) {
		switch (elem) {
			case "type": 
				sURLVars = "type=" + arr["type"] + "&" + sURLVars; break;
			case "embedtype": 
				sURLVars = "embedtype=" + arr["embedtype"] + "&" + sURLVars; break;
			case "src": 
				sURLVars = "src=" + arr["src"] + "&" + sURLVars; break;
			case "alt": 
				sURLVars = "alt=" + arr["alt"] + "&" + sURLVars; break;
			case "width": 
				sURLVars = "width=" + arr["width"] + "&" + sURLVars; break;
			case "height": 
				sURLVars = "height=" + arr["height"] + "&" + sURLVars; break;
			case "border": 
				sURLVars = "border=" + arr["border"] + "&" + sURLVars; break;
			case "hspace": 
				sURLVars = "hspace=" + arr["hspace"] + "&" + sURLVars; break;
			case "vspace": 
				sURLVars = "vspace=" + arr["vspace"] + "&" + sURLVars; break;
			case "align": 
				sURLVars = "align=" + arr["align"] + "&" + sURLVars; break;
			case "style": 
				sURLVars = "style=" + arr["style"] + "&" + sURLVars; break;
		}			
	}
	var vOut = null;
	vOut = window.showModalDialog(inc + "image.php?" + sURLVars + "instance=" + num,"","dialogHeight: 300px; dialogWidth: 545px;center: Yes; help: No; resizable: No; status: No;");
	if (vOut!=null) { insertHTML(vOut["result"],num);}
}

function onFilewin(num) {
	DHTMLSafe=bsObjects[num];
	DHTMLSafe.focus();
	var sURLVars = "";
	var vOut = null;
	vOut = window.showModalDialog(inc + "file.php?" + sURLVars + "instance=" + num,"","dialogHeight: 300px; dialogWidth: 545px;center: Yes; help: No; resizable: No; status: No;");
	if (vOut!=null) { insertHTML(vOut,num); }
}


function onImage(imgsrc, num) {
	DHTMLSafe=bsObjects[num];
	DHTMLSafe.DOM.selection.createRange().pasteHTML(imgsrc);
}

function insertHTML(HTML,num) {
	DHTMLSafe=bsObjects[num];
	var tr = DHTMLSafe.DOM.selection.createRange();
	if (typeof(tr.pasteHTML)=='object') tr.pasteHTML(HTML);
}

function bs_onBeforeSave(bsObject) {
	for (var i=0;i<bsObject.DOM.images.length;i++) {
		hs=bsObject.DOM.images[i].getAttribute("STYLE",0).height;
		ws=bsObject.DOM.images[i].getAttribute("STYLE",0).width;
		if(hs.length) {
			bsObject.DOM.images[i].removeAttribute("HEIGHT", 0); 			
			bsObject.DOM.images[i].setAttribute("HEIGHT", replaceString("px", "", hs),0); 
			bsObject.DOM.images[i].getAttribute("STYLE",0).removeAttribute("HEIGHT",0);
		}
		if(ws.length) {
			bsObject.DOM.images[i].removeAttribute("WIDTH", 0);	
			bsObject.DOM.images[i].setAttribute("WIDTH", replaceString("px", "", ws),0); 
			bsObject.DOM.images[i].getAttribute("STYLE",0).removeAttribute("WIDTH",0);
		}
	}
	for (var k=0;k<bsObject.DOM.all.tags("TABLE").length;k++) {
		hs=bsObject.DOM.all.tags("TABLE").item(k).getAttribute("STYLE",0).height;
		ws=bsObject.DOM.all.tags("TABLE").item(k).getAttribute("STYLE",0).width;
		if(hs.length) {
			bsObject.DOM.all.tags("TABLE").item(k).removeAttribute("HEIGHT", 0); 			
			bsObject.DOM.all.tags("TABLE").item(k).setAttribute("HEIGHT", replaceString("px", "", hs),0); 
			bsObject.DOM.all.tags("TABLE").item(k).getAttribute("STYLE",0).removeAttribute("HEIGHT",0);
		}
		if(ws.length) {
			bsObject.DOM.all.tags("TABLE").item(k).removeAttribute("WIDTH", 0);	
			bsObject.DOM.all.tags("TABLE").item(k).setAttribute("WIDTH", replaceString("px", "", ws),0); 
			bsObject.DOM.all.tags("TABLE").item(k).getAttribute("STYLE",0).removeAttribute("WIDTH",0);
		}
	}
	var content = bsObject.DOM.body.innerHTML;
	if(content.length) {
		content = bsObject.FilterSourceCode(content);
	}
	replaceString("&#65279;", " ", content); 
	return content;
}

function bs_submit_form(obj, field, num) {
	var i;	
	for(i=1;i<=bs_count;i++) {	
		DHTMLSafe=bsObjects[i];
		if(bs_sourceview[i]) bs_editsourceinline(i,false);
		if (typeof(bsapi_local_onBeforeSave) == "function") {
			var bs_content = bsapi_local_onBeforeSave(DHTMLSafe, bsFieldnames[i]);
		}
		else if (typeof(bsapi_onBeforeSave) == "function") {
			var bs_content = bsapi_onBeforeSave(DHTMLSafe, bsFieldnames[i]);
		}
		else {
			var bs_content = bs_onBeforeSave(DHTMLSafe, bsFieldnames[i]);
		}
		eval(obj+"."+bsFieldnames[i]).value = bs_content;
	}
	eval(obj).submit();
}

function replaceString(oldS,newS,fullS) {
	for (var i=0; i<fullS.length; i++) {
 		if (fullS.substring(i,i+oldS.length) == oldS) {
			fullS = fullS.substring(0,i)+newS+fullS.substring(i+oldS.length,fullS.length);
		}
	}
 	return fullS;
}

function bs_help() {
	window.showModalDialog(inc + "help.htm","","dialogHeight: 380px; dialogWidth: 350px; center: Yes; help: No; resizable: No; status: No;");
}

function bs_editsource(num) {
	DHTMLSafe=bsObjects[num];
	DHTMLSafe.DOM.selection.empty();
	codewin = window.open(inc + "editsource.htm","codewin","scrollbars=no,width=485,height=475");
}

function bs_initbodycss(num) {
	DHTMLSafe=bsObjects[num];
	var style_flag = false;
	for (i in (body_attr[num])) {
		if (i!="style") DHTMLSafe.DOM.body.setAttribute(i,body_attr[num][i],0);
		else style_flag = true;
	}
	if (style_flag) DHTMLSafe.DOM.body.style.cssText = DHTMLSafe.DOM.body.style.cssText + ";" + body_attr[num]['style'];
}

function bs_editsourceinline(num, bVal) {
	DHTMLSafe=bsObjects[num];
	thisContentItem=eval("document.all.bs_tx_content"+num);
	if(bs_HTMLMode[num]==bVal) return;
	DHTMLSafe.DOM.selection.empty();
	if(bs_HTMLMode[num]) { 
		document.images["normaltab"+num].src=img_normaltabon.src;
		document.images["htmltab"+num].src=img_htmltaboff.src;
		DHTMLSafe.DOM.body.link = "";
		DHTMLSafe.DOM.body.style.cssText = " ";	
		thisContentItem.value=DHTMLSafe.DOM.body.createTextRange().text;
		DHTMLSafe.DOM.body.innerHTML = "<body>" + thisContentItem.value + "</body>";	
		bs_HTMLMode[num] = false;
		bs_sourceview[num] = bs_HTMLMode[num];
	}
	else {
		var re=/((<br />)+)/ig;
		var re_ahref=/((<a[^>]+>)+)|((<\/a>)+)/ig;
		var re_office_tags=/((<o:[^>]+>)+)|((<\/o:[^>]+>)+)|((<v:[^>]+>)+)|((<\/v:[^>]+>)+)|((<xml:[^>]+>)+)|((<\/xml:[^>]+>)+)|((<w:[^>]+>)+)|((<\/w:[^>]+>)+)|((<[?]xml:[^>]+>)+)/ig;
		document.images["normaltab"+num].src=img_normaltaboff.src;
		document.images["htmltab"+num].src=img_htmltabon.src;
		DHTMLSafe.DOM.body.style.cssText = " ";	
		DHTMLSafe.DOM.body.style.background = "";
		DHTMLSafe.DOM.body.style.backgroundColor = "white";
		DHTMLSafe.DOM.body.style.fontFamily = "Courier New";
		DHTMLSafe.DOM.body.style.fontSize = "10pt";
		DHTMLSafe.DOM.body.style.color = "black";
		DHTMLSafe.DOM.body.style.margin = "5px";
		DHTMLSafe.DOM.body.link = "black";
		thisContentItem.value=DHTMLSafe.DOM.body.innerHTML;
		DHTMLSafe.DOM.body.innerHTML = "";
		thiscontent = thisContentItem.value.replace(re, "$1\n");
		thiscontent = thiscontent.replace(re_office_tags,"");
		DHTMLSafe.DOM.body.createTextRange().text = thiscontent;
		DHTMLSafe.DOM.body.innerHTML = DHTMLSafe.DOM.body.innerHTML.replace(re_ahref,"");
		bs_HTMLMode[num] = true;
		bs_sourceview[num] = bs_HTMLMode[num];
	}
}

function bs_quickfont(num) {
	if (bs_HTMLMode[num]) { return; }
	DHTMLSafe=bsObjects[num];
	oSel=eval('document.all.oQuickFont'+num);	
	DHTMLSafe.ExecCommand(DECMD_SETFONTNAME, OLECMDEXECOPT_DODEFAULT, oSel.options[oSel.selectedIndex].name);
	DHTMLSafe.focus();
}

function bs_quickfontcolor(col,num) {
	if (bs_HTMLMode[num]) { return; }
	DHTMLSafe=bsObjects[num];
	DHTMLSafe.ExecCommand(DECMD_SETFORECOLOR, OLECMDEXECOPT_DODEFAULT, col);
	DHTMLSafe.focus();
}


function bs_quickfontsize(num) {
	if (bs_HTMLMode[num]) { return; }
	DHTMLSafe=bsObjects[num];
	oSel=eval('document.all.oQuickFontSize'+num);	
	DHTMLSafe.ExecCommand(DECMD_SETFONTSIZE, OLECMDEXECOPT_DODEFAULT, oSel.options[oSel.selectedIndex].value);
	DHTMLSafe.focus();
}

function bs_quickformat(num) {
	if (bs_HTMLMode[num]) { return; }
	DHTMLSafe=bsObjects[num];
	oSel=eval('document.all.oQuickFormat'+num);	
	DHTMLSafe.ExecCommand(DECMD_SETBLOCKFMT, OLECMDEXECOPT_DODEFAULT, oSel.options[oSel.selectedIndex].name);
	DHTMLSafe.focus();
}

function bs_hyperlinkwin(num) {
	DHTMLSafe=bsObjects[num];
	DHTMLSafe.focus();
	if(DHTMLSafe.DOM.selection.type=="Control") {
		var el=DHTMLSafe.DOM.selection.createRange().commonParentElement();
		var tr = DHTMLSafe.DOM.body.createTextRange();
		tr.moveToElementText(el);
		tr.select();
	}
	var trSel=DHTMLSafe.DOM.selection.createRange();
	var coll=DHTMLSafe.DOM.all.tags("A");
	var fBreak=false;
	var vIn = new Array();
	var st = "";
	for(i=0;i<coll.length&&!fBreak;i++) {
		trLink=DHTMLSafe.DOM.body.createTextRange();
		trLink.moveToElementText(coll[i]);
		if((trSel.compareEndPoints("EndToStart",trLink)==1)&&
			(trSel.compareEndPoints("StartToEnd",trLink)==-1)) {
			if(trSel.compareEndPoints("StartToStart",trLink)==1)
				trSel.setEndPoint("StartToStart",trLink);
			if(trSel.compareEndPoints("EndToEnd",trLink)==-1)
				trSel.setEndPoint("EndToEnd",trLink);
			trSel.select();
			vIn["protocol"]=coll[i].protocol;
			st = coll[i].href;
			vIn["href"]=coll[i].href;
			vIn["target"]=coll[i].target;
			vIn["style"]=coll[i].style.cssText;
			vIn["name"]=coll[i].name;
			vIn["title"]=coll[i].title;
			vIn["class"]=coll[i].className;
			vIn["onclick"]=coll[i].getAttribute("onclick",false)==null?"":coll[i].getAttribute("onclick",false);
			vIn["onmover"]=coll[i].getAttribute("onmouseover",false)==null?"":coll[i].getAttribute("onmouseover",false);
			vIn["onmout"]=coll[i].getAttribute("onmouseout",false)==null?"":coll[i].getAttribute("onmouseout",false);
			fBreak=true;
		}
	}
  vOut = parent.showModalDialog(inc+"href.php",vIn,"dialogWidth:400px; dialogHeight:265px;help:0;status:no;");
  if (vOut != null){
		ihref = vOut["url"]!=null?vOut["url"]:"";
		itarget = vOut["target"]!=null?vOut["target"]:"";
		istyle = vOut["style"]!=null?vOut["style"]:"";
		iname = vOut["name"]!=null?vOut["name"]:"";
		ititle = vOut["title"]!=null?vOut["title"]:"";
		iclass = vOut["title"]!=null?vOut["class"]:"";
		ionclick = vOut["onclick"]!=null?vOut["onclick"]:"";
		ionmover = vOut["onmover"]!=null?vOut["onmover"]:"";
		ionmout = vOut["onmout"]!=null?vOut["onmout"]:"";
		bs_hyperlink(num, ihref, itarget, istyle,iclass, iname, ititle,ionclick,ionmover,ionmout);
  }
}

function bs_hyperlink(num, iHref, iTarget, iStyle, iClass, iName,iTitle,ionclick,ionmover,ionmout) {
	DHTMLSafe=bsObjects[num];
	var uid="bs"+Math.random().toString();
	if(false) {
		if(DHTMLSafe.QueryStatus(DECMD_UNLINK)==DECMDF_ENABLED)
			DHTMLSafe.ExecCommand(DECMD_UNLINK);
	}
	else {
		var trSel=DHTMLSafe.DOM.selection.createRange();
		if(trSel.compareEndPoints("StartToEnd",trSel)==0) { 
			txtHTML="<A ";
			if(iName!="") txtHTML+="name=\""+iName+"\" ";
			if(iTarget!="") txtHTML+="target=\""+iTarget+"\" ";
			if(iStyle!="") txtHTML+="style=\""+iStyle+"\" ";
			if(iTitle!="") txtHTML+="title=\""+iTitle+"\" ";
			if(iClass!="") txtHTML+="class=\""+iClass+"\" ";
			if(ionclick!="") txtHTML+="onclick=\""+ionclick+"\" ";
			if(ionmout!="") txtHTML+="onmouseout=\""+ionmout+"\" ";
			if(ionmover!="") txtHTML+="onmouseover=\""+ionmover+"\" ";
			if(iHref!="") txtHTML+="href=\""+iHref+"\" ";
			var tst = iTitle != ""?iTitle:iHref;
			txtHTML+=">"+tst+"</a>";
			trSel.pasteHTML(txtHTML);
		}
		else {
			DHTMLSafe.ExecCommand(DECMD_HYPERLINK,OLECMDEXECOPT_DONTPROMPTUSER,uid);
			var coll=DHTMLSafe.DOM.all.tags("A");
			for(i=0;i<coll.length;i++) {
				if(coll[i].href==uid) {
					coll[i].href=iHref;
					coll[i].name=iName;
					coll[i].title=iTitle;
					if(iTarget!="") coll[i].target=iTarget;
					else coll[i].removeAttribute("TARGET",0);
					if(ionclick!="") coll[i].setAttribute("onclick",ionclick,false);
					else coll[i].removeAttribute("onclick",0);
					if(ionmout!="") coll[i].setAttribute("onmouseout",ionmout,false);
					else coll[i].removeAttribute("onmouseout",0);
					if(ionmover!="") coll[i].setAttribute("onmouseover",ionmover,false);
					else coll[i].removeAttribute("onmouseover",0);
					if(iStyle!="") coll[i].style.cssText=iStyle;
					else coll[i].style.cssText="";
					if(iClass!="") coll[i].className=iClass;
					else coll[i].removeAttribute("class",0);
				}
			}
		}
	}
	DHTMLSafe.focus();
}

function ShowMenu(num) {
	this.onError = void(0);
	try {
		var menuStrings = new Array();
		var menuStates = new Array();
		var state;
		var i;
		var idx = 0;
		bs_hot=num;
		DHTMLSafe=bsObjects[num];
		ContextMenu.length = 0;
		i=0;
		for (; i<GeneralContextMenu.length; i++) {
			ContextMenu[idx++] = GeneralContextMenu[i];
		}
		if (DHTMLSafe.QueryStatus(DECMD_HYPERLINK) != DECMDF_DISABLED && !bs_sourceview[num]) {
			for (i=0; i<HyperlinkContextMenu.length; i++) {
				ContextMenu[idx++] = HyperlinkContextMenu[i];
			}
		}
		if (DHTMLSafe.QueryStatus(DECMD_IMAGE) != DECMDF_DISABLED && !bs_sourceview[num]) {
			for (i=0; i<ImageContextMenu.length; i++) {
				ContextMenu[idx++] = ImageContextMenu[i];
			}
		}
		if (DHTMLSafe.QueryStatus(DECMD_INSERTROW) != DECMDF_DISABLED && !bs_sourceview[num]) {
			for (i=0; i<TableContextMenu.length; i++) {
				ContextMenu[idx++] = TableContextMenu[i];
			}
		}
		for (i=0; i<ContextMenu.length; i++) {
			menuStrings[i] = ContextMenu[i].string;
			if ((menuStrings[i] != MENU_SEPARATOR) && (ContextMenu[i].cmdId < 6000)) {
				state = DHTMLSafe.QueryStatus(ContextMenu[i].cmdId);
			}
			else {
				state = DECMDF_ENABLED;
			}
			if (state == DECMDF_DISABLED || state == DECMDF_NOTSUPPORTED) {
				menuStates[i] = OLE_TRISTATE_GRAY;
			}
			else if (state == DECMDF_ENABLED || state == DECMDF_NINCHED) {
				menuStates[i] = OLE_TRISTATE_UNCHECKED;
			}
			else {
				menuStates[i] = OLE_TRISTATE_CHECKED;
			}
			if (ContextMenu[i].cmdId == DECMD_TOGGLE_DETAILS) {
				if (DHTMLSafe.ShowDetails) {
					menuStates[i] = OLE_TRISTATE_CHECKED;
				}
				else {
					menuStates[i] = OLE_TRISTATE_UNCHECKED;
				}	
			}
			if (ContextMenu[i].cmdId == DECMD_TOGGLE_BORDERS) {
				if (DHTMLSafe.ShowBorders) {
					menuStates[i] = OLE_TRISTATE_CHECKED;
				}
				else {
					menuStates[i] = OLE_TRISTATE_UNCHECKED;
				}	
			}
			if(ContextMenu[i].cmdId == DECMD_EDITSOURCE) {
				if(bs_sourceview[num]) {
					menuStates[i] = OLE_TRISTATE_CHECKED;							
				}
				else {
					menuStates[i] = OLE_TRISTATE_UNCHECKED;
				}	
			}
		}
		DHTMLSafe.SetContextMenu(menuStrings, menuStates);
	} catch(e) {
		return;
	}
}

function ContextMenuItem(string, cmdId) {
	this.string = string;
	this.cmdId = cmdId;
}

function QueryStatusItem(command, element) {
	this.command = command;
	this.element = element;
}


var MENU_SEPARATOR = "";
var ContextMenu = new Array();
var GeneralContextMenu = new Array();
var TableContextMenu = new Array();
var ImageContextMenu = new Array();
var HyperlinkContextMenu = new Array();

var genId = 0;
var tblId = 0;

GeneralContextMenu[genId++] = new ContextMenuItem("Edit Source", DECMD_EDITSOURCE);
GeneralContextMenu[genId++] = new ContextMenuItem(MENU_SEPARATOR, 0);
GeneralContextMenu[genId++] = new ContextMenuItem("Cut", DECMD_CUT);
GeneralContextMenu[genId++] = new ContextMenuItem("Copy", DECMD_COPY);
GeneralContextMenu[genId++] = new ContextMenuItem("Paste", DECMD_PASTE);
GeneralContextMenu[genId++] = new ContextMenuItem(MENU_SEPARATOR, 0);
ImageContextMenu[0] = new ContextMenuItem(MENU_SEPARATOR, 0);
ImageContextMenu[1] = new ContextMenuItem("Image Properties", DECMD_IMAGE);
HyperlinkContextMenu[0] = new ContextMenuItem(MENU_SEPARATOR, 0);
HyperlinkContextMenu[1] = new ContextMenuItem("Hyperlink Properties", DECMD_HYPERLINK);

if (!is_ie4) {
	TableContextMenu[tblId++] = new ContextMenuItem(MENU_SEPARATOR, 0);
 	TableContextMenu[tblId++] = new ContextMenuItem("Edit Table", DECMD_EDITTABLE);
}

TableContextMenu[tblId++] = new ContextMenuItem(MENU_SEPARATOR, 0);
TableContextMenu[tblId++] = new ContextMenuItem("Insert Row", DECMD_INSERTROW);
TableContextMenu[tblId++] = new ContextMenuItem("Delete Rows", DECMD_DELETEROWS);
TableContextMenu[tblId++] = new ContextMenuItem(MENU_SEPARATOR, 0);
TableContextMenu[tblId++] = new ContextMenuItem("Insert Column", DECMD_INSERTCOL);
TableContextMenu[tblId++] = new ContextMenuItem("Delete Columns", DECMD_DELETECOLS);
TableContextMenu[tblId++] = new ContextMenuItem(MENU_SEPARATOR, 0);
TableContextMenu[tblId++] = new ContextMenuItem("Insert Cell", DECMD_INSERTCELL);
TableContextMenu[tblId++] = new ContextMenuItem("Delete Cells", DECMD_DELETECELLS);
TableContextMenu[tblId++] = new ContextMenuItem("Merge Cells", DECMD_MERGECELLS);
TableContextMenu[tblId++] = new ContextMenuItem("Split Cell", DECMD_SPLITCELL);

GeneralContextMenu[genId++] = new ContextMenuItem("Find", DECMD_FINDTEXT);
GeneralContextMenu[genId++] = new ContextMenuItem("Show Details", DECMD_TOGGLE_DETAILS);
GeneralContextMenu[genId++] = new ContextMenuItem("Show Borders", DECMD_TOGGLE_BORDERS);

function bs_m_out(src) {
	if(src.state==0) return;	
	if(src.state==2) { src.className="latched"; return; }
	if(src.type=="btn") {
		window.status="";
		src.className="flat";
	}
}

function bs_m_over(src) {
	if(src.state==0) return;
	if(src.state==2) return;
	
	if(src.type=="btn") {
		src.className="outset";
	}
}

function bs_m_down(src) {
	if(src.state==0) return;
	if(src.type=="btn") {
		src.className="inset";
	}
}

function bs_m_up(src) {
	if(src.state==0) return;
	if(src.state==2) { src.className="latched"; return; }
	if(src.type=="btn") {
		src.className="outset";
	}
}



function set_tbstates(num) {
	try {
		var pbtn;
		var cid;
		var state;
		DHTMLSafe=bsObjects[num];
		bs_tbar=eval("bs_tbar"+num);
		if(DHTMLSafe.QueryStatus(5002)!=DHTMLSafe.QueryStatus(5003)) return;
		for(var i=0;i<bs_tbar.all.length;i++) {
			pbtn= bs_tbar.all(i);
			cid=pbtn.cid;
			if(cid < 6000&&cid!=DECMD_HYPERLINK) {
				if (!is_ie4) pbtn.style.visibility="visible";
				state=DHTMLSafe.QueryStatus(cid)
	   		if(state == DECMDF_DISABLED || state == DECMDF_NOTSUPPORTED) {
					if(pbtn.state!=0) {
							pbtn.className = "disabled";
							pbtn.state = 0;
					}
				}
	   		else if(bs_sourceview[num]&&cid!=DECMD_FINDTEXT&&cid!=DECMD_UNDO&&cid!=DECMD_REDO&&cid!=DECMD_COPY&&cid!=DECMD_PASTE&&cid!=DECMD_CUT) {
					if(pbtn.state!=0) {
							pbtn.className = "disabled";
							pbtn.state = 0;
					}
				}
				else if(state == DECMDF_ENABLED || state == DECMDF_NINCHED){
					if(pbtn.state!=1) {
						pbtn.className = "flat";
						pbtn.state = 1;
					}
				}
				else {
					if(pbtn.state!=2) {
						pbtn.className = "latched";
						pbtn.state = 2;
					}
					
				}
			}
			else if(cid==6004) {
				if(DHTMLSafe.ShowDetails) {
					if(pbtn.state!=2) {
						pbtn.className = "latched";
						pbtn.state = 2;
					}
				}
				else {
					if(pbtn.state!=1) {
						pbtn.className = "flat";
						pbtn.state = 1;
					}
				}
			}
			else if(cid==6010) {
				if (bs_sourceview[num]) {
					if(pbtn.state!=0) {
						pbtn.className = "disabled";
						pbtn.state = 0;
					}
				} else if(DHTMLSafe.ShowBorders) {
					if(pbtn.state!=2) {
						pbtn.className = "latched";
						pbtn.state = 2;
					}
				}
				else {
					if(pbtn.state!=1) {
						pbtn.className = "flat";
						pbtn.state = 1;
					}
				}
			}
			else if(cid==6011) {
				if (DHTMLSafe.QueryStatus(DECMD_SETFONTNAME)!=DECMDF_DISABLED&&DHTMLSafe.DOM.selection.type!="control"&&!bs_sourceview[num]) {
					if(pbtn.state!=1) {
						pbtn.className = "flat";
						pbtn.state = 1;
					}
				}
				else {
					if(pbtn.state!=0) {
						pbtn.className = "disabled";
						pbtn.state = 0;
					}
				}
			}
			else if(cid==DECMD_HYPERLINK||cid==DECMD_SPECIAL_CHARS||cid==DECMD_HR||cid==DECMD_SA