function winOpen(iUrl,iTarget,iWidth,iHeight,iStyle,returnVar,iLeft,iTop) {
	var oWin, lStr, tStr, wStr, hStr;
	
	if (iLeft) lStr = ',left=' + iLeft;
	else if (iWidth) lStr = ',left=' + Math.floor((screen.width - iWidth) / 2);
	if (iTop) tStr = ',top=' + iTop;
	else if (iHeight) tStr = ',top=' + Math.floor((screen.height - iHeight) / 2);
	
	if (iHeight) hStr = ',height=' + iHeight;
	if (iWidth) wStr = ',width=' + iWidth;
	
	if (!iStyle) iStyle = '';
	
	oWin = window.open(iUrl,iTarget,iStyle + hStr + wStr + lStr + tStr);
	if (oWin.focus) oWin.focus();

	if (returnVar) return oWin;
}