<?php
 
class myDBC {
	public $mysqli = null;
	function __construct() { 
		$this->mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		if ($this->mysqli->connect_errno) {
			echo "Error MySQLi: ("&nbsp. $this->mysqli->connect_errno 
			. ") " . $this->mysqli->connect_error;
			exit();
		}
		$this->mysqli->set_charset("utf8"); 
	}
	function __destruct() {
		$this->CloseDB();
	}
	
//------------------preparált lekérdezés végrehalytása:-------------------------------
	function runQuery($tomb) {
		$stmt = $this->mysqli->prepare($tomb['sql']);
		if($tomb['type']!=""){
			$a_params = array();
			$param_type = '';
			$n = count($tomb['type']);
			for($i = 0; $i < $n; $i++) {
				$param_type .= $tomb['type'][$i];
			}
			$a_params[] = & $param_type;
			for($i = 0; $i < $n; $i++) {
				$a_params[] = & $tomb['param'][$i];
			}
			call_user_func_array(array($stmt, 'bind_param'), $a_params);
		}
		$stmt -> execute();
		return $stmt;
	}
//---------------preparált lekérdezésből associatív tömb kinyerés----------------------
	function resultArray($tomb){
		$stmt=$this->runQuery($tomb);
		    $meta = $stmt->result_metadata();
		while ($field = $meta->fetch_field()){
			$params[] = &$row[$field->name];
		}
		call_user_func_array(array($stmt, 'bind_result'), $params);
		while ($stmt->fetch()) {
			foreach($row as $key => $val){
				$c[$key] = $val;
				
			}
			$result[] = $c;
			
		}
	   return $result;
		$stmt->close();
	}
	// kapcsolat bezárás
	function CloseDB() {
		$this->mysqli->close();
	}
	function clearText($text) {
		$text = trim($text);
		return $this->mysqli->real_escape_string($text);
	}
	function lastInsertID() {
		return $this->mysqli->insert_id;
	}
//-----------preparált lekérdezésből származó TÖMB SORAI számának lekérdezése------------
	function rowsCount ($tomb) {
		$result = $this->resultArray($tomb);
		return count($result);
	}
//-----------preparált lekérdezésből származó sorok számának lekérdezése------------
	function rowsCounter ($tomb) {
		$stmt=$this->runQuery($tomb);
		$stmt->store_result();
		$rows = $stmt->num_rows;
		return $rows;
	}
//-----------preparált lekérdezésből származó oszlopok számának lekérdezése------------
	function fieldCounter ($tomb) {
		$stmt=$this->runQuery($tomb);
		$counter=$stmt->field_count;
		return $counter;
	}
//-----------offset és limit a lapozáshoz---------------------------------------------
	function offset ($tomb,$page){
		$rows = $this->numRows($tomb);
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
//-----------lapozó linkek -------------------------------------------
	function lapozo ($tomb){

		$result = $this->mysqli->query($tomb['sql']);
		$row = $result->fetch_row();
		$limit = 10;
		$c = $row[0];
		$maxpage = ceil($c / $limit);
		$pages=array();
			for ($i = 0; $i <= $maxpage; $i++) {
				$pages[]=$i;
			}
		return $pages;
	}
//-----------count(*) értéke sima lekérdezésből-------------------------
	function numRows ($tomb){

		$result = $this->mysqli->query($tomb['sql']);
		$row = $result->fetch_row();
		return $row[0];
	}
//-----------count(*) értéke sima lekérdezésből-------------------------
	function issetData ($szid,$sql){
		$result = $this->mysqli->query($sql);
		if($row = $result->fetch_row()){
			$id=$row[0];
		}else{
			$id=0;
		}
		return $id;
	}
}
?>