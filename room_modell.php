<?php
include('mydbal_db.php');
	
	/*room_content
	*csak az offset és limit alapján lekérdezett tömbböt ada vissza
	*/
	function room_content ($szid,$offset){
	$mydb = new myDBC();
		$sql = "SELECT * FROM szoba where szoba_id= ? order by date desc limit ?,15";
		$par = array($szid,$offset);
		$type = array('i','i');
		$tomb = array("sql"=>$sql,"type"=>$type,"param"=>$par);
		return $mydb->resultArray ($tomb);
	}
	
	/*insertRoomMsg
	*A kapott adatokat átadja a myDBC class runQuery function-nak
	*Melyeket preparált eljárással bevisz az adtbázisba
	*Ha létrejön a bevitel akkor $id=1 ha nem akkor $id=0
	*/
	function insertRoomMsg($id,$szid,$user,$level,$stat,$date,$msg){
	$mydb = new myDBC();
		$sql = "insert into szoba values (?,?,?,?,?,?,?)";
		$par = array($id,$szid,$user,$level,$stat,$date,$msg);
		$type = array('i','i','s','i','i','i','s');
		$tomb = array("sql"=>$sql,"type"=>$type,"param"=>$par);
		if($mydb->runQuery($tomb)){
			$id=1;
		}else $id=0;
		return $id;
	}
	
	function filter( $data ){
	$mydb = new myDBC();
		if( !is_array( $data ) )
		{
			$data = $mydb->mysqli->real_escape_string( $data );
			$data = trim( htmlentities( $data, ENT_QUOTES, 'UTF-8', false ) );
			$data = strip_tags($data,"<br>");
		}
		else
		{
			//Self call function to sanitize array data
			$data = array_map( array( $mydb, 'filter' ), $data );
		}
		return $data;
	}
	
	function clean( $data ){
		$data = stripslashes( $data );
		$data = html_entity_decode( $data, ENT_QUOTES, 'UTF-8' );
		$data = nl2br( $data );
		$data = urldecode( $data );
		return $data;
	}
	
	/*clearText:$text
	*trimmelem
	*entity_decode-olom ha jól értem akkor utf-8-nak megfelelőre
	*a\r\n beviteleket str_replace-vel <br> rel helyettesítem
	*nl2br
	*A html_entity_decode által visszaalakított stringben megtralálja a nem <br> tag-eket és szűri
	*real_escape_string
	*/
	function clearText ($text){
	$mydb = new myDBC();
		$text = trim($text);
		$text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
		$text = str_replace(array("\r\n", "\r", "\n"), "<br>", $text);
		$text = nl2br($text);
		$text = strip_tags($text,"<br>");
		return $mydb->mysqli->real_escape_string($text);
	}
	
	/*issetRoom
	*Lekérdezi a rowsCounter a sorok számát 
	*ha nem üres akkor $id=1 ha üres akkor $id=0
	*/
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
	
	/*pager
	*a rowsCounter által visszaadtott num_rows alapján és a $imit=10 alapján
	*átadja a lapozáshoz szükséges lapszámokat
	*
	*/
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
	
	/*offset
	*a rowsCounter által visszaadtott num_rows alapján és a $imit=10 alapján
	*átadja a lapozáshoz szükséges offset és limit értékeket
	*/
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