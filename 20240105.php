<?php 

class DB{
    protected $dsn="mysql:host=localhost;charset=utf8;dbname=db03";
    protected $table;
    protected $pdo;

    function __construct($table){
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,'root','');
    }
    function a2s($array){
        $tmp=[];
        foreach($array as $key => $val){
            $tmp[]="`$key`='$val'";
        }
        return $tmp;
    }
    function fetchAll(){
        
    }
    function fetchOne(){
        
    }
    
    function all(...$arg){
        $sql="SELECT * FROM $this->table ";
        if(!empty($arg[0])){
            if(is_array($arg[0])){
                $where=$this->a2s($arg[0]);
                $sql=$sql . " WHERE ". join(" && ",$where);
            }else{
                $sql .= $arg[0];
            }
        }
        if(!empty($arg[1])){
            $sql .= $arg[1];
        }
        return $this->fetchAll($sql);
    }
    function find(){
        
    }
    function save(){
        
    }
    function del(){
        
    }
    function math(){
        
    }
    function sum(){
        
    }
    function count(){
        
    }
}
// class外

function q($sql){
    $pdo=new PDO("mysql:host=localhost;charset=utf8;dbname=db03",'root','');
    return $pdo->query($sql)->fetchAll();
}



function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
function to($url){
    header("location:".$url);
}