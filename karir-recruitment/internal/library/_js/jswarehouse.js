////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// List of Function : 
// 1. function PopWindow(theUrl,theTitle,theWidth, theHeight, theAttributes)
// 2. function deletespaces(str)
// 3. function check_spec_char(object_value,spec_char)
// 4. function ValidateAny(object_value,any_format)
// 5. function ValidateUser(object_value)
// 6. function ValidateString(object_value)
// 7. function ValidateNumber(object_value)
// 8. function ValidateEmail(object_value)
// 9. function ValidatePhone(object_value)  
// 11. function ValidateStringNum(object_value)  
// 12. function ValidateStringNumSpace(object_value)  
// 13. function ValidateCurrency(object_value)  
// 14. function ValidateDecimal(object_value)  
// 15. function ValidateAddress(object_value)
// 16. function check_creditcard(object_value)
// 17. function check_integer(object_value,int_format)
// 18. function check_number(object_value,number_format)
// 19. function number_range(object_value, min_value, max_value)
// 20. function check_email(emailad) 
// 21. function check_ext(Path, Ext)
// 22. function checkFriend(txt)
// 22. function TotDayInMonth(intMonth,intYear)
// 23. function check_date(object_value,varsplit)
// 24. function ChangeDate(objdate,objmonth,objyear)
// 25. function ChangeTime(changeid,objstartH,objstartM,objdurH,objdurM,objendH,objendM)
// 26. function change_wddx(source_object,target_object,var_wddx,sourceid_field,targetid_field,targetval_field)
// 27. function funClock() 
// 27. function IsValidTime() 
////////////////////////////////////////////////////////////////////////////////////////////////////////////////


/*********************************************************************************************************************************/
// Syntax :
// PopWindow(URL, Title, Width, Height, Attributes);
// Example :
// PopWindow('http://doweb1/satria/test.cfm','WindowName', '730', '580', 'scrollbars=yes,location=yes,status=yes');
// Attributes Parameter can be filled with following options :
// toolbar=no/yes, location=no/yes, directories=no/yes, status=no/yes, menubar=no/yes, scrollbars=no/yes, resizable=no/yes 

function PopWindow(theUrl,theName,theWidth, theHeight, theAttributes) 
{    	
	if (theUrl.length == 0 || theWidth.length == 0 || theHeight.length == 0)
		return false;

	var theLeft = Math.round((screen.width - theWidth) / 2);
	var theTop = Math.round((screen.height - theHeight) / 2);
		
	var varAttributes = "width="+theWidth+",height="+theHeight+",left="+theLeft+",top="+theTop;	
	
	if (theAttributes.length == 0)
		varAttributes = varAttributes + ",toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no";
	else
		varAttributes = varAttributes + "," + theAttributes;
	window.open(theUrl,theName,varAttributes);		
}
/*********************************************************************************************************************************/


/*********************************************************************************************************************************/
// Usage : 
//	 if (deletespaces(document.formname.formfield.value).length == 0)
// 	 {
//		alert("Fill in the field");
//		document.formname.formfield.focus();	
//	 } 

function trimkarakter(str)
{
	if (str.length == 0)	
		return false;
		
	hasil = "";	tamp = ""; i = 0;		
	do
	{		
		if (str.charAt(i) == " ")
		{
			tamp = str.charAt(i);
			i++;
		}
		else tamp = '%';
	} while (tamp == " ");
	
	j = str.length - 1;		
	do
	{
		if (str.charAt(j) == " ")
		{
			tamp = str.charAt(j);
			j--;
		}
		else tamp = '%';
	} while (tamp == " ");
		
	for (k=i;k<=j;k++)
		hasil = hasil + str.charAt(k);
		
	return hasil;
}

function deletespaces(str)
{
	var A = new Array();
	A = str.split("\n");
	str = A.join("");
	A = str.split(" ");	
	str = A.join("");
	A = str.split("\t");
	str = A.join("");
	
	return str;
}
/*********************************************************************************************************************************/


/*********************************************************************************************************************************/
// Usage :
//   spec_char = "";  Fill in with 'not allowed' Special Character, blank to use default;
//	 if (!check_spec_char(document.formname.formfield.value,spec_char)
// 	 {
//		alert("Fill in the field");
//		document.formname.formfield.focus();	
//	 } 			
function check_spec_char(object_value,spec_char)
{
	if (object_value.length == 0)	
		return true;
	
	if (spec_char == null)
		return false;
			
    if (spec_char.length == 0)
		spec_char = '~`/-!$#%^&*()+={}[]|\\:;"\'<,>?';
						
	var check;				
	for (var i = 0; i < object_value.length; i++)
	{
		check = spec_char.indexOf(object_value.charAt(i));
		if (check > 0)
			return false;
		else if (check == 0) 
			return false;
	}	
	
	return true;
}
/*********************************************************************************************************************************/


/*********************************************************************************************************************************/
function selectunselect(object_value)
{
	for (i=0;i<object_value.length;i++)
		//object_value[i].checked = (object_value[i].checked == true ? false : true);
		object_value[i].checked = object_value[0].checked; 
}
/*********************************************************************************************************************************/


/*********************************************************************************************************************************/
// Usage : 
//   allow_char = "";  Fill in with 'allowed' Regular Expression;
//	 if (ValidateAny(document.formname.formfield.value,allow_char))
// 	 {
//		alert("Fill in the field");
//		document.formname.formfield.focus();	
//	 } 
// Use this function for 'User Defined' Regular Expression

//'^[a-zA-Z]([ ]|[\][a-zA-Z])*$'
function ValidateAny(object_value,any_format)
{
	if (any_format == null)
		return false;
		
	if (any_format.length == 0)
		return false;
		
	any_pattern = new RegExp(any_format);
	return object_value.search(any_pattern);
}
/*********************************************************************************************************************************/


