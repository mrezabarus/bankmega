function ExecuteScript(strId)
{
  switch (strId)
  {
      case "662F0dYgDOy":
        Script1();
        break;
      case "6PIgvRsYjNX":
        Script2();
        break;
      case "6QkAhwf3Zvk":
        Script3();
        break;
      case "6dKsRz0jVGn":
        Script4();
        break;
      case "6r3Myhn61rg":
        Script5();
        break;
      case "67YEmgxBhm2":
        Script6();
        break;
      case "5oSX0Dofbrz":
        Script7();
        break;
      case "6HBmgGro0Z6":
        Script8();
        break;
      case "6RTj9NyUN2q":
        Script9();
        break;
      case "5wI5gw1AHyS":
        Script10();
        break;
      case "6khH4nBdgbf":
        Script11();
        break;
      case "5nPoPGUITVx":
        Script12();
        break;
      case "6RgYniXQC6t":
        Script13();
        break;
      case "5wD7oAmQthx":
        Script14();
        break;
      case "6cQiRq4CDu4":
        Script15();
        break;
      case "5wbQws6CZAQ":
        Script16();
        break;
      case "6RqNSm0GHnc":
        Script17();
        break;
      case "5rbNCmlIXeq":
        Script18();
        break;
      case "5vKrbxtPdKC":
        Script19();
        break;
      case "6cy2eetrp7K":
        Script20();
        break;
      case "5rNRjWafEV4":
        Script21();
        break;
      case "6h7UwE2zVcY":
        Script22();
        break;
      case "5bIIQfB6RJW":
        Script23();
        break;
      case "5mCKj3pxMCf":
        Script24();
        break;
      case "6ZfhigbVciO":
        Script25();
        break;
      case "5uz2mY1ejZb":
        Script26();
        break;
      case "5Xup1352khg":
        Script27();
        break;
      case "6WsJFvBBEpt":
        Script28();
        break;
      case "6lp4WioK4nr":
        Script29();
        break;
      case "5yfqf74mSbd":
        Script30();
        break;
      case "6ZsG66GhgSF":
        Script31();
        break;
      case "6nbCNx3kkwy":
        Script32();
        break;
      case "6A0c0bfyeel":
        Script33();
        break;
      case "5z8iXC9qm8n":
        Script34();
        break;
      case "5tiiuR1RsSQ":
        Script35();
        break;
      case "6E5D6GAHgvP":
        Script36();
        break;
      case "5v5oj0rObLY":
        Script37();
        break;
      case "6fK2k9ZcvKT":
        Script38();
        break;
      case "5dljsoHbCZJ":
        Script39();
        break;
      case "6Om3YKwdQLV":
        Script40();
        break;
      case "5sClopobLjS":
        Script41();
        break;
      case "5ZfgIhPQ8WY":
        Script42();
        break;
      case "5gH8ggkOAG0":
        Script43();
        break;
      case "6q1UP2i24ix":
        Script44();
        break;
      case "6MbyhXMAelM":
        Script45();
        break;
      case "6aJ6Z7p51N2":
        Script46();
        break;
      case "63cNfp8yGNE":
        Script47();
        break;
      case "6iaMhnR3ODc":
        Script48();
        break;
      case "6fg0zzg9IX1":
        Script49();
        break;
      case "6SiGKPA2AdG":
        Script50();
        break;
      case "5jdIefqORz6":
        Script51();
        break;
      case "6Mw3UdU5ah5":
        Script52();
        break;
      case "6gPXT8ljVy5":
        Script53();
        break;
      case "6ISRDthKwGU":
        Script54();
        break;
      case "5nbmzPWoFHk":
        Script55();
        break;
      case "5aKwNAPyH9M":
        Script56();
        break;
      case "698K9lwpQO5":
        Script57();
        break;
      case "5y8cc9nKtta":
        Script58();
        break;
      case "63xQ2cjOABG":
        Script59();
        break;
  }
}


function penutup(rw)
{
	var url_parent      = parent.document.URL;
	
	var url = url_parent+'/penutupArticulate';  
	//console.log(url);
	
	
	console.log(rw);
	if(rw.halaman=='h2.complete'){
		//alert(url); save status posttest
		window.top.location.href = url; 
	}	
}


function send(rw)
{
	//console.log(url);
	
	rw.localStorage = localStorage.getItem("5w1sPm8gBB6");
	
	
	var url_parent      = parent.document.URL;	
	var url = url_parent+'/restarticulate'; 
  
	$.post( url, {activity:rw}, function(data,status){
    //console.log(status);
    //console.log(rw);
    if( status == 'success'){
      //alert("Data: " + data + "\nStatus: " + status);
      //$("#receiver").html( data );	
      //alert('Data telah tersimpan, '+ rw.halaman)
      //console.log('ok');
      
    }
    else{
      //alert('Data tidak tersimpan, ')
      //console.log('bad');
    }
	});
}


function Script1()
{
  send({"halaman":"1"});
  var player = GetPlayer();
  var query = window.location.search.substring(7);
  player.SetVar("JumpToSlide",query);

  
  console.log(player);
}

function Script2()
{
  send({"halaman":"2"});
  var player = GetPlayer();
  var query = window.location.search.substring(7);
  player.SetVar("JumpToSlide",query);

  
  console.log(player);
}

function Script3()
{
  send({"halaman":"3"});
  var player = GetPlayer();
  var query = window.location.search.substring(7);
  player.SetVar("JumpToSlide",query);

  
  console.log(player);
}

function Script4()
{
 
  send({"halaman":"4"});
  console.log("4");
}

function Script5()
{
  console.log("5");
  send({"halaman":"5"});
}

