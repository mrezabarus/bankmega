<?php
  $MY_HOST = "localhost";
  $MY_UNAME = "root";
  $MY_UPASSWORD="12345676879";
  
  $DBconnect = mysql_connect($MY_HOST,$MY_UNAME,$MY_UPASSWORD);
  $DB = mysql_select_db("db_mega",$DBconnect);
  
  $Sql_Statement = "select * from tbl_polling_answer where Polling_ID = ". $_GET["poll_id"];
  $Result_Statement = mysql_query($Sql_Statement,$DBconnect);
  $score="";
  $legend="";
  $high = 0;
  while ($Row = mysql_fetch_array($Result_Statement)) {
		$score = $score . "," . $Row["Hints"];
		if ($Row["Hints"] > $high):
			$high = $Row["Hints"];
		endif;
		$legend = $legend . ",'" . trim($Row["Answer_Title"]). "&nbsp;(".$Row["Hints"].")'";
		
 }
  if (strlen($legend)>0){
  	$legend = substr($legend, 1);    
  }

  if (strlen($score)>0){
  	$score = substr($score, 1);
  }
  
	if ($high < 20):
		$scale = 1;
	else:
		$scale = round($high/10);
	endif;
			$pooltitle = "Polling Result";
			$ylabel = "Scale";
			$xlabel = "Polling Answer";

?>
<html>
<head>
	<title>Polling result</title>
</head>

<SCRIPT LANGUAGE="JavaScript1.2" SRC="graph.js"></SCRIPT>

<body>
<SCRIPT LANGUAGE="JavaScript1.2">
	var g = new Graph(400,400);
	//g.addRow(124,138,216,143,256,302);
	g.addRow(<?=$score?>);
	<!-- try to experiment with setXScaleValues function -->
	g.setXScaleValues(<?=$legend?>); 
	g.scale = <?=$scale?>;
	g.setDate(8,10,1998);
	g.title = "<?=$pooltitle?>";
	g.xLabel = "<?= $xlabel?>";
	g.yLabel = "<?= $ylabel?>";
	//g.setLegend("Fly Fishing","Sport Fishing");
	g.build();
</SCRIPT>
</body>
</html>