/*********************************************************************************************************************************/
// Usage : 
//	 if (ValidateLocNat(document.formname.formfield.value))
// 	 {
//		alert("Fill in the field");
//		document.formname.formfield.focus();	
//	 } 
// Use this function to accept string that begins with a letter,  
// may follow by space or letters(a-zA-Z).
// Use this function usually to check Province/State input like : DKI Jakarta. 
function ValidateLocNat(object_value)
{
	locnat_pattern=new RegExp('^[a-zA-Z]([ ]?[a-zA-Z])+$');
	return object_value.search(locnat_pattern);
}
/*********************************************************************************************************************************/


/*********************************************************************************************************************************/
// Usage : 
//	 if (ValidateUser(document.formname.formfield.value))
// 	 {
//		alert("Fill in the field");
//		document.formname.formfield.focus();	
//	 } 
// Use this function to accept string that begin with a letter, 
// followed by letters(a-zA-Z) or numbers(0-9) or underscore(_) and no spaces
function ValidateUser(object_value)
{
	user_pattern=new RegExp('^[a-zA-Z]([a-zA-Z]|[_0-9])*$');
	return object_value.search(user_pattern);
}
/*********************************************************************************************************************************/


/*********************************************************************************************************************************/
// Usage : 
//	 if (ValidateString(document.formname.formfield.value))
// 	 {
//		alert("Fill in the field");
//		document.formname.formfield.focus();	
//	 } 
// Use this function to accept only string[a-zA-Z] 
function ValidateString(object_value)
{
	string_pattern=new RegExp('^[a-zA-Z]+$');
	return object_value.search(string_pattern);
}
/*********************************************************************************************************************************/


/*********************************************************************************************************************************/
// Usage : 
//	 if (ValidateNumber(document.formname.formfield.value))
// 	 {
//		alert("Fill in the field");
//		document.formname.formfield.focus();	
//	 } 
// Use this function to accept only positif numeric value[0-9]
function ValidateNumber(object_value)
{	
	num_pattern=new RegExp('^[0-9]+$'); 
	return object_value.search(num_pattern);
}
/*********************************************************************************************************************************/


/*********************************************************************************************************************************/
// Usage :
//	 if (ValidateEmail(document.formname.formfield.value)
// 	 {
//		alert("Wrong Email Syntax!!");
//		document.formname.formfield.focus();	
//	 } 	
// Use this function to accept a valid email address
// This function is using 'allowed' character.
function ValidateEmail(object_value)
{		
	email_pattern=new RegExp('^[a-zA-Z0-9]+(([_]|\\.|-)?[a-zA-Z0-9])*@([a-zA-Z0-9]+([_]|-?[a-zA-Z0-9])*(\\.))+[a-zA-Z]{2,4}$');
	return object_value.search(email_pattern);
}
/*********************************************************************************************************************************/


/*********************************************************************************************************************************/
// Usage : 
//	 if (ValidatePhone(document.formname.formfield.value))
// 	 {
//		alert("Fill in the field");
//		document.formname.formfield.focus();	
//	 } 
// Use this function to accept a phone number
// Example : 62.21.5296440
// Still have some bugs in this function. Don't use it first
function ValidatePhone(object_value)
{
	phone_pattern=new RegExp('^[^\']*$');
	return object_value.search(phone_pattern);
}
/*********************************************************************************************************************************/


/*********************************************************************************************************************************/
function check_many_phone(txt)
{			
	var friendList = new Array()
	
	friendList = eval("txt").split(',');
	for (i=0;i<friendList.length;i++)
	{	
		if (ValidatePhone(friendList[i]))
			return false;
	}

	return true;
}
/*********************************************************************************************************************************/


/*********************************************************************************************************************************/
// Usage : 
//	 if (ValidateStringNumSpace(document.formname.formfield.value))
// 	 {
//		alert("Fill in the field");
//		document.formname.formfield.focus();	
//	 } 
// Use this function to accept a string and number and spaces
function ValidateStringNumSpace(str)
{
locnatpattern=new RegExp('^[a-zA-Z0-9]([ ]?[a-zA-Z0-9])+$');
return str.search(locnatpattern);
}
/*********************************************************************************************************************************/

/*********************************************************************************************************************************/
// Usage : 
//	 if (ValidateStringNum(document.formname.formfield.value))
// 	 {
//		alert("Fill in the field");
//		document.formname.formfield.focus();	
//	 } 
// Use this function to accept a string and number 
function ValidateStringNum(str)
	{
	membernamepattern=new RegExp('^[a-zA-Z0-9]*$');
	return str.search(membernamepattern);
	}
/*********************************************************************************************************************************/

	

/*********************************************************************************************************************************/
// Usage :
//	 if (ValidateCurrency(document.formname.formfield.value))
// 	 {
//		alert("Fill in the field");
//		document.formname.formfield.focus();	
//	 } 		
// Use this function to accept a currency format
function ValidateCurrency(txt)
	{
	currency_pattern=new RegExp('^[0-9]*(([.]|[,])?[0-9])+$');
	return txt.search(currency_pattern);
	}
/*********************************************************************************************************************************/


/*********************************************************************************************************************************/
// Usage :
//	 if (ValidateDecimal(document.formname.formfield.value))
// 	 {
//		alert("Fill in the field");
//		document.formname.formfield.focus();	
//	 } 			
// Use this function to accept a decimal number format
function ValidateDecimal(txt)
	{
	currency_pattern=new RegExp('^[0-9]*[\.]([0-9]{1,2}$)|[0-9]+$');
	return txt.search(currency_pattern);
	}
/*********************************************************************************************************************************/


/*********************************************************************************************************************************/
// Usage : 
//	 if (ValidateAddress(document.formname.formfield.value))
// 	 {
//		alert("Fill in the field");
//		document.formname.formfield.focus();	
//	 } 
// Use this function to accept a valid address
// Example :  - St. Dreamland Avenue blk.37 #25-28 
//			  -	PT. Esprit de Corp. 
//			  - PT. Seven Up, ltd. 
function ValidateAddress(object_value)
{
	address_pattern=new RegExp('^[a-zA-Z0-9]([a-zA-Z\&\,\.\#\-\:]|[0-9 ])*$');
	return object_value.search(address_pattern);
}
/*********************************************************************************************************************************/


