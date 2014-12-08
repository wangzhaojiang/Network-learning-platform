<?php
require_once("conn.php");

class Mail{
    private $fromuid;
    private $db;

    public function __construct($uid){
        $this -> fromuid = $uid;
        $this->db = new Nlpdb();

    }

    public function name_to_uid($name){
        $result = $this->db->query("select uid from user_info where name = '$name'", "name_to_uid error");
        if ( $result == false ){
            return $result;
        }
        return (int)$result[0]["uid"];
    
    }

    public function uid_to_name($uid){
        $result = $this->db->query("select name from user_info where uid = $uid", "uid_to_name error");
        if ( $result == false ){
            return $result;
        }
        return $result[0]["name"];
    
    }

    #public function sql($sql_str, $sql_error = ''){
    #    $db = new Nlpdb();
    #    $result = $db -> query($sql_str);
    #    if ($result == false){
    #        echo $sql_error;
    #        return $result;
    #    }

    #    if (is_object($result) and $result -> num_rows > 0){
    #        while( $row = $result -> fetch_assoc() )
    #            $array[] = $row;
    #        return $array;
    #    }

    #    return $result;

    #}

    public function send_mail($toname, $content){    
        $touid = $this -> name_to_uid($toname);
        $status = 0;
        $time = date("Y-m-d H:i:s", time());

        if( $touid == false ){
            return array("result" => false, "error" => "not found this user");
        }

        if( empty($content) ){
            return array("result" => false, "error" => "the content couldn't be null");
        }

        $result = $this->db->query("insert into user_mail (fromuid, touid, content, status, time) values ($this->fromuid, $touid, '$content', $status, '$time')",
            "send_mail error");

        if ( $result == false ){
            return array("result" => false, "error" => "send_mail error");
        }
        else {
            return array("result" => true);
        }


    }

    public function delete_mail($mid){                          
        //这块是否可能存在安全问题；如果构造$mid发送可能删除其他用户邮件？是否需要加上一个校验
        //如果操作出现错误 能否直接die掉(不可以)；
        //如果删除了的话  数据库这条信息删除那接受方不就也同时删除了
        //逻辑层是否得通过session来判断当前用户是否符合
        //这块得讨论一下
        $result = $this->db->query("delete from user_mail where mid = $mid", "delete mail error");
        if ( $result == false ){
            return array("result" => false, "error" => "delete mail failed");
        }
        else{
            return array("result" => true);
        }
    
    }

    #public function mail_status_count($status){
    #    $result = $this -> sql("select count(fromuid) from user_mail where status = $status and fromuid = $this -> fromuid", "mail_status_count error");
    #    if ( $result == false ){
    #        return array("result" => false, "error" => "count error");
    #    }
    #    else{
    #        var_dump($row);
    #        #return array("result" => true, "count" => );
    #    }
    #}

    public function mail_recv_list($status){
        $touid = $this -> fromuid;

        # status == 0/1 则返回相应的状态列表。 若 status != 0/1 则返回全部；
        if ( $status == 0 || $status == 1 ){
            $result = $this->db->query("select time, fromuid, mid from user_mail where status = $status and touid = $touid order by time", "mail_recv_list error");
        }
        else{
            $result = $this->db->query("select time, fromuid from user_mail where touid = $touid order by time", "mail_recv_list error");
        }
        if ( $result == false ){
            return array("result" => false, "error" => "mail_recv_list error");
        }
        else{
            //coding ...
            //fromuid -> name;
            //return fromname + time;
            foreach( $result as $key=>$value ){
                $fromname = $this->uid_to_name($result[$key]["fromuid"]);
                $result[$key]["fromname"] = $fromname;
            }
            return $result;
        }
    
    }

    public function mail_send_list(){
        $result = $this->db->query("select time, touid, mid from user_mail where fromuid = $this->fromuid", "mail_send_list error");
        if ( $result == false ){
            return array("result" => false, "error" => "mail_send_list error");
        }

        else{
            //coding...
            //touid => toname
            //return toname + time
            foreach( $result as $key=>$value ){
                $toname = $this->uid_to_name($result[$key]["touid"]);
                $result[$key]["toname"] = $toname;
            }
            return $result;
        }
    }

    public function mail_info($mid){
        $result = $this->db->query("select fromuid, touid, time, content from user_mail where mid = $mid", "mail_info error");
        if ($result == false){
            return array("result"=>false, "error"=>"get mail_info error");
        }
        else{
            foreach( $result as $key=>$value ){
                $toname = $this->uid_to_name($result[$key]["touid"]);
                $fromname = $this->uid_to_name($result[$key]["fromuid"]);
                $result[$key]["toname"] = $toname;
            }
            return $result;
        }
    
    
    }

    public function mail_status_update($mid){ //mail ---> read;
        $result = $this->db->query("update user_mail set status = 1 where mid = $mid", "mail_status_update error");
        if ($result == false){
            return array("result"=>false, "error"=>"mail status update error");
        }
        else{
            return array("result"=>true);
        }

    
    }

}


?>
