<?php
include('phpMyGraph5.0.php');
if(!defined ('BASEPATH')) exit('no direct scripts access allowed');
 
class PhpGraph{
 
function create_graph($cfg=null, $data,$chart_type='horizontal-line-graph',$title='', $filename=null){
 
/* set title pada grafik */
$cfg['title'] = $title;
/* pilihan tipe grafik */
if($chart_type=='horizontal-line-graph'){
$graph = new HorizontalLineGraph();
}
else if($chart_type=='horizontal-simple-column-graph'){
$graph = new HorizontalSimpleColumnGraph();
}
else if($chart_type=='horizontal-column-graph'){
$graph = new HorizontalColumnGraph();
}
else if($chart_type=='horizontal-polygon-graph'){
$graph = new HorizontalPolygonGraph();
}
else if($chart_type=='vertical-line-graph'){
$graph = new VerticalLineGraph();
}
else if($chart_type=='vertical-simple-column-graph'){
$graph = new VerticalSimpleColumnGraph();
}
else if($chart_type=='vertical-shadow-column-graph'){
$graph = new VerticalColumnGraph();
}
else if($chart_type=='vertical-polygon-graph'){
$graph = new VerticalPolygonGraph();
}
/* jika memberi nama file, berarti gambar diisimpan ke dalam berkas */
if($filename!=null){
/* jika graph yang digunakan untuk perbandingan */
if($cfg['compare']==true){
$cfg['file-name'] = $filename;
$graph->parseCompare($data[0],$data[1], $cfg);
return $cfg['file-name'];
}
else{
$cfg['file-name'] = $filename;
$graph->parse($data, $cfg);
return $cfg['file-name'];
}
}
/* jika tidak memberi nama file, konten header berupa gambar */
else{
header("Content-type: image-png");
/* jika graph yang digunakan untuk perbandingan */
if($cfg['compare']==true){
$graph->parseCompare($data[0],$data[1], $cfg);
return $cfg['file-name'];
}
else{
$graph->parse($data, $cfg);
return $cfg['file-name'];
}
}
 
}
}