/*********************************************************************************************************************************/
// Usage : 
//	 if (!check_creditcard(document.formname.formfield.value))
// 	 {
//		alert("Fill in the field");
//		document.formname.formfield.focus();	
//	 } 
// Use this function to accept a valid credit card number
function check_creditcard(object_value)
{
	var white_space = " -";
	var creditcard_string = "";
	var check_char;

    if (object_value.length == 0)
        return true;

	for (var i = 0; i < object_value.length; i++)
	{
		check_char = white_space.indexOf(object_value.charAt(i))
		if (check_char < 0)
			creditcard_string += object_value.substring(i, (i + 1));
	}	

    if (creditcard_string.length == 0)
        return false;
	 	 	
	if (creditcard_string.charAt(0) == "+")
        return false;

	if (!check_integer(creditcard_string,""))
		return false;

	var doubledigit = creditcard_string.length % 2 == 1 ? false : true;
	var checkdigit = 0;
	var tempdigit;

	for (var i = 0; i < creditcard_string.length; i++)
	{
		tempdigit = eval(creditcard_string.charAt(i))
		if (doubledigit)
		{
			tempdigit *= 2;
			checkdigit += (tempdigit % 10);
			if ((tempdigit / 10) >= 1.0)
			{
				checkdigit++;
			}
			doubledigit = false;
		}
		else
		{
			checkdigit += tempdigit;
			doubledigit = true;
		}
	}	
	
	return (checkdigit % 10) == 0 ? true : false;
}
/*********************************************************************************************************************************/


/*********************************************************************************************************************************/
// Usage : 
// int_format = "";  Fill in with 'allowed' Integer Format
//	 if (!check_integer(document.formname.formfield.value,int_format))
// 	 {
//		alert("Fill in the field");
//		document.formname.formfield.focus();	
//	 } 
// Use this function to accept a valid Integer Format
// If number_format is not blank (not ""), the function will use the defined number_format
// If number_format is blank (""), the function will use following format :
// The number value can be +/- number.
// Example : -3, +62, 62.
function check_integer(object_value,int_format)
{
    if (object_value.length == 0) 
		return true;
	
	if (int_format == null)
		return false;	
			
	var decimal_format = ".";
	var check_char;
	
	if (int_format.length != 0)
	{
		for(i=0;i<object_value.length;i++)
		{
			check = int_format.indexOf(object_value.charAt(i));		
			if(check == -1) return false;
		}	
	}
	else 
	{		
		check_char = object_value.indexOf(decimal_format)
    	if (check_char < 0)
			return check_number(object_value,"");
		else
			return false;
	}
	return true;
}
/*********************************************************************************************************************************/


/*********************************************************************************************************************************/
// Usage : 
// number_format = "";  Fill in with 'allowed' Number Format
//	 if (!check_number(document.formname.formfield.value,number_format))
// 	 {
//		alert("Fill in the field");
//		document.formname.formfield.focus();	
//	 } 
// Use this function to accept a valid Number Format
// If number_format is not blank (not ""), the function will use the defined number_format
// If number_format is blank (""), the function will use following format :
// The number value can be +/- number, decimal number.
// Example : -3, -3.25, +62, 62, 62.5, 62500.2
function check_number(object_value,number_format)
{
    if (object_value.length == 0) 
		return true;
	
	if (number_format == null)
		return false;
	
	if (number_format.length != 0)
	{
		for(i=0;i<object_value.length;i++)
		{
			check = number_format.indexOf(object_value.charAt(i));		
			if(check == -1) return false;
		}	
	}
	else
	{			
		var start_format = " .+-0123456789";
		var number_format = " .0123456789";
		var check_char;
		var decimal = false;
		var trailing_blank = false;
		var digits = false;
		check_char = start_format.indexOf(object_value.charAt(0))
		if (check_char == 1)
		   	decimal = true;
		else if (check_char < 1)
			return false;
		for (var i = 1; i < object_value.length; i++)
		{
			check_char = number_format.indexOf(object_value.charAt(i))
			if (check_char < 0)
				return false;
			else if (check_char == 1)
			{
				if (decimal)	
					return false;
				else
					decimal = true;
			}
			else if (check_char == 0)
			{
				if (decimal || digits)	
					trailing_blank = true;
			}
		   	else if (trailing_blank)
				return false;
			else
				digits = true;
		}		
	}
	return true;
}
/*********************************************************************************************************************************/


/*********************************************************************************************************************************/
// Usage : 
//	 if (!number_range(document.formname.formfield.value,min_value,max_value))
// 	 {
//		alert("Fill in the field");
//		document.formname.formfield.focus();	
//	 } 
// Use this function to accept a Number in a range format between min_value and max_value
// Return True if  the number is min_value, max_value, or between the range.
// Example : number_range(document.formname.formfield.value,1,3)
// It will return true if the value is 1,2,3.
function number_range(object_value, min_value, max_value)
{
	if (object_value.length == 0)
		return true;
		
	if (min_value == null)
		return false;

	if (max_value == null)
		return false;	
		
	if (!check_number(object_value,""))
	{
		return false;
	}
	else
	{
		if (min_value != null)
			if (object_value < min_value)
				return false;

		if (max_value != null)
			if (object_value > max_value)
				return false;	
	}
	
	return true;
}
/*********************************************************************************************************************************/


/*********************************************************************************************************************************/
// This function is deprecated. Use ValidateEmail instead.
//function check_email(mail)
//{
	//mailpatern = new RegExp('^[a-zA-Z]+(([_]|\\.)?[a-zA-Z0-9])*@([a-zA-Z0-9]+([_]?[a-zA-Z0-9])*(\\.))+[a-zA-Z]{2,4}$');
    //mailpatern = new RegExp('^[a-zA-Z]+(([_]|\\.)?[a-zA-Z0-9_-])*@([a-zA-Z0-9_-]+([_]?[a-zA-Z0-9-_])*(\\.))+[a-zA-Z]{2,4}$');	
	//mailpattern = new RegExp('^[^0-9-()<>:?&*!~`=|#$%]+@[^#$%]*(\\.)+[^#$%]{2,4}$');
