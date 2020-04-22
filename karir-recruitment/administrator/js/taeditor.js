function bwInfo(){
	this.ver=navigator.appVersion
	this.agent=navigator.userAgent.toLowerCase()
	this.dom=document.getElementById?1:0
	this.op5=(this.agent.indexOf("opera 5")>-1 || this.agent.indexOf("opera/5")>-1) && window.opera 
  this.op6=(this.agent.indexOf("opera 6")>-1 || this.agent.indexOf("opera/6")>-1) && window.opera   
  this.ie5 = (this.agent.indexOf("msie 5")>-1 && !this.op5 && !this.op6)
  this.ie55 = (this.ie5 && this.agent.indexOf("msie 5.5")>-1)
  this.ie6 = (this.agent.indexOf("msie 6")>-1 && !this.op5 && !this.op6)
	this.ie4=(this.agent.indexOf("msie")>-1 && document.all &&!this.op5 &&!this.op6 &&!this.ie5&&!this.ie6)
  this.ie = (this.ie4 || this.ie5 || this.ie6)
	this.mac=(this.agent.indexOf("mac")>-1)
	this.ns6=(this.agent.indexOf("gecko")>-1 || window.sidebar)
	this.ns4=(!this.dom && document.layers)?1:0;
	this.bw=(this.ie6 || this.ie5 || this.ie4 || this.ns4 || this.ns6 || this.op5 || this.op6)
  this.usedom= this.ns6
  this.reuse = this.ie||this.usedom
	return this
}


function taEditor(doc, taObj) {
	this.doc = doc;
	this.taObj = taObj;
	this.bw = new bwInfo();
	this.surround = te_surround;
	this.insert = te_insert;
	this.append = te_append;
	this.prepend = te_prepend;		
	this.replaceString = te_replaceString;
}

function te_surround(str1,str2) {
	if (this.bw.ie) {
		this.taObj.focus();
		var sel = this.doc.selection.createRange();
		var text = sel.text;
		sel.text = str1+text+str2;
	} else
		this.append(str1+str2);
}

function te_insert(str) {
	if (this.bw.ie) {
		this.taObj.focus();
		var sel = this.doc.selection.createRange();
		var text = sel.text;
		sel.text = str+text;
	} else
		this.append(str);
}

function te_append(str) {
	this.taObj.value = this.taObj.value+str;
}

function te_prepend(str) {
	this.taObj.value = this.taObj.value+str;
}

function te_replaceString(stOld,stNew) {
	this.taObj.value = replaceString(stOld,stNew,this.taObj.value);
}

function replaceString(oldS,newS,fullS,matchCase) {
	if (matchCase) {
		for (var i=0; i<fullS.length; i++) {
	 		if (fullS.substring(i,i+oldS.length) == oldS) {
				fullS = fullS.substring(0,i)+newS+fullS.substring(i+oldS.length,fullS.length);
			}
		}
	 	return fullS;
	} else {
		for (var i=0; i<fullS.length; i++) {
	 		if (fullS.toUpperCase().substring(i,i+oldS.length) == oldS.toUpperCase()) {
				fullS = fullS.substring(0,i)+newS+fullS.substring(i+oldS.length,fullS.length);
			}
		}
	 	return fullS;
	}
}


