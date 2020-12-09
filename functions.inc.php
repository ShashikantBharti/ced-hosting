<?php 
session_start();
class Database {
	private $host;
	private $user;
	private $password;
	private $dbname;

	protected function connect() {
		$this->host = 'localhost';
		$this->user = 'root';
		$this->password = '';
		$this->dbname = 'cedhosting';

		return (new mysqli( $this->host, $this->user, $this->password, $this->dbname ));
	}
}

class Query extends Database {

	public function getData( $table, $fields='', $conditions='') {
		$sql = "SELECT * FROM `$table`";
		if($fields != '') { 
			$fields = "`".implode( '`,`', $fields )."`";
			$sql = "SELECT $fields FROM `$table`";
		}
		if($conditions != '') { 
			$sql .= " WHERE ";
			$c = count( $conditions );
			$i = 1;
			foreach( $conditions as $key=>$value ) {
				if ( $c == $i ) {
					$sql .= " `$key` = '$value'";
				} else {
					$sql .= " `$key` = '$value' AND";
				}
				$i++;
			}
		}
		
		$result = $this->connect()->query( $sql );
		if ( $result -> num_rows > 0 ) {
			$arr = array();
			while( $row = $result->fetch_assoc() ) {
				$arr[] = $row;
			}
			return $arr;
		} 
		return 0;
	}
	public function insertData($table='',$data='') {
		if ( $data != '' ) {

			$fields = array();
			$values = array();

			foreach( $data as $key=>$value ) {
				$fields[] = $key;				
				$values[] = $value;
			}

			$fields = "`".implode( '`,`',$fields )."`";
			$values = "'".implode( "','",$values )."'";
			$sql = "INSERT INTO `$table`($fields) VALUES($values)";
			// echo $sql;
			// die;
			return $this->connect()->query( $sql );

		}

	}

}




?>