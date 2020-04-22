var whitespace = " \t\n\r";

function isEmpty(s){   
	return ((s == null) || (s.length == 0))
}

function isWhitespace (s){   
	var i;
    if (isEmpty(s)) return true;
    for (i = 0; i < s.length; i++)
    {   
	var c = s.charAt(i);

	if (whitespace.indexOf(c) == -1) return false;
    }
    return true;
}

function isEmail (s){  
	if (isEmpty(s)) 
       if (isEmail.arguments.length == 1) return false;
       else return (isEmail.arguments[1] == true);
    if (isWhitespace(s)) return false;
    var i = 1;
    var sLength = s.length;
    while ((i < sLength) && (s.charAt(i) != "@"))
    { i++
    }
    if ((i >= sLength) || (s.charAt(i) != "@")) return false;
    else i += 2;
    while ((i < sLength) && (s.charAt(i) != "."))
    { i++
    }
    if ((i >= sLength - 1) || (s.charAt(i) != ".")) return false;
    else return true;
}
	
	
	function handleEnter (field, event, tipe) {		
		var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
		if (keyCode == 13 || keyCode == 9 ) {
			not_error = true;
			if (tipe == 2 && field.value != ''){				
				not_error = cek_tanggal(field);
			}						
			if (not_error){
				var i;
				for (i = 0; i < field.form.elements.length; i++)
					if (field == field.form.elements[i])
						break;
				i = (i + 1) % field.form.elements.length;
				go_focus(field, i);
			}			
			return false;
		} else {
			if (tipe == 1){ // untuk hanya bisa input Ya dan tidak
				if (keyCode == 116 || keyCode == 84) field.value = 'T';
				if (keyCode == 121 || keyCode == 89) field.value = 'Y';
				return false;
			} else if (tipe == 2){ // untuk hanya bisa input tanggal
				error = false;
				if (keyCode < 48 || keyCode > 57){					
					if (keyCode == 8 || keyCode == 9 || keyCode == 37 || keyCode == 39 || keyCode == 45 || keyCode == 47) return true;
					else return false;
				}		
			} else if (tipe == 3){ // untuk hanya bisa input numerik
				if (keyCode < 48 || keyCode > 57){					
					if (keyCode == 8 || keyCode == 9 || keyCode == 37 || keyCode == 39 || keyCode == 46) return true;
					else return false;
				} else {
					return true;					
				}
			} else if (tipe == 4){ // untuk hanya bisa input numerik,slash dan desc
				if (keyCode < 48 || keyCode > 57){					
					if (keyCode == 8 || keyCode == 9 || keyCode == 45 || keyCode == 47) return true;
					else return false;
				} else {
					return true;					
				}
			} else if (tipe == 5){ // untuk hanya bisa input huruf
				if (keyCode < 65 || keyCode > 90 && keyCode < 95 || keyCode > 122){					
					if (keyCode == 8 || keyCode == 9 || keyCode == 32 || keyCode == 45 || keyCode == 46) return true;
					else return false;
				} else {
					return true;					
				}
			} else if (tipe == 6){ // untuk hanya bisa input numerik aja
				if (keyCode < 48 || keyCode > 57){					
					if (keyCode == 8 || keyCode == 9) return true;
					else return false;
				} else {
					return true;					
				}
			}
			return true;
		}
	}      
