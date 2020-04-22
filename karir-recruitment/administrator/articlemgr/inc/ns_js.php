//<script>
function bs_menuaction(cid,num) {
	var frm = eval(bs_form+"."+bs_fieldname[num]);
	switch(cid) {
		case DECMD_SAVE :
			eval(bs_form).submit();
			return false;
			break;
		case DECMD_UNDERLINE :
			frm.value += "<u></u>";
			break;
		case DECMD_HYPERLINK :
			HyperlinkWin(num);
			break;
		case DECMD_ITALIC :
			frm.value += "<i></i>";
			break;
		case DECMD_BOLD :
			frm.value += "<b></b>";
			break;
		case DECMD_IMAGE :
			ImgWin(num);
			break;
		case DECMD_FILE :
			FlWin(num);
			break;
		case DECMD_PREVIEW :
			PreviewWin(num);
			break;
		case DECMD_INSERTTABLE :
			InsertTable(num);
			break;
		case DECMD_SPECIAL_CHARS :
			InsertSpecialChar(num);
			break;
		case DECMD_SAVE :
			PreviewWin(num);
			break;
		case DECMD_HR :
			frm.value += "<hr>";
			break;
	}
}

function InsertTable(num) {
	frm = eval(bs_form+"."+bs_fieldname[num]);
	var w = 240;
	var h = 180;
	var l = Math.floor((screen.width-w)/2);
	var t = Math.floor((screen.height-h)/2);
	var ITW = null;
	ITW = window.open(inc+"ns_itable.php?formfield="+escape(bs_form)+"."+escape(bs_fieldname[num]),"BS_HTMLEDITOR_INSERTTABLE","width="+w+",height="+h+",left="+l+",top="+t);
	if (ITW!=null) ITW.focus();
}

function InsertSpecialChar(num) {
	frm = eval(bs_form+"."+bs_fieldname[num]);
	var w = 300;
	var h = 300;
	var l = Math.floor((screen.width-w)/2);
	var t = Math.floor((screen.height-h)/2);
	var ITW = null;
	ITW = window.open(inc+"ns_isc.php?formfield="+escape(bs_form)+"."+escape(bs_fieldname[num]),"BS_HTMLEDITOR_INSERTSC","width="+w+",height="+h+",left="+l+",top="+t);
	if (ITW!=null) ITW.focus();
}

function ImgWin(num) {
	var w = 400;
	var h = 400;
	var l = Math.floor((screen.width-w)/2);
	var t = Math.floor((screen.height-h)/2);
	var PW = null;
	PW = window.open(inc+"ns_imgindex.php?formfield="+escape(bs_form)+"."+escape(bs_fieldname[num]),"BS_HTMLEDITOR_IMGWIN","width="+w+",height="+h+",left="+l+",top="+t);
	if (PW!=null) {
		PW.focus();
	}
}

function HyperlinkWin(num) {
	var w = 250;
	var h = 175;
	var l = Math.floor((screen.width-w)/2);
	var t = Math.floor((screen.height-h)/2);
	var PW = null;
	PW = window.open(inc+"ns_hyperlink.php?formfield="+escape(bs_form)+"."+escape(bs_fieldname[num]),"BS_HTMLEDITOR_IMGWIN","width="+w+",height="+h+",left="+l+",top="+t);
	if (PW!=null) {
		PW.focus();
	}
}

function FlWin(num) {
	var w = 400;
	var h = 400;
	var l = Math.floor((screen.width-w)/2);
	var t = Math.floor((screen.height-h)/2);
	var PW = null;
	PW = window.open(inc+"ns_flindex.php?formfield="+escape(bs_form)+"."+escape(bs_fieldname[num]),"BS_HTMLEDITOR_FLWIN","width="+w+",height="+h+",left="+l+",top="+t);
	if (PW!=null) {
		PW.focus();
	}
}

function PreviewWin(num) {
	frm = eval(bs_form+"."+bs_fieldname[num]);
	var w = 600;
	var h = 400;
	var l = Math.floor((screen.width-w)/2);
	var t = Math.floor((screen.height-h)/2);
	var PW = null;
	PW = window.open("about:blank","BS_HTMLEDITOR_PREVIEWWIN","width="+w+",height="+h+",left="+l+",top="+t+",resizable=1,toolbar=1,scrollbars=1,status=1");
	if (PW!=null) {
		PW.document.clear();
		PW.document.write(frm.value);
		PW.document.close();
		PW.focus();
	}
}


//</script>