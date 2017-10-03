<?php
include ("src/jpgraph.php");
include ("src/jpgraph_line.php");
include ("src/jpgraph_error.php"); 


//$datay = array(10.5,"",""); 
$datay = array(10.5,12,11.5); 
//$datay2 = array(12.5,"","");
$datay2 = array(12.5,11.5,11);
$datax=array("Trimestre 1","Trimestre 2","Trimestre 3");


$graph = new Graph(300,200,"auto"); 
$graph->img->SetMargin(40,40,20,70);     
$graph->img->SetAntiAliasing(); 
$graph->SetScale("textlin"); 
$graph->SetShadow(); 
$graph->title->Set("");  // titre
$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

$graph->xaxis->title->Set(""); // titre en y
$graph->yaxis->title->Set(""); // titre en x

// Use 20% "grace" to get slightly larger scale then min/max of 
// data 
$graph->yscale->SetGrace(20); 
$graph->xaxis->SetTickLabels($datax);

// P1 moyenne eleve
$p1 = new LinePlot($datay); 
$p1->mark->SetType(MARK_FILLEDCIRCLE); 
$p1->mark->SetFillColor("red"); 
$p1->mark->SetWidth(4); 
$p1->SetColor("red"); 
$p1->SetCenter(); 

// P2 moyenne classe
$p2 = new LinePlot($datay2); 
$p2->mark->SetType(MARK_FILLEDCIRCLE); 
$p2->mark->SetFillColor("blue"); 
$p2->mark->SetWidth(4); 
$p2->SetColor("blue"); 
$p2->SetCenter(); 


$graph->xaxis->SetColor("black");  // couleur axe en x
$graph->yaxis->SetColor("black");  // couleur axe en y

$graph->ygrid->SetLineStyle("longdashed");
$graph->ygrid->SetColor("gray");

// Create the linear plot
$lineplot=new LinePlot($datay);
$lineplot2=new LinePlot($datay2);

// Add the plot to the graph
$graph->Add($lineplot);
$graph->Add($lineplot2);


$lineplot->SetColor("blue");
$lineplot->SetWeight(2);

$lineplot2->SetColor("red");
$lineplot2->SetWeight(2);


$lineplot->SetLegend("Moyenne Eleve");
$lineplot2->SetLegend("Moyenne Classe");

$graph->legend->SetLayout(LEGEND_HOR);
$graph->legend->Pos(0.5,0.85,"center","center");


$graph->Add($p1); 
$graph->Add($p2); 

$graph->Stroke(); 

?> 


