<?php
if(isset($_GET['szid'])){

	include('room_modell.php');										//szoba modell
	
	
	$szid = clearText($_GET['szid']);								//megtisztítja a get tömböt
	$id = issetRoom($szid);											//ha létezik a szoba akkor $id=1 ha nem akkor $id=0
	if($id!=0){
		if(isset($_GET['page'])) $page = clearText($_GET['page']);
		else $page = 1;
		$pages = pager($szid);										//lapozáshoz szükséges számok
		$limits = offset($szid,$page);								//lapozáshoz szükséges offset és limit
		$roomContent = room_content($szid,$limits['offset']);		//offset és limit alapján a megadott szoba tartalma
		
		include('room_view.php');									//szoba megjelenítése
		
	}else print 'Nincs ilyen szoba';
}