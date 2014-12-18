<?php

require("conn.php");
require('function.php');
class User{

	private $conn;
	
	public function __construct(){
		$this->conn = new Nlpdb();
	} 	

	public function user_signin($mail,$password){
		
		if(empty($mail) || empty($password))
			return false;

		$key = md5($password);
		$sql = "select * from user_info where mail='$mail' and password='$key';";
		$sql_error = "用户校验失败";
		
		$result = $this->conn->query($sql,$sql_error);
		if($result)
			return true;
		else
			return false;
	}

	public function user_signup($name,$password,$mail){

		if(empty($name) || empty($password) || empty($mail) )
			return 'false1';
		$permission = 0;
		$password = md5($password);
		
		$checkArr = Array(
			"$name"=>'chinese',
			"$password"=>'normal',
			"$mail"=>'mail',
		);

		if(!checkArr($checkArr))
			return 'false2';
		$check_mail_sql = "select mail from user_info where mail='$mail';";
		$sql_error = "邮箱有重复";
		$result = $this->conn->query($check_mail_sql,$sql_error);
		if(!$result)
			return 'false3';

		unset($sql_error);
		$insert_sql = "INSERT INTO user_info(name,permission,password,mail) VALUES ('$name','$permission','$password','$mail');";
		$sql_error = "增添用户失败";

		$result = $this->conn->query($insert_sql,$sql_error);
		if($result)
			return true;
		else
			return 'false4';
	}

/*	public function user_info_sendmail($mail){

		if(empty($mail))
			return false;

		if(!filter_var($mail,FILTER_VALIDATE_MAIL))		
			return false;
		$sql = "select * from user_info where mail='$mail';";
		if($this->conn->query($sql))
			send_mail($mail);
		else
			return 'false2';
	}
*/
	public function user_getinfo($uid){

		if(!checkStr('digit',$uid)){
			echo false;
			exit;
		}

		$sql = "select * from user_info where uid='$uid';";
		$sql_error = "查询用户信息失败";
		$result = $this->conn->query($sql,$sql_error);
		if($result)
		{
			unset($result['password']);
			return $result;
		}
		else 
			return false;
	}

	public function user_changepassword($key,$uid){

		if(empty($key))
			return false;

		if(!checkStr('normal',$key))
			return false;

		$sql = "select * from user_info where uid='$uid';";
		$sql_error = "校验用户失败";
		$result = $this->conn->query($sql,$sql_error);
		if($result){
			unset($sql_error);
			$sql_change = "update user_info set password='$key' where uid='$uid';";
			$sql_error = "修改密码失败";
			if( $this->conn->query($sql_change,$sql_error))
				return 'true';
			else 
				return false;
			
		}
	}

	public function user_getpermission($uid){

		if(!checkStr('digit',$uid))
			return false;

		$sql_error = "获取用户权限失败";
		$sql = "select permission from user_info where uid='$uid';";
		$result = $this->conn->query($sql,$sql_error);
		if($result != false)
			return  $result;

		return false;
	}


	public function user_update_userinfo($uid,$mail,$school,$logo,$sign){

	//	if ( checkUser($uid) )
	//		return 'false1';
		$checkArr = array(
			"$mail" => 'mail',
			"$school"=>'chinese',
			"$logo"=>'normal',
			"$sign"=>'normal'
		);
		if( !checkArr($checkArr) )
			return 'false2';

		$sql_error = "获取用户uid失败";
		$query_str = "SELECT * FROM user_info where uid='$uid';";
		$result = $this->conn->query($query_str,$sql_error);
		if( $result == false){
			return 'false3';
		}	
		
		$infoArr = array(
			'mail'=>"'$mail'",
			'school'=>"'$school'",
			'logo'=>"'$logo'",
			'sign'=>"'$sign'"
		);

		$flag = false;
		while( $value = current($infoArr) ){
			if( $value != "''" ){
				unset($sql_error);
				$sql_error = "更新用户信息失败";
				$query_str = "UPDATE user_info set `".key($infoArr)."`=$value"."where uid='$uid';";
				if( !$this->conn->query($query_str,$sql_error) )
					return 'false4';
				else
					$flag = true;
			}
			next($infoArr);
		}
		if( is_object($result) )
			$result->close();
		if($flag)
			return true;
		return 'false5';
	}
	public function getinfo_x($var,$tag) {
		if ($tag == 'mail') {
			$sql = "select * from user_info where mail='$var';";
			$sql_error = "通过邮箱查询信息失败";
			$result = $this->conn->query($sql,$sql_error);
			return $result;
		}
		else if ($tag == 'uid') {
				$sql = "select * from user_info where uid='$var';";
				$sql_error = "通过uid查询信息失败";
				$result = $this->conn->query($sql,$sql_error);
				return $result;
		}
		else 
			return 'tag is error';

	}

}
?>
