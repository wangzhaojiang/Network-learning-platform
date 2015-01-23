<?php
require_once('conn.php');

class Vedio{
    private $conn;
    private $touid;

    public function __construct($fromuid, $touid){
        $this->conn = new Nlpdb();
        $this->touid = $touid; #目标用户ID
    }

    #观看视频
    public function watch_vedio($vid, $fromuid = 0){
        $query_str = "select  ";
    }
    
    #展示目标用户所有视频页面
    public function cat_vedio(){
        $query_str = "select vid, uid, vedio_name, vedio_tag, vedio_photo, vedio_sort, vedio_watch, time from vedio_info where uid = $this->touid and vedio_status = 1";

        $sql_error = "cat_vedio select error";

        $result = $this->conn->query($query_str, $sql_error);
        
        if ($result == false){
            return array("status" => false, "error" => "cat vedio error");
        }
        else if ($result == 'nothing'){
            return array("status" => true, "content" => null);
        }
        else{
            return array("status" => true, "content" => $result);

        }

    }
}

?>