//	mailpattern = new RegExp('^[a-zA-Z]+(([_]|\\.|-)?|[a-zA-Z0-9])*@([a-zA-Z0-9]+([_]?[a-zA-Z0-9])*(\\.))+[a-zA-Z]{2,4}$');
//    return mail.search(mailpattern);
//}
/*********************************************************************************************************************************/


/*********************************************************************************************************************************/
// Usage : 
//	 if (!check_email(document.formname.formfield.value))
// 	 {
//		alert("Fill in the field");
//		document.formname.formfield.focus();	
//	 } 
// Use this function to accept a valid Email Address 
// This is the other way to describe a valid Email Address
// This function is using 'not allowed' characters.
function check_email(emailad) 
{
	a = emailad.split(";")
	var exclude=/[^@\-\.\w]|^[_@\.\-]|[\._\-]{2}|[@\.]{2}|(@)[^@]*\1/;
	var check=/@[\w\-]+\./;
	var checkend=/\.[a-zA-Z]{2,3}$/;
	for(i=0;i<a.length;i++)
	{
	  emailad = a[i];			  
	  if(((emailad.search(exclude) != -1)||(emailad.search(check)) == -1)||(emailad.search(checkend) == -1))
	   	   return false
	}
	return true
}	
/*********************************************************************************************************************************/


/*********************************************************************************************************************************/
// Usage : 
//   var Ext = 'gif*jpg*GIF*JPG';   //Separated by *
//	 if (!check_ext(document.formname.formfield.value,valid_ext))
// 	 {
//		alert("Wrong extension");
//		document.formname.formfield.focus();	
//	 } 
// Use this function to accept an allowed file upload extension.
function check_ext(Path, Ext)
{
	if (Ext == null)
		return false;
		
	var arrPathExt = new Array();
	arrPathExt     = Path.split('.');
	var PathExt    = arrPathExt[arrPathExt.length-1];

	var arrRightExt = new Array();
	arrRightExt     = Ext.split('*');
	var	ExtIsRight  = false;

	for (i=0; i<arrRightExt.length; i++) 
		ExtIsRight = ExtIsRight || (PathExt==arrRightExt[i]);
		
	return ExtIsRight;
}
/*********************************************************************************************************************************/


/*********************************************************************************************************************************/
// Usage : 
//	 if (!checkFriend(document.formname.formfield.value))
// 	 {
//		alert("Invalid Email Address in the list!");
//		document.formname.formfield.focus();	
//	 } 
// Use this function to check a valid Email Address in the list(textarea) 
// Email address separated by semicolon (;)
// Example : mailme@anywhere.com;replyme@soon.com
function checkFriend(txt)
{			
	var friendList = new Array()
	
	friendList = eval("txt").split(';');
	for (i=0;i<friendList.length;i++)
	{	
		if (ValidateEmail(friendList[i]))
			return false;
	}

	return true;
}
/*********************************************************************************************************************************/


/*********************************************************************************************************************************/
function TotDayInMonth(intMonth,intYear)
{
	if((intMonth == 1) || (intMonth == 3) || (intMonth == 5) || (intMonth == 7) || (intMonth == 8) || (intMonth == 10) || (intMonth == 12))
		return 31;
	else if ((intMonth == 4) || (intMonth == 6) || (intMonth == 9) || (intMonth == 11))
		return 30;
	else if (intMonth == 2)
		return (((intYear % 4) == 0) ? 29 : 28);		
}
/*********************************************************************************************************************************/


/*********************************************************************************************************************************/
function check_date(object_value,varsplit)
{		
	/*if (ValidateDate(object_value))
		return false; */
		
	if (varsplit == null)
		return false;		
			
	if (varsplit.length == 0)
		varsplit = "/";
		
	var inpDate = new Array();
	inpDate = object_value.split(varsplit);
	
	var buildmonth = inpDate[0];
	var builddate = inpDate[1];	
	var buildyear = inpDate[2];
	
	if (inpDate.length < 3) return false;
	if (ValidateNumber(buildmonth)) return false;
	if (ValidateNumber(builddate)) return false;
	if (ValidateNumber(buildyear)) return false;
		
	var d = new Date();
	var Nowyear = d.getYear();
	var Nowhour = d.getHours();
	var Nowmin = d.getMinutes();
	var Nowsec = d.getSeconds();
		
	var maxday = TotDayInMonth(inpDate[0],inpDate[2]);
				
	buildmonth = eval(buildmonth) - 1;
	var TimeNow = new Date(buildyear,buildmonth,builddate,Nowhour,Nowmin,Nowsec);
		
	if (TimeNow == d) return false;		
	if (inpDate[0] == 00 || inpDate[0] > 12) return false;
	if (inpDate[1] == 00 || inpDate[1] > maxday) return false;
	//if (inpDate[2] == 0000 || inpDate[2] > Nowyear) return false;
	
	return true;
}
/*********************************************************************************************************************************/

/*********************************************************************************************************************************/
function check_datebackforward(object_value,varsplit)
{		
	/*if (ValidateDate(object_value))
		return false; */
		
	if (varsplit == null)
		return false;		
			
	if (varsplit.length == 0)
		varsplit = "/";
		
	var inpDate = new Array();
	inpDate = object_value.split(varsplit);
	
	var buildmonth = inpDate[0];
	var builddate = inpDate[1];	
	var buildyear = inpDate[2];
	
	if (inpDate.length < 3) return false;
	if (ValidateNumber(buildmonth)) return false;
	if (ValidateNumber(builddate)) return false;
	if (ValidateNumber(buildyear)) return false;
		
	var d = new Date();
	var Nowyear = d.getYear();
	var Nowhour = d.getHours();
	var Nowmin = d.getMinutes();
	var Nowsec = d.getSeconds();
		
	var maxday = TotDayInMonth(inpDate[0],inpDate[2]);
				
	buildmonth = eval(buildmonth) - 1;
	var TimeNow = new Date(buildyear,buildmonth,builddate,Nowhour,Nowmin,Nowsec);
		
	if (TimeNow == d) return false;		
	if (inpDate[0] == 00 || inpDate[0] > 12) return false;
	if (inpDate[1] == 00 || inpDate[1] > maxday) return false;
	//if (inpDate[2] == 0000 || inpDate[2] > Nowyear) return false;
	
	return true;
}
/*********************************************************************************************************************************/

