		var offsetfromcursorX=12; //Customize x offset of tooltip
		var offsetfromcursorY=10; //Customize y offset of tooltip
		
		var offsetdivfrompointerX=10; //Customize x offset of tooltip DIV relative to pointer image
		var offsetdivfrompointerY=14; //Customize y offset of tooltip DIV relative to pointer image. Tip: Set it to (height_of_pointer_image-1).
		
		document.write('<div id="dhtmltooltip">tooltip</div>'); //write out tooltip DIV
		
		//write out divs to hold pointers
		document.write('<DIV id="upper_left_arrow">upperleft</DIV>');
		document.write('<DIV id="upper_right_arrow">upperright</DIV>');
		document.write('<DIV id="lower_left_arrow">lowerleft</DIV>');
		document.write('<DIV id="lower_right_arrow">lowerright</DIV>');
		//getting ie and ns6 variables
		var ie=document.all;
		var ns6=document.getElementById && !document.all;

		//initially don't want to show
		var enabletip=false;
		if (ie||ns6) {
			var tipobj=document.all? document.all["dhtmltooltip"] : document.getElementById? document.getElementById("dhtmltooltip") : "";
		}
		var pointerobj;
		
		function ietruebody(){
			return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body;
		}
		//function that actually enables the tooltip
		function tip(thetext, thewidth, thecolor){
			if (ns6||ie){
				if (typeof thewidth!="undefined") {
					tipobj.style.width=thewidth+"px";
				}
				if (typeof thecolor!="undefined" && thecolor!="") {
					tipobj.style.backgroundColor=thecolor;
				}
				tipobj.innerHTML=thetext;
				enabletip=true;
				return false;
			}
		}
		//event called on mouse movement
		function positiontip(e){

			//if tip is enabled
			if (enabletip){
			
				//hide old arrow
				pointerobj.style.visibility="hidden";

				//get current position
				var curX=(ns6)?e.pageX : event.clientX+ietruebody().scrollLeft;
				var curY=(ns6)?e.pageY : event.clientY+ietruebody().scrollTop;
				
				//Find out how close the mouse is to the corner of the window
				var winwidth=ie&&!window.opera? ietruebody().clientWidth : window.innerWidth-20;
				var winheight=ie&&!window.opera? ietruebody().clientHeight : window.innerHeight-20;
				
				//get edge information
				var rightedge=ie&&!window.opera? winwidth-event.clientX-offsetfromcursorX : winwidth-e.clientX-offsetfromcursorX;
				var bottomedge=ie&&!window.opera? winheight-event.clientY-offsetfromcursorY : winheight-e.clientY-offsetfromcursorY;
				var leftedge=(offsetfromcursorX<0)? offsetfromcursorX*(-1) : -1000;

				//variable to see if right edge has been reached
				var right=false;
				
				//if the horizontal distance isn't enough to accomodate the width of the context menu
				if (rightedge<tipobj.offsetWidth){
					
					//move the horizontal position of the menu to the left by it's width
					tipobj.style.left=curX-tipobj.offsetWidth+"px";
					right = true;

					//place on right side of tip object
					pointerobj.style.left=curX-offsetfromcursorX-(2*offsetdivfrompointerX)+"px";

				}
				else if (curX<leftedge) {
					tipobj.style.left="5px";
				}
				else{
					//position the horizontal position of the menu where the mouse is positioned
					tipobj.style.left=curX+offsetfromcursorX-offsetdivfrompointerX+"px";
					
					//place on left side of tip object
					pointerobj.style.left=curX+offsetfromcursorX+"px";
				}
				
				//if bottom needs to be displayed
				if (bottomedge<tipobj.offsetHeight){

					//initial height for tip object
					tipobj.style.top=curY-tipobj.offsetHeight-offsetfromcursorY+"px";
	
					//if right display lower right, otherwise display left
					if(right) {
						pointerobj=document.all? document.all["lower_right_arrow"] : document.getElementById? document.getElementById("lower_right_arrow") : "";
					}
					else {
						pointerobj=document.all? document.all["lower_left_arrow"] : document.getElementById? document.getElementById("lower_left_arrow") : "";
					}
						
					//account for shadow if IE
					if(ie) {
						//comment out if not using shadow in IE
						pointerobj.style.top=curY-offsetdivfrompointerY-5+"px";
					}
					//account for 3 pixels lost by drawing tip for FF
					else {
						pointerobj.style.top=curY-offsetdivfrompointerY+3+"px";
					}
				}

				//otherwise display upper ones
				else{
					
					//initial height for tip object
					tipobj.style.top=curY+offsetfromcursorY+offsetdivfrompointerY+"px";
					
					//if right, display upper right, if not, display left
					if(right) {
						pointerobj=document.all? document.all["upper_right_arrow"] : document.getElementById? document.getElementById("upper_right_arrow") : "";
					}
					else {
						pointerobj=document.all? document.all["upper_left_arrow"] : document.getElementById? document.getElementById("upper_left_arrow") : "";
					}
					
					//upper position of pointer object
					pointerobj.style.top=curY+offsetfromcursorY+"px";

				}

				//match background color of pointer to div
				var kids = pointerobj.childNodes;
				for(var i=0; i<kids.length; i++) {

					//if ie style...
					if(tipobj.currentStyle) {
						kids[i].style.backgroundColor = tipobj.currentStyle['backgroundColor'];
					}
					//otherwise mozilla?
					else if(window.getComputedStyle) {
						if(kids[i].className != 'arrow_tip') {
							kids[i].style.backgroundColor = document.defaultView.getComputedStyle(tipobj,null).getPropertyValue('background-color');
						}
					}
					else {
						//other style...
					}
				}

				//set all to visible
				tipobj.style.visibility="visible";
				pointerobj.style.visibility="visible";
			}
		}
		
		//hides tooltip
		function hide_tip(){
			if (ns6||ie){

				//disable tip
				enabletip=false;

				//hide all objects
				tipobj.style.visibility="hidden";
				pointerobj.style.visibility="hidden";
				tipobj.style.left="-1000px";
			}
		}
		//function initially draws arrows using only CSS
		function draw_arrows() {
			var div = document.getElementById('upper_left_arrow');
			var h = '';
			var end = 15;
			
			//upper left pointer 
			if(!ie) {
				//initial tip for FF aarow
				h += "<DIV class='arrow_tip' style='width: 1px;'></DIV>";
				h += "<DIV class='arrow_tip' style='width: 2px;'></DIV>";
				h += "<DIV class='arrow_tip' style='width: 3px;'></DIV>";
				end = 12;
			}

			//printing out main triangle
			for(var i=0; i<end; i++) {
				h += "<DIV class='arrow' style='width: " + (i) + "px;'>";
				h += "</DIV>";
			}
			div.innerHTML = h;


			//lower left pointer
			div = document.getElementById('lower_left_arrow');
			h = '';

			//main triangle
			for(var i=end; i>0; i--) {
				h += "<DIV class='arrow' style='width: " + (i) + "px;'>";
				h += "</DIV>";
			}
			
			if(!ie) {
				//tip for FF arrow
				h += "<DIV class='arrow_tip' style='width: 3px;'></DIV>";
				h += "<DIV class='arrow_tip' style='width: 2px;'></DIV>";
				h += "<DIV class='arrow_tip' style='width: 1px;'></DIV>";
			}
			div.innerHTML = h;
			

			//lower right pointer
			div = document.getElementById('lower_right_arrow');
			h = '';
			
			//main triangle
			for(var i=end; i>0; i--) {
				h += "<DIV class='arrow' style='border-left-width: 2px; border-right-width: 1px; width: " + (i) + "px;'>";
				h += "</DIV>";
			}
			if(!ie) {
				//tip for FF arrow
				h += "<DIV class='arrow_tip' style='width: 3px;'></DIV>";
				h += "<DIV class='arrow_tip' style='width: 2px;'></DIV>";
				h += "<DIV class='arrow_tip' style='width: 1px;'></DIV>";
			}
			div.innerHTML = h;


			//upper right pointer
			div = document.getElementById('upper_right_arrow');
			h = '';
			if(!ie) {
				//tip for FF arrow
				h += "<DIV class='arrow_tip' style='width: 1px;'></DIV>";
				h += "<DIV class='arrow_tip' style='width: 2px;'></DIV>";
				h += "<DIV class='arrow_tip' style='width: 3px;'></DIV>";
			}

			//main triangle
			for(var i=0; i<end; i++) {
				h += "<DIV class='arrow' style='border-left-width: 2px; border-right-width: 1px; width: " + (i) + "px;'>";
				h += "</DIV>";
			}
			div.innerHTML = h;

			
			//initially select upper left
			pointerobj=document.all? document.all["upper_left_arrow"] : document.getElementById? document.getElementById("upper_left_arrow") : ""
		}
		//initially draw out arrows
		draw_arrows();

		//set onmousemove event to position tip
		document.onmousemove=positiontip;
