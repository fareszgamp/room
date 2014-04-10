<?php
if(isset($_GET['szid'])){

	include('room_modell.php');
	
	$szid = clearText($_GET['szid']);
	$id = issetRoom($szid);
	if($id!=0){
		if(isset($_GET['page'])) $page = clearText($_GET['page']);
		else $page = 1;
		$pages = pager($szid);
		$limits = offset($szid,$page);
		$roomContent = room_content($szid,$limits['offset']);
		
		include('room_view.php');
		
	}else print 'Nincs ilyen szoba';
}