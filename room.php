<?php

include('room_modell.php');

$mydb = new myDBC();
$szid=6;
$nick="faresz";
if(isset($_GET['page'])) $page=$_GET['page'];
else $page=1;
$sqla = "SELECT count(*) FROM szoba where szoba_id= $szid";
$para=array();
$typea="";
$tombom=array("lekerdez"=>$sqla,"type"=>$typea,"param"=>$para);
$pages = $mydb->lapozo($tombom);
$limits = $mydb->offset ($tombom,$page);
$offset=$limits['offset'];
$limit=$limits['limit'];
$sql = "SELECT * FROM szoba where szoba_id= ? order by date desc limit ?,?";
$par=array($szid,$offset,$limit);
$type=array('i','i','i');
$tomb=array("lekerdez"=>$sql,"type"=>$type,"param"=>$par);
$bemutatok = $mydb->resultArray ($tomb);
$count = $mydb->fieldCounter($tomb);
$rowscount=$mydb->numRows($tombom);

include('room_view.php');