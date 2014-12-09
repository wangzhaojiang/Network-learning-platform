<?php
	require_once('conn.php');

class Relation{
	
	private $conn;

	public function __construct(){
		$this->conn = new Nlpdb();
	}

	/*@add_relation:添加关注着信息
	 *@from_uid,是关注者
	 *@to_uid，是被关注者
	 *return:返回false/true
	 */
	public function add_relation($from_uid, $to_uid){
		if (!is_numeric($from_uid) || !is_numeric($to_uid) || ($from_uid == $to_uid)) {
			return false;
		}
		
		$query_str = "insert into `user_relation`(fromuid, touid) value('$from_uid', '$to_uid')";
		
		$sql_error = "insert into sql error";
		
		$result = $this->conn->query($query_str, $sql_error);
		
		return $result;
	}
	/*@delete_relation:取消关注
	 *@from_uid:是关注者
	 *@to_uid:是被关注者
	 *return:返回false/ture
	 */
	public function delete_relation($from_uid, $to_uid) {
		if (!is_numeric($from_uid) || !is_numeric($to_uid) || ($from_uid == $to_uid)) {
			return false;
		}
		
		$query_str = "delete from  `user_relation` where fromuid = '$from_uid' and touid = '$to_uid'";
		
		$sql_error = "delete  sql error";
		
		$result = $this->conn->query($query_str);

		return $result;
	}
	
	/*@cat_relation:查看关注uid的人和查看uid关注的人
	 *@uid:登录人的uid
	 *@tag：tag = 0, 查询uid关注的人，tag=1,查询关注uid的人
	 *return:返回用户的头像，用户名，个性签名和学校的二维数组,没有数据返回false
	 */
	public function cat_relation($uid, $tag) { 
		if (!is_numeric($uid)&& ($tag != 0 || $tag != 1))  {
			return false;
		}
		
		if ($tag == 0) {
			$query_str = "select distinct(name), school, logo, sign  from `user_info`  where user_info.uid = any(select touid from `user_relation` where fromuid = '$uid' )";

			$sql_error = "select cat_relation sql error";
			$result = $this->conn->query($query_str, $sql_error);

			if ($result == false) {
				
				return false;
			}
			
			return $result;
			
		}

		if ($tag  == 1) {
			$query_str = "select name, school, logo, sign from `user_info`where user_info.uid = any(select fromuid from `user_relation` where touid = '$uid')";
			
			$sql_error = "select cat_relation sql error";
			$result = $this->conn->query($query_str, $sql_error);

			if ($result == false) {
				
				return false;
			}
			
			return $result;
		}
	}

	
	/*@count_relation:查看关注uid的人的数量和查看uid关注的人的数量
	 *@uid:被查询人的uid
	 *@tag：tag=0,查询uid关注的人的数量，tag=1,查询关注uid的人的数量
	 *return:返回关注者的数量int,出错返回false
	 */
	public function count_relation($uid, $tag) {
		if (!is_numeric($uid) &&($tag != 0 || $tag != 1))  {
			return false;
		}
		
		if ($tag == 0) {
			$query_str = "select count(uid) from `user_info`  where user_info.uid = any(select touid from `user_relation` where fromuid = '$uid' )";
			
			$sql_error = "select count_relation sql error";
			$result = $this->conn->query($query_str, $sql_error);

			if ($result == false) {
				return false;
			}
			return (int)$result[0]["count(uid)"];
		}

		if ($tag  == 1) {
			$query_str = "select count(uid) from `user_info`where user_info.uid = any(select fromuid from `user_relation` where touid = '$uid')";
			
			$sql_error = "select count_relation sql error";
			$result = $this->conn->query($query_str, $sql_error);

			if ($result == false) {
				return false;
			}
			
			return (int)$result[0]["count(uid)"];
		}
		
	}

	
	function __destruct()
	{

	}
	
}
?>