/*********************************************************************************************************************************/
function check_date_tomorrowonly(object_value,varsplit)
{		
	/*if (ValidateDate(object_value))
		return false; */
		
	if (varsplit == null)
		return false;		
			
	if (varsplit.length == 0)
		varsplit = "/";
		
	var inpDate = new Array();
	inpDate = object_value.split(varsplit);
	
	var buildmonth = inpDate[0];
	var builddate = inpDate[1];	
	var buildyear = inpDate[2];
	
	if (inpDate.length < 3) return false;
	if (ValidateNumber(buildmonth)) return false;
	if (ValidateNumber(builddate)) return false;
	if (ValidateNumber(buildyear)) return false;
		
	var d = new Date();	
	var Nowyear = d.getYear();
	var Nowmonth = d.getMonth();
	var Nowdate = d.getDate();
	Nowdate = eval(Nowdate) - 1;
	var Nowhour = d.getHours();
	var Nowmin = d.getMinutes();
	var Nowsec = d.getSeconds();
		
	var maxday = TotDayInMonth(inpDate[0],inpDate[2]);
				
	buildmonth = eval(buildmonth) - 1;	
	var TimeNow = new Date(buildyear,buildmonth,builddate,Nowhour,Nowmin,Nowsec);
	//d = new Date(Nowyear,Nowmonth,Nowdate,Nowhour,Nowmin,Nowsec);
	
	/*alert('timenow='+TimeNow+'\n'+'d='+d)
	if (TimeNow == d) 
		alert('timenow == d')
	else if (TimeNow < d)
		alert('timenow < d')
	else if (TimeNow > d)
		alert('timenow > d')*/
	
	if (TimeNow < d) return false;
	if (inpDate[0] == 00 || inpDate[0] > 12) return false;
	if (inpDate[1] == 00 || inpDate[1] > maxday) return false;
	//if (inpDate[2] == 0000 || inpDate[2] > Nowyear) return false;
	if (inpDate[2] === 0000) return false;
	
	return true;
}
/*********************************************************************************************************************************/

/*********************************************************************************************************************************/
// Sample Usage : 
//	 <select name="selMonth" onchange="ChangeDate(document.frmAppointment.selDay,document.frmAppointment.selMonth,document.frmAppointment.selYear);"> 	
//	 <select name="selDay">
//   <select name="selYear" onchange="ChangeDate(document.frmAppointment.selDay,document.frmAppointment.selMonth,document.frmAppointment.selYear);">
// Use this function to check the date in 3 select box, date select, month select, and year select
// Note : The previous function of this ChangeDate() function is ChangeTime(5), only for id 5, the rest is using the ChangeTime() function below.

function ChangeDate(objdate,objmonth,objyear)
{
    var seldate = objdate.selectedIndex;
	var selmonth = objmonth.selectedIndex;
	var selyear = objyear.selectedIndex;
				
	intTotDay = TotDayInMonth(selmonth+1,objyear.options[selyear].value);
	objdate.options.length = intTotDay;	
	
	for (i=1;i<=intTotDay;i++)
	{
		objdate.options[i-1].value = i;
		objdate.options[i-1].text = i;
	}
	seldate = ((seldate > intTotDay-1) ? intTotDay-1 : seldate);
	
	return true; 					
}	

/*function ChangeDate(objdate,objmonth,objyear)
{										
	var seldate = objdate.selectedIndex;
	var selmonth = objmonth.selectedIndex;
	var selyear = objyear.selectedIndex;
	
	if (selmonth > 0)
	{
		intTotDay = TotDayInMonth(selmonth,objyear.options[selyear].value);	
		objdate.options.length = intTotDay;	
		for (i=1;i<=intTotDay;i++)
		{
			objdate.options[i-1].value = i;
			objdate.options[i-1].text = i;
		}
		objyear.options.length = 133;
		j = 1960;
		for (i=1;i<=133;i++)
		{
			objyear.options[i-1].value = j;
			objyear.options[i-1].text = j;
			j++;
		}		
		seldate = ((seldate > intTotDay-1) ? intTotDay-1 : seldate);
	}
	else
	{
		intTotDay = 1;	
		objdate.options.length = intTotDay;
		objdate.options[0].value = 0;
		objdate.options[0].text = 'Day';
		objyear.options.length = intTotDay;
		objyear.options[0].value = 0;
		objyear.options[0].text = 'Year';
	}
			
	return true;
}*/	
/*********************************************************************************************************************************/


