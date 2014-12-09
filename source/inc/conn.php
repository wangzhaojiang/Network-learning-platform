<?php
class Nlpdb{
	
	private $db;

	private $result;
	
	function __construct()
	{
		$hostname = "localhost";
		$dbuser = "root";
		$dbpwd = "notamaiba";
		$dbname = "jaker_me";
		$charName = "utf8";

		$this->db = new mysqli($hostname, $dbuser, $dbpwd, $dbname);

		if (mysqli_connect_errno())
		{
			echo "链接失败".mysqli_connect_errno();
			exit();
		}
		$this->db->query("set names $charName;");

	}

	public function query($sql_str, $sql_error = 'error')
	{
        var_dump($sql_str);
        $this->result = $this->db->query($sql_str);
        if ($this->result == false){
            echo $sql_error;
            return $this->result;
        }

        if (is_object($this->result)){
            if ($this->result -> num_rows > 0){
            while( $row = $this->result -> fetch_assoc() )
                $array[] = $row;
            return $array;
            }
            else{
                return false;
            }
        }
        

        return $this->result;

	}

	function __destruct()
	{
		if( is_object($this->result) )
			$this->result->free();
		$this->db->close();
	}
}
?>
