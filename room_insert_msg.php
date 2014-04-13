<?php
if(isset($_POST['sub'])){

	include('room_modell.php');
	
	$id=NULL;
	$szid = clean($_POST['szid']);
	$user = "faresz";
	$level = 5;
	$stat = 1;
	$date = strtotime('now');
	$msg = clearText($_POST['uzenet']);

	
	$insert = insertRoomMsg($id,$szid,$user,$level,$stat,$date,$msg);
	if($insert==1){
		header("location: room.php?szid=$szid");
	}else print "Sikertelen bevitel";
	
}