/*********************************************************************************************************************************/
// Sample Usage : 
//  id 1 : 	<select name="selStartMinutes" onchange="ChangeTime(1,
//						document.frmAppointment.selStartHours,
//						document.frmAppointment.selStartMinutes,
//						document.frmAppointment.selDurHours,
//						document.frmAppointment.selDurMinutes,
//						document.frmAppointment.selEndHours,
//						document.frmAppointment.selEndMinutes);">
//				<cfloop index="intMinutes" from="0" to="59" step="#duration#">
//						<option value="#intMinutes#" <cfif intMinutes eq selStartMinutes>SELECTED</cfif>>:#NumberFormat(intMinutes,'09')#
//				</cfloop>
//			</select>
//			This id 1 is used to change the End Time value based on the Start Time value + Duration value. This change is put in Start Time onchange
// id 2 :   <select name="selDurHours" onchange="ChangeTime(2,
//						document.frmAppointment.selStartHours,
//						document.frmAppointment.selStartMinutes,
//						document.frmAppointment.selDurHours,
//						document.frmAppointment.selDurMinutes,
//						document.frmAppointment.selEndHours,
//						document.frmAppointment.selEndMinutes);">
//				<cfloop index="intTime" from="0" to="23">
//					<option value="#intTime#" <cfif intTime eq selDurHours>SELECTED</cfif>>#NumberFormat(intTime,'09')#
//				</cfloop>
// 		    </select>
//			This id 2 is used to change the End Time value based on the Start Time value + Duration value. This change is put in Duration onchange
// id 3 :   <select name="selEndMinutes" onchange="ChangeTime(3,
//						document.frmAppointment.selStartHours,
//						document.frmAppointment.selStartMinutes,
//						document.frmAppointment.selDurHours,
//						document.frmAppointment.selDurMinutes,
//						document.frmAppointment.selEndHours,
//						document.frmAppointment.selEndMinutes);">
//				<cfloop index="intMinutes" from="0" to="59" step=#duration#>
//					<option value="#intMinutes#" <cfif intMinutes eq selEndMinutes>SELECTED</cfif>>:#NumberFormat(intMinutes,'09')#
//				</cfloop>
// 		    </select>		
// 			This id 3 is used to change the Duration Time value based on the End Time value - Start Time value. This change is put in End Time onchange
//	id 4 :  <input onclick= "ChangeTime(4,
//						document.frmAppointment.selStartHours,
//						document.frmAppointment.selStartMinutes,
//						document.frmAppointment.selDurHours,
//						document.frmAppointment.selDurMinutes,
//						document.frmAppointment.selEndHours,
//						document.frmAppointment.selEndMinutes);" 
//			  type="Checkbox" name="chkAllDay" 
//			  <cfif Len(Trim(chkAllDay)) and ((chkAllDay eq "on") or (chkAllDay eq "1"))>CHECKED</cfif>>
//  		This id 4 is used to change the Start Time to 12.00 AM, Duration Time to 23:50, End Time to 11.50 PM together.
function ChangeTime(changeid,objstartH,objstartM,objdurH,objdurM,objendH,objendM)
{	
	var selStartH = objstartH.selectedIndex;
	var selStartM = objstartM.selectedIndex;
	var selDurH = objdurH.selectedIndex;
	var selDurM = objdurM.selectedIndex;	
	var selEndH = objendH.selectedIndex;
	var selEndM = objendM.selectedIndex;
		
	var intStartH = objstartH.options[selStartH].value*1;
	var intDurH = objdurH.options[selDurH].value*1;	
	var intEndH = objendH.options[selEndH].value*1;
	
	var intStartM = objstartM.options[selStartM].value*1;
	var intDurM = objdurM.options[selDurM].value*1;	
	var intEndM = objendM.options[selEndM].value*1;
	
	if (changeid == 1 || changeid == 2)
	{
		   //var d, s = "Today's date is: ";           //Declare variables.
		   //d = new Date();                           //Create Date object.
		   //s += (d.getMonth() + 1) + "/";            //Get month
		   //s += d.getDate() + "/";                   //Get day
		   //s += d.getYear();                         //Get year.
		   //return(s);                                //Return date.
	
		var dtEndDate = new Date(2000,1,1,intStartH + intDurH, intStartM + intDurM,0);
		var intEndH = dtEndDate.getHours();
		var intEndM = dtEndDate.getMinutes();
			
		for(i=0;i<objendH.options.length;i++)
			objendH.options[i].selected = (objendH.options[i].value == intEndH);
		for(i=0;i<objendM.options.length;i++)
			objendM.options[i].selected = (objendM.options[i].value == intEndM);
	}			
	else if (changeid == 4)
	{			
			var intEndHour = objendH.options[objendH.options.length-1].value*1;
			var intEndMin = objendM.options[objendM.options.length-1].value*1;
			var intStartHour = objstartH.options[0].value*1;
			var intStartMin = objstartM.options[0].value*1;			
			var	intDurHour = intEndHour - intStartHour;
			var intDurMin = intEndMin - intStartMin;
						
			objendH.options[objendH.options.length-1].selected = true;
			objendM.options[objendM.options.length-1].selected = true;
			objstartH.options[0].selected = true;
			objstartM.options[0].selected = true;									
			//document.frmAppointment.chkAllDay.checked = true;
			
			for(i=0;i<objdurH.options.length;i++)
				objdurH.options[i].selected = (objdurH.options[i].value == intDurHour);
			for(i=0;i<objdurM.options.length;i++)
				objdurM.options[i].selected = (objdurM.options[i].value == intDurMin);				
	}		
	else if (changeid == 3)
	{
		var dtStartDate = new Date(2000,1,1,intStartH,intStartM,0);
		var dtEndDate = new Date(2000,1,1,intEndH,intEndM,0);
		var intDiff = (dtEndDate.getTime() - dtStartDate.getTime()) / 60000;
		if((intDiff*1) < 0)
		{
			intStartH = intEndH - intDurH;
			intStartM = intEndM - intDurM;
			intStartH = (intStartH < 0 ? 0 : intStartH);
			intStartM = (intStartM < 0 ? 0 : intStartM);
			dtStartDate = new Date(2000,1,1,intStartH,intStartM,0);
			intDiff = (dtEndDate.getTime() - dtStartDate.getTime()) / 60000;
			
			for(i=0;i<objstartH.options.length;i++)
				objstartH.options[i].selected = (objstartH.options[i].value == intStartH);
			for(i=0;i<objstartM.options.length;i++)
				objstartM.options[i].selected = (objstartM.options[i].value == intStartM);	
		}
			
		var intDurHour = Math.floor(intDiff / 60);
		var	intDurMin = intDiff % 60;									
				
		for(i=0;i<objdurH.options.length;i++)
			objdurH.options[i].selected = (objdurH.options[i].value == intDurHour);		
		for(i=0;i<objdurM.options.length;i++)
			objdurM.options[i].selected = (objdurM.options[i].value == intDurMin);
	}		
	return true;
}
/*********************************************************************************************************************************/

