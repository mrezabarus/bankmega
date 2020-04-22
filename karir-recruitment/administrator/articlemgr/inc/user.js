/*
function bsapi_init(bsObject) {
	//...
}
*/

function bsapi_onLoad(bsObject) {
	bsObject.ShowBorders = true;
	//bsObject.ShowDetails = true;
}

function bsapi_onBeforeSave(bsObject) {
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
	if(content.length) content = bsObject.FilterSourceCode(content);
	replaceString("&#65279;", " ", content); 
	var re_office_tags=/((<o:[^>]+>)+)|((<\/o:[^>]+>)+)|((<v:[^>]+>)+)|((<\/v:[^>]+>)+)|((<xml:[^>]+>)+)|((<\/xml:[^>]+>)+)|((<w:[^>]+>)+)|((<\/w:[^>]+>)+)|((<[?]xml:[^>]+>)+)/ig;
	content = content.replace(re_office_tags,"");
	return content;
}


/*
function bsapi_onAfterSave(bsObject) {
	//...
}
*/
