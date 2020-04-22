function Trim(s) {
  while ((s.substring(0,1) == ' ') || (s.substring(0,1) == '\n') || (s.substring(0,1) == '\r')){
    s = s.substring(1,s.length);
  }
  while ((s.substring(s.length-1,s.length) == ' ') || (s.substring(s.length-1,s.length) == '\n') || (s.substring(s.length-1,s.length) == '\r')){
    s = s.substring(0,s.length-1);
  }
  return s;
}

function LoadCheckDATA (sample_form, script_name, parameter) {
	    CheckDATA (sample_form, script_name+"?checkdata.php&"+parameter, 0);
}

function OpenPDF (url){	
	javascript:void window.open(url,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');
	
}

function CheckDATA (sample_form, script_name, isDebug) {
	 var isExist = document.getElementById(sample_form);
	 window.status="Loading ...";	 

	 if (isExist==null){
		 var rpc=document.createElement("iframe");
	  	 rpc.setAttribute("id", sample_form);
  		 document.getElementsByTagName("body")[0].appendChild(rpc);
		 if (isDebug!=1) document.getElementById(sample_form).style.display = "none";
  		 rpc.setAttribute("src",script_name);
	 }else{
		 if (isDebug!=1) document.getElementById(sample_form).style.display = "none";
  		 document.getElementById(sample_form).src = script_name;
	 }
	 window.status="";	 
}