/*********************************************************************************************************************************/
//  Use this function to change between multiple select type with wddx.
//  Usage :
//  1. Build the cf settings. (The caller file).
//		<CFPARAM NAME="selCountry" DEFAULT=O>
//		<CFPARAM NAME="selState" DEFAULT=0>
//	 	<CFPARAM NAME="selCity" DEFAULT=0> 
//		<CFQUERY NAME = "qCountry" DATASOURCE = "#DSN#"> SELECT	TCountry.* FROM	TCountry Order By Country_Name </CFQUERY>
//		<CFQUERY NAME = "qCountryState" DATASOURCE = "#DSN#"> SELECT TCountryState.* FROM TCountryState Order By Country_ID,State_ID </CFQUERY>
//		<CFQUERY NAME = "qCountryState1" DATASOURCE = "#DSN#"> SELECT TCountryState.* FROM TCountryState WHERE Country_ID=#selCountry# Order By Country_ID,State_ID </CFQUERY>
//		<CFQUERY NAME = "qCountryCity" DATASOURCE = "#DSN#"> SELECT TCountryCity.* FROM TCountryCity Order By State_ID,City_ID </CFQUERY>
//  	<CFQUERY NAME = "qCountryCity1" DATASOURCE = "#DSN#"> SELECT TCountryCity.* FROM TCountryCity WHERE State_ID=#selState# Order By State_ID,City_ID </CFQUERY>
// 	2. Put the "wddx.js" file in the same file of the caller of this script (File in step 1).
//     	<script language="JavaScript" src="wddx.js"></script>  // the wddx.js file
//     	<script language="JavaScript" src="allscript.js"></script>  // this file
//  3. Put the cfwddx function at the file of the caller of this script. (File in step 1).
//		<script language="JavaScript">
//	    	<cfwddx action="CFML2JS" input="#qCountryState#" toplevelvariable="State">
//	    	<cfwddx action="CFML2JS" input="#qCountryCity#" toplevelvariable="City">
//		</script>
//  4. Set the cf settings. (The caller file).
//		<tr>
//			<td>Country : </td>
//			<td><select name="selCountry" onchange="change_wddx(document.frmtest.selCountry,document.frmtest.selState,State,'country_id','state_id','state_name');
//					change_wddx(document.frmtest.selState,document.frmtest.selCity,City,'state_id','city_id','city_name');">
//					 	 <cfloop query="qCountry">
//							<option value="#Country_id#"<cfif Country_id eq selcountry>selected</cfif>>#Country_Name#</option>
//					   	 </cfloop>
//			 	</select>
//			</td>
//		</tr>
//		<tr>
//			<td>State : </td>
//			<td><select name="selState" onchange="change_wddx(document.frmtest.selState,document.frmtest.selCity,City,'state_id','city_id','city_name');">
//				   <cfloop query="qCountryState1">
//					     <option value="#State_id#"<cfif State_id eq selState>selected</cfif>>#State_Name#</option>
//				   </cfloop>	
//				   <cfif #qCountryState1.Recordcount# eq 0>
//				         <option value="0"<cfif #selState# eq 0>selected</cfif>>Other</option>
//				   </cfif>  
//				   <option></option><option></option><option></option>
//				</select>
//			</td>
//		</tr>
//		<tr>
//			<td>City : </td>
//			<td><select name="selCity">
// 			   		<cfloop query="qCountryCity1">
//				    	 <option value="#City_id#"<cfif City_id eq selcity>selected</cfif>>#City_Name#</option> 					 
//				    </cfloop>	
//					<cfif #qCountryCity1.Recordcount# eq 0>
//			  			 <option value="0"<cfif #selCity# eq 0>selected</cfif>>Other</option>
//			   		</cfif>
//					<option></option><option></option><option></option>
//			 	</select>
//			</td>
//		</tr>
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//  5. Important Part : 
//	   <select name="selState" onchange="change_wddx(document.frmtest.selState,document.frmtest.selCity,City,'state_id','city_id','city_name');">
//	   The change_wddx function has 6 parameter : 
//	   Parameter 1 : Form select Source object (The first select that you click)
//	   Parameter 2 : Form select Target object (The select that change when you click the 1st select)
//	   Parameter 3 : TopLevelVariabel from the Target <cfwddx> 
//	   Parameter 4 : Database Field Name from the First Select value
//	   Parameter 5 : Database Field Name for the Second Select value
//	   Parameter 6 : Database Field Name for the Second Select display
// 	   eq. Source = Country and Target = State, or Source = State and Target = City
//	   Note that when you call the Change for Country, you should call this function twice, 'cause 
//	   the First is when you change the State (Source = Country and Target = State)
//	   and Second is when you change the City (Source = State and Target = City)
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function change_wddx(source_object,target_object,var_wddx,sourceid_field,targetid_field,targetval_field)
{
	var index = source_object.selectedIndex;
	var sourceval = source_object.options[index].value;
	var reccount = var_wddx.getRowCount();
	var i = 0;
		
	for (j=0;j<reccount;j++)
	{
		getval = var_wddx.getField(j,sourceid_field);
		if (sourceval == getval)
		{			
			target_object.options.length = i + 1;
			target_object.options[i].value = var_wddx.getField(j,targetid_field);
			target_object.options[i].text = var_wddx.getField(j,targetval_field);			
			i++;
			//target_object.options[i] = new Option(var_wddx.getField(j,targetval_field),var_wddx.getField(j,targetid_field),false,true)
		}
	}
	if (i == 0)
	{
		target_object.options.length = i + 1;
		target_object.options[i].value = 0;
		target_object.options[i].text = 'Other';
		i++;
		target_object.options[0].selected = true;				
	}		
}
/*********************************************************************************************************************************/


