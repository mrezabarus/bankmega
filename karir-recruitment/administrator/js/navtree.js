window.saveNavigator = window.navigator;

function noop() {}
function noerror() { return true; }

function defaultOnError(msg, url, line)
{
	if (top.location.href.indexOf('_files/errors/') == -1)
		top.location = '/evangelism/xbProjects/_files/errors/index.html?msg=' + escape(msg) + '&url=' + escape(url) + '&line=' + escape(line);
}

function reportError(message)
{
	if (top.location.href.indexOf('_files/errors/') == -1)
		top.location = '/evangelism/xbProjects/_files/errors/index.html?msg=' + escape(message);
}

function pageRequires(cond, msg, redirectTo)
{
	if (!cond)
	{
		msg = 'This page requires ' + msg;
		top.location = redirectTo + '?msg=' + escape(msg);
	}
	return cond;
}

function detectBrowser()
{
	var oldOnError = window.onerror;
	var element = null;
	
	window.onerror = defaultOnError;

	navigator.OS		= '';
	navigator.version	= 0;
	navigator.org		= '';
	navigator.family	= '';

	var platform;
	if (typeof(window.navigator.platform) != 'undefined')
	{
		platform = window.navigator.platform.toLowerCase();
		if (platform.indexOf('win') != -1)
			navigator.OS = 'win';
		else if (platform.indexOf('mac') != -1)
			navigator.OS = 'mac';
		else if (platform.indexOf('unix') != -1 || platform.indexOf('linux') != -1 || platform.indexOf('sun') != -1)
			navigator.OS = 'nix';
	}

	var i = 0;
	var ua = window.navigator.userAgent.toLowerCase();
	
	if (ua.indexOf('opera') != -1)
	{
		i = ua.indexOf('opera');
		navigator.family	= 'opera';
		navigator.org		= 'opera';
		navigator.version	= parseFloat('0' + ua.substr(i+6), 10);
	}
	else if ((i = ua.indexOf('msie')) != -1)
	{
		navigator.org		= 'microsoft';
		navigator.version	= parseFloat('0' + ua.substr(i+5), 10);
		
		if (navigator.version < 4)
			navigator.family = 'ie3';
		else
			navigator.family = 'ie4'
	}
	else if (typeof(window.controllers) != 'undefined' && typeof(window.locationbar) != 'undefined')
	{
		i = ua.lastIndexOf('/')
		navigator.version = parseFloat('0' + ua.substr(i+1), 10);
		navigator.family = 'gecko';

		if (ua.indexOf('netscape') != -1)
			navigator.org = 'netscape';
		else if (ua.indexOf('compuserve') != -1)
			navigator.org = 'compuserve';
		else
			navigator.org = 'mozilla';
	}
	else if ((ua.indexOf('mozilla') !=-1) && (ua.indexOf('spoofer')==-1) && (ua.indexOf('compatible') == -1) && (ua.indexOf('opera')==-1)&& (ua.indexOf('webtv')==-1) && (ua.indexOf('hotjava')==-1))
	{
	    var is_major = parseFloat(navigator.appVersion);
    
		if (is_major < 4)
			navigator.version = is_major;
		else
		{
			i = ua.lastIndexOf('/')
			navigator.version = parseFloat('0' + ua.substr(i+1), 10);
		}
		navigator.org = 'netscape';
		navigator.family = 'nn' + parseInt(navigator.appVersion);
	}
	else if ((i = ua.indexOf('aol')) != -1 )
	{
		navigator.family	= 'aol';
		navigator.org		= 'aol';
		navigator.version	= parseFloat('0' + ua.substr(i+4), 10);
	}

	navigator.DOMCORE1	= (typeof(document.getElementsByTagName) != 'undefined' && typeof(document.createElement) != 'undefined');
	navigator.DOMCORE2	= (navigator.DOMCORE1 && typeof(document.getElementById) != 'undefined' && typeof(document.createElementNS) != 'undefined');
	navigator.DOMHTML	= (navigator.DOMCORE1 && typeof(document.getElementById) != 'undefined');
	navigator.DOMCSS1	= ( (navigator.family == 'gecko') || (navigator.family == 'ie4') );

	navigator.DOMCSS2   = false;
	if (navigator.DOMCORE1)
	{
		element = document.createElement('p');
		navigator.DOMCSS2 = (typeof(element.style) == 'object');
	}

	navigator.DOMEVENTS	= (typeof(document.createEvent) != 'undefined');

	window.onerror = oldOnError;
}

detectBrowser();

