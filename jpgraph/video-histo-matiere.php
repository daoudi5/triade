<?php
include ("src/jpgraph.php");
include ("src/jpgraph_line.php");
include ("src/jpgraph_bar.php");

$data1y=array(12,8,19,3); // note
$data2y=array(8,2,11,7);  // note avant
$datax=array("Français","Mathématique","Anglais","Histoire");

// Create the graph. These two calls are always include_onced
$graph = new Graph(710,230,"auto");    
$graph->img->SetMargin(40,30,20,70);
$graph->SetScale("textlin");
$graph->SetShadow();

// Create the bar plots
$b1plot = new BarPlot($data1y);
$b1plot->SetFillColor("orange");
$b2plot = new BarPlot($data2y);
$b2plot->SetFillColor("blue");

// Create the bar plot 
$b1plot->SetFillColor("orange"); 
$b1plot->SetLegend("Trimestre"); 
$b2plot->SetFillColor("blue");
$b2plot->SetLegend("Trimestre n-1");
$graph->legend->SetLayout(LEGEND_HOR);
$graph->legend->Pos(0.5,0.85,"center","center");

// Create the grouped bar plot
$gbplot = new GroupBarPlot(array($b1plot,$b2plot));

// ...and add it to the graPH
$graph->Add($gbplot);

$graph->title->Set("");    // titre
$graph->xaxis->title->Set(""); // info en x
$graph->yaxis->title->Set(""); // info en y

$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

$graph->xaxis->SetTickLabels($datax);

// Display the graph
$graph->Stroke();
?>

