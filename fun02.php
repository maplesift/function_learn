<?php
class DB{
    protected $pdo;
    protected $table;
    protected $dsn="mysql:host=localhost;charset=utf8;dbname=db03";
    
    public function __construct($table) {
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,'root','');
    }
    function a2s($array){
        
    }

    protected  function fetchAll($sql){

    }
    protected  function fetchOne($sql){

    }
}
// db外
function to(){

}
function dd(){

}
function q(){
    
}