function Folder(text,url,icon,target,status)
{ 
  this.desc = text 
  this.hreference = url 
  this.target = target 
  this.status = status 
  this.id = -1   
  this.navObj = 0  
  this.iconImg = 0  
  this.nodeImg = 0  
  this.isLastNode = 0 
  this.isOpen = true 
  this.iconSrc = icon   
  this.children = new Array 
  this.nChildren = 0 
  this.initialize = initializeFolder 
  this.setState = setStateFolder 
  this.addChild = addChild 
  this.createIndex = createEntryIndex 
  this.escondeBlock = escondeBlock
  this.esconde = escondeFolder 
  this.mostra = mostra 
  this.renderOb = drawFolder 
  this.totalHeight = totalHeight 
  this.subEntries = folderSubEntries 
  this.outputLink = outputFolderLink 
  this.blockStart = blockStart
  this.blockEnd = blockEnd
} 
 
function initializeFolder(level, lastNode, leftSide) 
{ 
  var j=0 
  var i=0 
  var numberOfFolders 
  var numberOfDocs 
  var nc 
  nc = this.nChildren 
  this.createIndex() 
  var auxEv = "" 
  if (browserVersion > 0) 
    auxEv = "<a href='javascript:clickOnNode("+this.id+")' onmouseover=\"status='';return true;\" onmouseout=\"status='';return true;\">" 
  else 
    auxEv = "<a>" 
  if (level>0) 
    if (lastNode)
    { 
      this.renderOb(leftSide + auxEv + "<img name='nodeIcon" + this.id + "' id='nodeIcon" + this.id + "' src='"+IMGPATH+"mlastnode.gif' width=16 height=22 border=0></a>") 
      leftSide = leftSide + "<img src='"+IMGPATH+"blank.gif' width=16 height=22>"  
      this.isLastNode = 1 
    } 
    else 
    { 
      this.renderOb(leftSide + auxEv + "<img name='nodeIcon" + this.id + "' id='nodeIcon" + this.id + "' src='"+IMGPATH+"mnode.gif' width=16 height=22 border=0></a>") 
      leftSide = leftSide + "<img src='"+IMGPATH+"vertline.gif' width=16 height=22>" 
      this.isLastNode = 0 
    } 
  else 
    this.renderOb("") 
  if (nc > 0) 
  { 
    level = level + 1 
    for (i=0 ; i < this.nChildren; i++)  
    { 
      if (i == this.nChildren-1) 
        this.children[i].initialize(level, 1, leftSide) 
      else 
        this.children[i].initialize(level, 0, leftSide) 
      } 
  } 
} 
 
function setStateFolder(isOpen) 
{ 
  var subEntries 
  var totalHeight 
  var fIt = 0 
  var i=0 
  if (isOpen == this.isOpen) return 
  if (browserVersion == 2)  
  { 
    totalHeight = 0 
    for (i=0; i < this.nChildren; i++) 
      totalHeight = totalHeight + this.children[i].navObj.clip.height 
      subEntries = this.subEntries() 
    if (this.isOpen) 
      totalHeight = 0 - totalHeight 
    for (fIt = this.id + subEntries + 1; fIt < nEntries; fIt++) 
      indexOfEntries[fIt].navObj.moveBy(0, totalHeight) 
  }  
  this.isOpen = isOpen 
  propagateChangesInState(this) 
} 
 
function propagateChangesInState(folder) 
{   
  var i=0 
  if (folder.isOpen) 
  { 
    if (folder.nodeImg) 
      if (folder.isLastNode) 
        folder.nodeImg.src = IMGPATH + "mlastnode.gif" 
      else 
	    folder.nodeImg.src = IMGPATH + "mnode.gif" 
    //folder.iconImg.src = "folderopen.gif" 
    for (i=0; i<folder.nChildren; i++) 
      folder.children[i].mostra() 
  } 
  else 
  { 
    if (folder.nodeImg) 
      if (folder.isLastNode) 
        folder.nodeImg.src = IMGPATH + "plastnode.gif" 
      else 
	    folder.nodeImg.src = IMGPATH + "pnode.gif" 
    //folder.iconImg.src = "folderclosed.gif"
    for (i=0; i<folder.nChildren; i++) 
      folder.children[i].esconde() 
  }  
} 
 
function escondeFolder() 
{ 
  this.escondeBlock()
  this.setState(0) 
} 
 
