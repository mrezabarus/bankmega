<?php
// Gantt example
require_once("../../config.php");
require_once('../../includes/jpgraph/jpgraph.php');
require_once('../../includes/jpgraph/jpgraph_line.php');

$grp = cmsDB();

$grp->query("SELECT avail_status, COUNT(*) AS avail FROM tbl_jobseeker GROUP BY avail_status");
while ($grp->next()){
print $avail[$grp->row("avail_status")] = $grp->row("avail");
}


$SQL = "SELECT avail_status
        FROM tbl_jobseeker
		ORDER BY join_date asc";
$grp->query($SQL);
$grp->next();
//$grp->foreach($SQL);
//$Result = $DBConnection->dbc->get_results($SQL,ARRAY_A);

$grp = $grp->row("avail_status");

//foreach ($grp as $row) {
//  $data1[] = str_replace(",",".", substr($row["available"],0,4));
//  $data2[] = $row["date"];
//  $data3[] = str_replace(",",".", substr($row["rtgscabk"],0,4));
//}

$datay = $data1; //array(120,344,347);
$datay2 = $data3; //array(120,344,347);
$datax = $data2; //array(120,344);


//foreach ($Result as $row) {
//  $data1[] = str_replace(",",".", $row["persen1"]);
//  $data2[] = $row["date"];
//}
 print_r($data1); 
print_r($data2); die();

$datay = $data1; //array(120,344,347);
$datax = $data2; //array(120,344);


// Setup the graph
$graph = new Graph(920,450,'auto');
$graph->SetMarginColor('#c8ddf9');
//$graph->SetScale("intlin",0,20000);
$graph->SetScale("linlin");
$graph->SetMargin(100,51,40,120);

$plot=new LinePlot($datax);
$plot->SetColor('red');
$plot->SetWeight(2);
$graph->Add($plot);
$graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,8);
$graph->xaxis->SetLabelAngle(45);
$graph->SetFrame(true,'#c8ddf9');

// Setup a background gradient image
//$graph->SetBackgroundGradient('blue','navy:0.5',GRAD_HOR,BGRAD_PLOT);

// Setup the tab title
$graph->tabtitle->Set(' Grafik Saldo R/C BI GW Minimum ' );
$graph->tabtitle->SetFont(FF_ARIAL,FS_BOLD,13);

// Create the primary Y plot
$graph->yaxis->title->Set("Persentase Giro Wajib");
$graph->yaxis->title->SetMargin(20);
$graph->yaxis->title->SetFont(FF_ARIAL,FS_NORMAL,10);

// Title for X-axis
//$graph->xaxis->title->Set("Tanggal");
$graph->xaxis->title->SetMargin(18);
$graph->xaxis->title->SetFont(FF_ARIAL,FS_NORMAL,10);


// Setup x,Y grid
$graph->xgrid->Show();
$graph->xgrid->SetColor('gray@0.5');
//$graph->xaxis->SetTickLabels($gDateLocale->GetShortMonth());
$graph->xaxis->SetTickLabels($datax);
$graph->ygrid->SetColor('gray@0.5');

// Setup color for axis and labels on axis
$graph->xaxis->SetColor('orange','black');
$graph->yaxis->SetColor('orange','black');

// Ticks on the outsid
$graph->xaxis->SetTickSide(SIDE_DOWN);
$graph->yaxis->SetTickSide(SIDE_LEFT);

// Setup the legend box colors and font
$graph->legend->SetColor('white','navy');
$graph->legend->SetFillColor('navy@0.25');
$graph->legend->SetFont(FF_ARIAL,FS_BOLD,8);
$graph->legend->SetShadow('darkgray@0.4',1);
$graph->legend->SetPos(0.055,0.05,'right','top');

// Create the second line
$p2 = new LinePlot($datay);
$p2->value->SetFont(FF_ARIAL,FS_BOLD,7);
$p2->SetColor("blue");
$p2->value->SetAngle(75);
$p2->SetWeight(1);
$p2->SetLegend('Persentase RC BI');
$p2->value->SetFormat("%f");
$p2->value->Show(); // Menampilkan Value persentase %
// Display the marks on the lines
$p2->mark->SetType(MARK_FILLEDCIRCLE);
$p2->mark->SetSize(3);
$p2->mark->Show();
$graph->Add($p2);

// Output line
$graph->Stroke();
?>


