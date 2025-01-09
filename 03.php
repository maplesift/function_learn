<?php
// 03
class DB{
    protected $pdo;
    protected $table;
    protected $dsn="mysql:host=localhost;charset=utf8;dbname=db03";
      
    function __construct($table){
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,'root','');
    }
    function a2s($array){
        $tmp=[];
        foreach ($array as $key => $val) {
            $tmp[]="`$key`='$val'";
        }
        return $tmp;
    }
    protected function fetchAll($sql){
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    protected function fetchOne($sql){
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
    function all(...$arg){
        $sql="SELECT * FROM $this->table";
        if(!empty($arg[0])){
            if(is_array($arg[0])){
                $where=$this->a2s($arg[0]);
                $sql .= " where ".join(" && ",$where );
            }else{
                $sql .=$arg[0];
            }
            
        }
        if(!empty($arg[1])){
            $sql .= $arg[1];
        }
        return $this->fetchAll($sql);
    }
    
    function find($id){
    
    }
    function save($array){
        
    }

    
}
// db外
function q($sql){
    $pdo=new PDO("mysql:host=localhost;charset=utf8;dbname=db03",'root','');
    return $pdo->query($sql)->fetchAll();
}
function to($url){
    header("location:".$url);
    
}
function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}