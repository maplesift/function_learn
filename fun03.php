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

    }
    
    protected function fetchAll($sql){
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    protected function fetchOne($sql){
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    function all(){}

    function find(){}

    function del(){}

    function save(){}


    protected function math(){

    }
    function sum(){}
    function count(){}
}
// db外
function to(){}
function dd(){}
function q(){}