function drawFolder(leftSide) 
{ 
  var idParam = "id='folder" + this.id + "'"
  if (browserVersion == 2) { 
    if (!doc.yPos) 
      doc.yPos=20 
  } 
  this.blockStart("folder")
  doc.write("<tr><td>") 
  doc.write(leftSide) 
  this.outputLink() 
  doc.write("<img id='folderIcon" + this.id + "' name='folderIcon" + this.id + "' src='" + this.iconSrc+"' border=0 width=20 height=22></a>") 
  doc.write("</td><td valign=middle nowrap>") 
  if (USETEXTLINKS) 
  { 
    this.outputLink() 
    doc.write(this.desc + "</a>") 
  } 
  else 
    doc.write(this.desc) 
  doc.write("</td>")  
  this.blockEnd()
  if (browserVersion == 1) { 
    this.navObj = doc.all["folder"+this.id] 
    this.iconImg = doc.all["folderIcon"+this.id] 
    this.nodeImg = doc.all["nodeIcon"+this.id] 
  } else if (browserVersion == 2) { 
    this.navObj = doc.layers["folder"+this.id] 
    this.iconImg = this.navObj.document.images["folderIcon"+this.id] 
    this.nodeImg = this.navObj.document.images["nodeIcon"+this.id] 
    doc.yPos=doc.yPos+this.navObj.clip.height 
  } else if (browserVersion == 3) { 
    this.navObj = doc.getElementById("folder"+this.id)
    this.iconImg = doc.getElementById("folderIcon"+this.id) 
    this.nodeImg = doc.getElementById("nodeIcon"+this.id)
  } 
} 
 
function outputFolderLink() 
{ 
  if (this.hreference) 
  { 
    doc.write("<a " + this.hreference + " ") 
    if (browserVersion > 0) 
      doc.write(" onClick=\"javascript:clickOnFolder("+this.id+")\"") 
    doc.write(">") 
  } 
  else 
    doc.write("<a>") 
//  doc.write("<a href='javascript:clickOnFolder("+this.id+")'>")   
} 
 
function addChild(childNode) 
{ 
  this.children[this.nChildren] = childNode 
  this.nChildren++ 
  return childNode 
} 
 
function folderSubEntries() 
{ 
  var i = 0 
  var se = this.nChildren 
 
  for (i=0; i < this.nChildren; i++){ 
    if (this.children[i].children)
      se = se + this.children[i].subEntries() 
  } 
 
  return se 
} 
 
function Item(text,url,icon,target,status) {
  this.desc = text 
  this.link = url
	this.target = target 
	this.status = status 
  this.id = -1
  this.navObj = 0
  this.iconImg = 0
  this.iconSrc = icon 
  this.initialize = initializeItem 
  this.createIndex = createEntryIndex 
  this.esconde = escondeBlock
  this.mostra = mostra 
  this.renderOb = drawItem 
  this.totalHeight = totalHeight 
  this.blockStart = blockStart
  this.blockEnd = blockEnd
}

function initializeItem(level, lastNode, leftSide) 
{  
  this.createIndex() 
 
  if (level>0) 
    if (lastNode)
    { 
      this.renderOb(leftSide + "<img src='"+IMGPATH+"lastnode.gif' width=16 height=22>") 
      leftSide = leftSide + "<img src='"+IMGPATH+"blank.gif' width=16 height=22>"  
    } 
    else 
    { 
      this.renderOb(leftSide + "<img src='"+IMGPATH+"node.gif' width=16 height=22>") 
      leftSide = leftSide + "<img src='"+IMGPATH+"vertline.gif' width=16 height=22>" 
    } 
  else 
    this.renderOb("")   
} 
 
function drawItem(leftSide) 
{ 
  this.blockStart("item")
  doc.write("<tr><td>") 
  doc.write(leftSide) 
  doc.write("<a " + this.link + " >") 
  doc.write("<img id='itemIcon"+this.id+"' ") 
  doc.write("src='"+this.iconSrc+"' border=0 width=20 height=22>") 
  doc.write("</a>") 
  doc.write("</td><td valign=middle nowrap>") 
  if (USETEXTLINKS) 
    doc.write("<a " + this.link + " >" + this.desc + "</a>") 
  else 
    doc.write(this.desc) 
  this.blockEnd()
  if (browserVersion == 1) { 
    this.navObj = doc.all["item"+this.id] 
    this.iconImg = doc.all["itemIcon"+this.id] 
  } else if (browserVersion == 2) { 
    this.navObj = doc.layers["item"+this.id] 
    this.iconImg = this.navObj.document.images["itemIcon"+this.id] 
    doc.yPos=doc.yPos+this.navObj.clip.height 
  } else if (browserVersion == 3) { 
    this.navObj = doc.getElementById("item"+this.id)
    this.iconImg = doc.getElementById("itemIcon"+this.id)
  } 
} 
 
 
function mostra() 
{ 
  if (browserVersion == 1 || browserVersion == 3) 
    this.navObj.style.display = "block" 
  else 
    this.navObj.visibility = "show" 
} 