function Script6()
{
  var player = GetPlayer();
  var query = window.location.search.substring(7);
  player.SetVar("JumpToSlide",query);

  
  console.log(query);
  
  send({"halaman":"6"});
}

function Script7()
{
  console.log("7");
  send({"halaman":"7"});
}

function Script8()
{
  send({"halaman":"h2.1"});
  console.log("8xc");  
}

function Script9()
{
  var player = GetPlayer();
  var query = window.location.search.substring(7);
  player.SetVar("JumpToSlide",query);

  send({"halaman":"9"});
}

function Script10()
{
  console.log("h1.3");
}

function Script11()
{
  var player = GetPlayer();
var query = window.location.search.substring(7);
player.SetVar("JumpToSlide",query);
}

function Script12()
{
  console.log("h1.4");
}

function Script13()
{
  var player = GetPlayer();
var query = window.location.search.substring(7);
player.SetVar("JumpToSlide",query);
}

function Script14()
{
  console.log("h1.5");
}

function Script15()
{
  var player = GetPlayer();
var query = window.location.search.substring(7);
player.SetVar("JumpToSlide",query);
}

function Script16()
{
  console.log("h1.6");
}

function Script17()
{
  var player = GetPlayer();
var query = window.location.search.substring(7);
player.SetVar("JumpToSlide",query);
}

function Script18()
{
  var player = GetPlayer();
var query = window.location.search.substring(7);
player.SetVar("JumpToSlide",query);
}

function Script19()
{
  console.log("q1.1");
}

function Script20()
{
  var player = GetPlayer();
var query = window.location.search.substring(7);
player.SetVar("JumpToSlide",query);
}

function Script21()
{
  console.log("q1.2");
}

function Script22()
{
  var player = GetPlayer();
var query = window.location.search.substring(7);
player.SetVar("JumpToSlide",query);
}

function Script23()
{
  console.log("q1.3");
}

function Script24()
{
  var player = GetPlayer();
var query = window.location.search.substring(7);
player.SetVar("JumpToSlide",query);
}

function Script25()
{
  console.log("q1.4");
}

function Script26()
{
  var player = GetPlayer();
var query = window.location.search.substring(7);
player.SetVar("JumpToSlide",query);
}

function Script27()
{
  console.log("q1.5");
}

function Script28()
{
  var player = GetPlayer();
var query = window.location.search.substring(7);
player.SetVar("JumpToSlide",query);
}

function Script29()
{
  console.log("q1");
console.log("c1");
}

function Script30()
{
  var player = GetPlayer();
var query = window.location.search.substring(7);
player.SetVar("JumpToSlide",query);
}

function Script31()
{
  var player = GetPlayer();
var query = window.location.search.substring(7);
player.SetVar("JumpToSlide",query);
}

function Script32()
{
  var player = GetPlayer();
var query = window.location.search.substring(7);
player.SetVar("JumpToSlide",query);
}

function Script33()
{
  console.log("h2.1");
}

function Script34()
{
  var player = GetPlayer();
var query = window.location.search.substring(7);
player.SetVar("JumpToSlide",query);
}

function Script35()
{
  console.log("h2.2");
}

function Script36()
{
  var player = GetPlayer();
var query = window.location.search.substring(7);
player.SetVar("JumpToSlide",query);
}

function Script37()
{
  var player = GetPlayer();
var query = window.location.search.substring(7);
player.SetVar("JumpToSlide",query);
}

function Script38()
{
  console.log("h2.3");
}

function Script39()
{
  var player = GetPlayer();
var query = window.location.search.substring(7);
player.SetVar("JumpToSlide",query);
}

function Script40()
{
  console.log("h2.4");
}

function Script41()
{
  var player = GetPlayer();
var query = window.location.search.substring(7);
player.SetVar("JumpToSlide",query);
}

function Script42()
{
  var player = GetPlayer();
var query = window.location.search.substring(7);
player.SetVar("JumpToSlide",query);
}

function Script43()
{
  console.log("h2.5");
}

function Script44()
{
  var player = GetPlayer();
var query = window.location.search.substring(7);
player.SetVar("JumpToSlide",query);
}

function Script45()
{
  console.log("h2.6");
}

function Script46()
{
  var player = GetPlayer();
var query = window.location.search.substring(7);
player.SetVar("JumpToSlide",query);
}

function Script47()
{
  var player = GetPlayer();
var query = window.location.search.substring(7);
player.SetVar("JumpToSlide",query);
}

function Script48()
{
  console.log("q2.1");
}

function Script49()
{
  var player = GetPlayer();
var query = window.location.search.substring(7);
player.SetVar("JumpToSlide",query);
}

function Script50()
{
  console.log("q2.2");
}

function Script51()
{
  var player = GetPlayer();
var query = window.location.search.substring(7);
player.SetVar("JumpToSlide",query);
}

function Script52()
{
  var player = GetPlayer();
var query = window.location.search.substring(7);
player.SetVar("JumpToSlide",query);
}

function Script53()
{
  console.log("q2.4");
}

function Script54()
{
  var player = GetPlayer();
var query = window.location.search.substring(7);
player.SetVar("JumpToSlide",query);
}

function Script55()
{
  console.log("q2.5");
}

function Script56()
{
  var player = GetPlayer();
var query = window.location.search.substring(7);
player.SetVar("JumpToSlide",query);
}

function Script57()
{
  console.log("q2");
console.log("c2");
}

function Script58()
{
  var player = GetPlayer();
var query = window.location.search.substring(7);
player.SetVar("JumpToSlide",query);
}

function Script59()
{
  console.log("c2");
  var status = "posttest";
  return status;
}

