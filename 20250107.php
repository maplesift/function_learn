<?php

class DB{
    protected $dsn="mysql:host=localhost;charset=utf8;dbname=db003";
    protected $table;
    protected $pdo;
    
    function __construct($table){
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,'root','');
    }
    function a2s(){

    }
    protected function fetchAll(){

    }
    protected function fetchOne(){

    }
    protected function math(){
        
    }
    function find(){
        
    }
    function all(){
        
    }
    
    function del(){

    }
    function save(){

    }
    function sum(){
        
    }
    function count(){

    }
    function max(){

    }
    function min(){

    }
    function avg(){

    }
}
// db外
function to(){
    
}
function dd(){
    
}
function q($sql){
    $pdo=new PDO("mysql:host=localhost;charset=utf8;dbname=db003",'root','');
}