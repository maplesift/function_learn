<?php
date_default_timezone_set('Asia/Taipei');
session_start();


class DB{
    protected $dsn="mysql:host=localhost;charset=utf8;dbname=db03_z04";
    protected $pdo;
    protected $table;

     function __construct($table) {
        $this->table = $table;
        $this->pdo = new pdo($this->dsn,'root','');
    }
    // solid 單一工作原則 arrayToSql
    function a2s($array){
        $tmp=[];
        foreach ($array as $key => $val) {
            $tmp[]="`$key`='$val'";
        }
        return $tmp;
    }
     function fetchOne($sql){
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
     function fetchAll($sql){
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function all(...$arg){
        $sql=" SELECT * FROM $this->table ";
        if(!empty($arg[0]) && is_array($arg[0])){
        $tmp=$this->a2s($arg[0]);
        $sql .= " where ".join(" && ",$tmp);            
        }
        else if(isset($arg[0]) && is_string($arg[0])){
            $sql .= $arg[0];
        }
        if(!empty($arg[1])){
            $sql .= $arg[1];
        }
        return $this->fetchAll($sql);
    }
    function find($array){
        $sql=" SELECT * FROM $this->table ";
        if(is_array($array)){
            $tmp=$this->a2s($array);
            $sql .= " where ".join(" && ",$tmp);
        }
        else{
            $sql .= " where  `id`='$array' ";  
        }
        return $this->fetchOne($sql);
    }
    function del($array){
        $sql=" DELETE  FROM $this->table ";
        if(is_array($array)){
            $tmp=$this->a2s($array);
            $sql .= " where ".join(" && ",$tmp);
        }
        else{
            $sql .= " where  `id`='$array' ";  
        }
        return $this->pdo->exec($sql);
    }


    function save($array){
        if(isset($array['id'])){
            // update
            $id=$array['id'];
            unset($array['id']);
            $tmp=$this->a2s($array);
            $sql = " UPDATE $this->table SET ".join(",",$tmp)." where `id`='$id'";
        }else{
            // insert into
                $keys=join("`,`",array_keys($array));
                $val =join("','",$array);
                $sql=" INSERT INTO $this->table (`{$keys}`) values('{$val}')";
                
        }
        return $this->pdo->exec($sql);
    }

    function count(...$array){
        $sql=" SELECT count(*) FROM $this->table ";
        if(!empty($array[0]) && is_array($array[0])){
        $tmp=$this->a2s($array[0]);
        $sql .= " where ".join(" && ",$tmp);            
        }
        else if(!is_string($array[0])){
            $sql .= $array[0];
        }
        if(!empty($array[1])){
            $sql .= $array[1];
        }
        return $this->pdo->query($sql)->fetchColumn();
    }
}
// db外
function q($sql){
    $dsn="mysql:host=localhost;charset=utf8;dbname=db03_z04";
    $pdo= new PDO($dsn,'root','');
    return $pdo->query($sql)->fetchALL();
}
function to($url){
    header("location:".$url);
}
function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

$Mem=new DB("members");
$Admin=new DB("admins");
$Bot=new DB("bottom");
$Type=new DB("types");
$Item=new DB("items");