function escondeBlock() 
{ 
  if (browserVersion == 1 || browserVersion == 3) { 
    if (this.navObj.style.display == "none") 
      return 
    this.navObj.style.display = "none" 
  } else { 
    if (this.navObj.visibility == "hiden") 
      return 
    this.navObj.visibility = "hiden" 
  }     
} 
 
function blockStart(idprefix) {
  var idParam = "id='" + idprefix + this.id + "'"
  if (browserVersion == 2) doc.write("<layer "+ idParam + " top=" + doc.yPos + " visibility=show>") 
  if (browserVersion == 3) doc.write("<div " + idParam + " style='display:block; position:block;'>")
  doc.write("<table border=0 cellspacing=0 cellpadding=0 ") 
  if (browserVersion == 1) doc.write(idParam + " style='display:block; position:block; '>") 
  else doc.write(">") 
}

function blockEnd() {
  doc.write("</table>") 
  if (browserVersion == 2) doc.write("</layer>") 
  if (browserVersion == 3) doc.write("</div>") 
}
 
function createEntryIndex() 
{ 
  this.id = nEntries 
  indexOfEntries[nEntries] = this 
  nEntries++ 
} 
 
function totalHeight()
{ 
  var h = this.navObj.clip.height 
  var i = 0 
  if (this.isOpen)
    for (i=0 ; i < this.nChildren; i++)  
      h = h + this.children[i].totalHeight() 
  return h 
} 

 
function clickOnFolder(folderId) 
{ 
  var clicked = indexOfEntries[folderId] 
  if (!clicked.isOpen) 
    clickOnNode(folderId) 
  return  
  if (clicked.isSelected) 
    return 
} 
 
function clickOnNode(folderId) 
{ 
  var clickedFolder = 0 
  var state = 0 
 
  clickedFolder = indexOfEntries[folderId] 
  state = clickedFolder.isOpen 
 
  clickedFolder.setState(!state)
} 

function gFld(text,url,icon,target,status) {
  fullLink = " " 
	if (url!="") {
	  fullLink = "href=\""+url+"\" "  
	}
	if (target!="") {
		fullLink = fullLink + " target=\""+target+"\" "
	}
	if (status!="") {
		fullLink = fullLink + " title=\""+status+"\" onmouseover=\"status='"+status+"';return true;\" onmouseout=\"status='';return true;\" "
	}
  folder = new Folder(text,fullLink,icon,target,status) 
  return folder 
}

function gLnk(text,url,icon,target,status) {
  fullLink = " " 
	if (url!="") {
	  fullLink = "href=\""+url+"\" "  
	}
	if (target!="") {
		fullLink = fullLink + " target=\""+target+"\" "
	}
	if (status!="") {
		fullLink = fullLink + " title=\""+status+"\" onmouseover=\"status='"+status+"';return true;\" onmouseout=\"status='';return true;\" "
	}
  linkItem = new Item(text,fullLink,icon,target,status)   
  return linkItem 
}
 
function insFld(parentFolder, childFolder) 
{ 
  return parentFolder.addChild(childFolder) 
} 
 
function insDoc(parentFolder, document) 
{ 
  parentFolder.addChild(document) 
} 
 

USETEXTLINKS = 1 
STARTALLOPEN = 0
indexOfEntries = new Array 
nEntries = 0 
doc = document 
browserVersion = 0 
selectedFolder=0
IMGPATH = ""


function initializeDocument() 
{ 
  switch(navigator.family)
  {
    case 'ie4':
      browserVersion = 1
      break;
    case 'nn4':
      browserVersion = 2
      break;
    case 'gecko':
      browserVersion = 3
      break;
	default:
	  browserVersion = 0
	  break;
  }      

  navTree.initialize(0, 1, "") 
  
  if (browserVersion == 2) 
    doc.write("<layer top="+indexOfEntries[nEntries-1].navObj.top+">&nbsp;</layer>") 
  if (!STARTALLOPEN)
	  if (browserVersion > 0) { 
	  	clickOnNode(0) 
			clickOnNode(0) 
	  } 

  if (browserVersion == 0) doc.write("<table border=0><tr><td><br /><br /><font size=-1>This tree only expands or contracts with DHTML capable browsers</font></table>")
} 
 