/*********************************************************************************************************************************/
// Usage : 
//	 Put this function in your body onload() : 
//		<body onload="funClock();">
// Use this function to display moving digital clock continuously.
// Works Fine in IE, need some modifications in your layer display position in Netscape.
// Example :
// 	<tr>
//		<td>Now is : </td>
//		<td><font color="brown" face="Arial" size="3">
//			<cfif FindNoCase("MSIE", CGI.HTTP_USER_AGENT)>
//				<div id = "clock" style="position:relative"></div>
//			</cfif>	
//    			<layer name="clock" bgcolor="Lime"></layer>
//			</font>
//		</td>
//	</tr>
function MakeArrayday(size) 
{
	this.length = size;
	for(var i = 1; i <= size; i++) 
	{
		this[i] = "";
	}
	return this;
}
function MakeArraymonth(size) 
{
	this.length = size;
	for(var i = 1; i <= size; i++) 
	{
		this[i] = "";
	}
	return this;
}
function funClock() 
{
	if (!document.layers && !document.all) return;
	
	var runTime = new Date();
	var hours = runTime.getHours();
	var minutes = runTime.getMinutes();
	var seconds = runTime.getSeconds();
	var dn = "AM";
	
	if (hours >= 12) 
	{
		dn = "PM";
		hours = hours - 12;
	}
	if (hours == 0) 
	{
		hours = 12;
	}
	if (minutes <= 9) 
	{
		minutes = "0" + minutes;
	}
	if (seconds <= 9) 
	{
		seconds = "0" + seconds;
	}
	movingtime = hours + ":" + minutes + ":" + seconds + " " + dn;
	if (document.layers) 
	{
		document.layers.clock.document.write(movingtime);
		document.layers.clock.document.close();
	}
	else if (document.all) 
	{
		clock.innerHTML = movingtime;
	}
	setTimeout("funClock()", 1000)
}
/*********************************************************************************************************************************/


/*********************************************************************************************************************************/
// Usage : 
//	 Is Valid Time is used to validate Time entered
//   Note. when using this function, you don't have to user the alert function.
//	if (!IsValidTime(thisform.txtStartEnd.value))
//		{
//			thisform.txtStartEnd.focus();
//		}
function IsValidTime(timeStr)
{
	var timePat = /^(\d{1,2}):(\d{2})(:(\d{2}))?(\s?(AM|am|PM|pm))?$/;
	var matchArray = timeStr.match(timePat);
	if (matchArray == null)
	{
		alert("Time is not in a valid format.");
		return false;
	}
	hour = matchArray[1];
	minute = matchArray[2];
	second = matchArray[4];
	ampm = matchArray[6];

	if (second=="") { second = null; }
	if (ampm=="") { ampm = null }

	if (hour < 0  || hour > 23)
		{
		alert("Hour must be between 0 and 23 for military time");
		return false;
		}
	if (minute<0 || minute > 59)
		{
		alert ("Minute must be between 0 and 59.");
		return false;
		}
	if (second != null && (second < 0 || second > 59))
		{
		alert ("Second must be between 0 and 59.");
		return false;
		}
		return true
		}
/*********************************************************************************************************************************/

/*********************************************************************************************************************************/
// Usage : 
//	limitChar function is used to limit the text filled in the textarea
// <tr><td colspan="2" valign="top"><textarea name="txt_Message" cols="40" rows="5" wrap="hard" onkeyup="limitChar(this,this.form.txt_nbchar,160)"></textarea></td></tr>
// <tr><td><font color="0000FF">max 160 characters</font></td><td><input type="Text" name="txt_nbchar" size="3" readonly value="160"></td></tr>
/*********************************************************************************************************************************/
function limitChar(obj_,obj_target,nbmax)
{	if (obj_.value.length > nbmax)
		{	obj_.value=obj_.value.substring(0,nbmax)
			alert("Sorry, you have reached maximum character allowed");
		}
	obj_target.value=nbmax-obj_.value.length;
}
/*********************************************************************************************************************************/

/*********************************************************************************************************************************/
// Usage : 
/*********************************************************************************************************************************/
function valid_dateformat(object_value)
{	
	varsplit = "/";

	var inpDate = new Array();
	inpDate = object_value.split(varsplit);
	
	for(i=0;i<2;i++)
	{
		if (inpDate[i].length == 1)
		 inpDate[i] = '0'+ inpDate[i]
	}
	var x = inpDate[0]+'/'+inpDate[1]+'/'+inpDate[2]
	return x;
}
/*********************************************************************************************************************************/


/*********************************************************************************************************************************/
// Usage : 
/*********************************************************************************************************************************/

function change_dateformat(object_value)
{	
	varsplit = "/";

	x = valid_dateformat(object_value);

	var inpDate = new Array();
	inpDate = x.split(varsplit);
	
	var x = inpDate[2]+'/'+inpDate[0]+'/'+inpDate[1]
	return x;
}
/*********************************************************************************************************************************/	

function mOvr(src,clrOver)
{
	if (!src.contains(event.fromElement))
	{
		src.style.cursor = 'hand';
		src.bgColor = clrOver;
		src.style.borderStyle="outset";
		src.style.borderColor=clrOver;
		//src.style.borderWidth="1pt";
	}
}
function nOvr(src,clrOver)
{
	src.style.cursor = 'hand';
	src.bgColor = clrOver;
}
function mOut(src,clrIn)
{
	if (!src.contains(event.toElement))
	{
		src.style.cursor = 'default';
		src.bgColor = clrIn;
		src.style.borderStyle="solid";
		src.style.borderColor=clrIn;
		//src.style.borderWidth="0pt";
	}
}
function mClk(src)
{
	if(event.srcElement.tagName=='TD')
	{
		src.style.borderStyle="inset";
		//src.style.borderWidth="1pt";
		src.children.tags('A')[0].click();
	}
}
function mDwn(src)
{
	src.style.borderStyle="inset";
	//src.style.borderWidth="1pt";
}

function setCheck(state) {
	var frmEL = document.frmFileList.elements;
	var idx;
	for (var i=1;i<=frmEL["FILECOUNT"].value;i++) {
		idx = "FILEID_" + i;
		frmEL[idx].checked = state;
	}
}

function IsOneChecked() {
	var frmEL = document.frmFileList.elements;
	var idx;
	for (var i=1;i<=frmEL["FILECOUNT"].value;i++) {
		idx = "FILEID_" + i;
		if (frmEL[idx].checked) return true;
	}
	return false;
}