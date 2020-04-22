		function button_over(eButton){
			eButton.style.borderBottom = "buttonshadow solid 1px";
			eButton.style.borderLeft = "buttonhighlight solid 1px";
			eButton.style.borderRight = "buttonshadow solid 1px";
			eButton.style.borderTop = "buttonhighlight solid 1px";
		}
		function button_out(eButton){
			//eButton.style.borderColor = "threedface";
			eButton.style.borderBottom = "buttonshadow solid 0px";
			eButton.style.borderLeft = "buttonhighlight solid 0px";
			eButton.style.borderRight = "buttonshadow solid 0px";
			eButton.style.borderTop = "buttonhighlight solid 0px";
		}
		function button_down(eButton){
			eButton.style.borderBottom = "buttonhighlight solid 1px";
			eButton.style.borderLeft = "buttonshadow solid 1px";
			eButton.style.borderRight = "buttonhighlight solid 1px";
			eButton.style.borderTop = "buttonshadow solid 1px";
		}
		function button_up(eButton){
			eButton.style.borderBottom = "buttonshadow solid 1px";
			eButton.style.borderLeft = "buttonhighlight solid 1px";
			eButton.style.borderRight = "buttonshadow solid 1px";
			eButton.style.borderTop = "buttonhighlight solid 1px";
			eButton = null; 
		}
		function PopWindowHelp(theUrl,theWidth, theHeight, theResize, theScroll) 
		{
			var op_scroll  = theScroll
		    var op_resize  = theResize
		    var op_wid  = theWidth
		    var op_heigh = theHeight
		    var option = "toolbar=no"+",location=no"+",directories=no"+",status=no"+",menubar=no"+",scrollbars="+ op_scroll+",resizable="+op_resize+",width=" + op_wid +",height="+ op_heigh;
			window.open(theUrl,"UserInformation",option);
		}
