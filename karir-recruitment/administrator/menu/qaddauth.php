<%
		strsql = "insert into Tbl_Authorization(Auth_Name,Auth_Desc,Parent_ID,Level_ID,URLID,Menu,lang_id,lang_en) values('" & request.form("txtname") & "','" & request.form("txtdesc") & "',0,0," & request.form("urlid") & ","&request.form("chkauth")&",'"&  trim(request.form("txtlang_id")) &"','"&  trim(request.form("txtlang_en")) &"')"
		CN.EXECUTE (strsql)
		
%>
<script language="JavaScript">
	alert("Record Inserted!");
	location = "authorization.asp?URLEncode=<%=Server.URLEncode(Now())%>";
</script>