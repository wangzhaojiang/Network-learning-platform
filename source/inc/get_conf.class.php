<?php

class Get_conf{
    
    public function __construct(){

    }

    public function get_content(){
        $path = dirname(dirname(__FILE__))."/conf/jaker.conf";
        $file = fopen($path, "r") or die("can't read the conf");
        $array = array();
        while(!feof($file)){
            $line = trim(fgets($file));
            #echo $line;
            if (!empty($line) and $line[0] != "#"){
                list($key, $value) = split('=', $line);
                $key = trim($key, "' \"");
                $value = trim($value, "' \"");
                $array[$key] = $value;
            }
        }
        return $array;

    }

}


?>
