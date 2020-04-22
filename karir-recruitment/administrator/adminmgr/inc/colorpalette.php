<? if (!isset($task)) $task = "0"; ?>
<html>
<head><title>Color Palette</title>
<style>
  #PaletteStatus{cursor:default;}
  #Palette{cursor:hand;}
  #Palette td {width:8px;height:15px;}
  #PaletteStatus{padding:5px;}
  #cpAColor {font-size:6px;width:30px;height:18px;border:1px solid black}
  #cpAColorHex {font-size:12px}  
</style>
<script language="JScript" for="PICK" event="onclick">
	<? if ($task=="1") {?>
	eval(parent).setBodyBGColor(cpAColorHex.value,<?=$instance?>);
	<? } else {?>
	eval(parent).bs_quickfontcolor(cpAColorHex.value,<?=$instance?>);
	<? } ?>
</script>
<script>
	document.oncontextmenu = function(){return false}
	if(document.layers) {
	    window.captureEvents(Event.MOUSEDOWN);
	    window.onmousedown = function(e){
	        if(e.target==document)return false;
	    }
	}
	else {
	    document.onmousedown = function(){return false}
	}
</script>
<script>
  var zColor = new Array();
  var namedColors = new Array();
  namedColors["#000000"] = "black";
  namedColors["#0000ff"] = "blue";
  namedColors["#ff0000"] = "red";
  namedColors["#ff00ff"] = "fuchsia";
  namedColors["#00ff00"] = "lime";
  namedColors["#00ffff"] = "aqua";
  namedColors["#ffff00"] = "yellow";
  namedColors["#ffffff"] = "white";
  
  var iColors = 0;
  var iRed, iGreen, iBlue;
  
  for(r=0; r<6; r++)	{
  for(g=0; g<6; g++) {
  	for(b=0; b<6; b++) {
  		iRed = 51*r;
  		iGreen = 51*g;
  		iBlue = 51*b;
  		
  		iRed = iRed.toString(16);
  		iGreen = iGreen.toString(16);
  		iBlue = iBlue.toString(16);
  		
  		if(iRed=="0") iRed = "00";
  		if(iGreen=="0") iGreen = "00";
  		if(iBlue=="0") iBlue = "00";
  		
  		zColor[iColors] =  "#" + iGreen + iRed + iBlue;
  		iColors++;
  	}
  }
  }
  
  function doMouseOver(){
  	var el = window.event.srcElement;
    if(el.style.backgroundColor){
      cpAColor.style.backgroundColor = el.style.backgroundColor;
      cpAColorHex.value = el.style.backgroundColor;
    }
  }

  function ChangeColor(){
    cpAColor.style.backgroundColor = cpAColorHex.value;
		return true;
  }
	
	function isHex() {
    return (((event.keyCode >= 48) && (event.keyCode <= 57)) || ((event.keyCode >= 65) && (event.keyCode <= 70)) || ((event.keyCode >= 97) && (event.keyCode <= 102)) || (event.keyCode == 35))
	}
	
  function doMouseOut(){
    cpAColor.style.backgroundColor = "buttonface";
    cpAColor.innerText = "";
    cpAColorHex.value = "";
  }
	
  function doClick() {
  	var el = window.event.srcElement;
    color = el.currentStyle.backgroundColor;
  	if (color != "") {
			<? if ($task=="1") {?>
			eval(parent).setBodyBGColor(color,<?=$instance?>);
			<? } else {?>
			eval(parent).bs_quickfontcolor(color,<?=$instance?>);
			<? } ?>
  	}
  }
	
  function MakeGrid()
  {
  	var oTab = document.getElementById("Palette");
    
  	oTab.attachEvent("onmouseover", doMouseOver);
  	oTab.attachEvent("onmouseout", doMouseOut); 
  	oTab.attachEvent("onmouseout", doMouseOut);   
   	oTab.attachEvent("onclick", doClick);
  
  	for(i=0; i<12; i++)
  	{
  		var oRow = oTab.insertRow();
  		for(j=0; j<18; j++)
  		{
  			var oCell = oRow.insertCell();
  			iCellCount = (i*18) + j;
  			oCell.style.backgroundColor = zColor[iCellCount];
        if (eval("namedColors[\""+zColor[iCellCount].toLowerCase() +"\"]"))
          oCell.namedColor = eval("namedColors[\""+zColor[iCellCount]+"\"]");
        else 
          oCell.namedColor = "";
  		}
  	}
  }
</script>
</head>
<body scroll="no" onload="MakeGrid();" style="margin:2px;border:outset 2px" bgcolor="buttonface">
<table border="0" cellspacing="1" cellpadding="0" id="Palette" align="center">
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" id="PaletteStatus">
	<tr>
		<td align="left"><span id="cpAColor"></span></td>
		<td align="right"><input id="cpAColorHex" maxlength="7" name="cpAColorHex" onkeypress="event.returnValue=isHex();" onkeydown="ChangeColor();" type="text" style="text-align:center;font-family:verdana,helvetica;font-size:8pt;width:70px;border:1px inset"></td>
		<td align="left"><input type="button" value="Pick" id="PICK" style="text-align:center;font-family:verdana,helvetica;font-size:8pt;border:1px solid outset"></td>
	</tr>
</table>
</body>
</html>
