<?php

	include('room_modell.php');
	
	$szid = clearText($_GET['szid']);
	$id = issetRoom($szid);
	if($id!=0){
		
		include('room_form_view.php');
		
	}else print 'Nincs ilyen szoba';
