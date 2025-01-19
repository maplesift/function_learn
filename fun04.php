<?php

class DB{
    protected $table;
    protected $pdo;
    protected $dsn="mysql:host=localhost;charset=utf8;dbname=db03";
    
    public function __construct($table) {
        $this->table = $table;
        $this->pdo=new PDO($this->dsn,'root','');
    }
    protected function a2s($array){
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
    function all(...$arg){}
    function find($id){}
    function del($id){}
    function save($array){
        // update set 
        // update table set `1`='1',`2`='2' where `id`='id' 
        // insert into
    }

    protected function math($math,$col='id',$where=[]) {

    }

    function sum($col,$where=[]){}
    function count($where=[]){}


}
// db外
function to($url){}
function dd($array){}
function q(){}