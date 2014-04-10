<?php
include('mydbal_db.php');
	
		
	function room_content ($szid,$offset){
	$mydb = new myDBC();
		$sql = "SELECT * FROM szoba where szoba_id= ? order by date desc limit ?,15";
		$par = array($szid,$offset);
		$type = array('i','i');
		$tomb = array("sql"=>$sql,"type"=>$type,"param"=>$par);
		return $mydb->resultArray ($tomb);
	}
	
	function clearText ($text){
	$mydb = new myDBC();
		$text = trim($text);
		return $mydb->mysqli->real_escape_string($text);
		// return $text;
	}
	
	function issetRoom ($szid){
	$mydb = new myDBC();
		$sql="select id from szobak where id = ?";
		$par = array($szid);
		$type = array('i');
		$tomb = array("sql"=>$sql,"type"=>$type,"param"=>$par);
		if($mydb->rowsCounter($tomb)!=0){
			$id=1;
		}else $id=0;
		return $id;
	}
	
	function pager ($szid){
	$mydb = new myDBC();
		$sql="select id from szoba where szoba_id = ?";
		$par = array($szid);
		$type = array('i');
		$tomb = array("sql"=>$sql,"type"=>$type,"param"=>$par);
		$rows = $mydb->rowsCounter($tomb);
		$limit = 10;
		$c = $rows;
		$maxpage = ceil($c / $limit);
		$pages=array();
			for ($i = 0; $i <= $maxpage; $i++) {
				$pages[]=$i;
			}
		return $pages;
	}
	
	function offset ($szid,$page){
	$mydb = new myDBC();
		$sql="select id from szoba where szoba_id = ?";
		$par = array($szid);
		$type = array('i');
		$tomb = array("sql"=>$sql,"type"=>$type,"param"=>$par);
		$rows = $mydb->rowsCounter($tomb);
		$limit = 15;
		$c = $rows;
		$maxpage = ceil($c / $limit);

		if ($page <= 0) {
			$page = 1;
		} else
		if ($page >= $maxpage) {
			$page = $maxpage;
		}

		$offset = ($page - 1) * $limit;
		$limits=array('offset'=>$offset,'limit'=>$limit);
		return $limits;
		
	}
	
?>