<?php 
class DB{
    protected $table;
    protected $pdo;
    protected $dsn="mysql:host=localhost;charset=utf8;dbname=db03";

    public function __construct($table) {
        $this->table = $table;
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
                $where= $this->a2s($arg[0]);
                $sql .= " WHERE ".join(" && ",$where);
            }else{
                $sql .= $arg[0];
            }
        }if(!empty($arg[1])){
            $sql .= $arg[1];
        }
        return $this->fetchAll($sql);
    }

    function find($id){
        $sql="SELECT * FROM $this->table";
            if(is_array($id)){
                $where= $this->a2s($id);
                $sql .= " WHERE ".join(" && ",$where);
            }else{
                $sql .= " WHERE  `id`='$id'";
            }
        return $this->fetchOne($sql);
    }

    function del($id){
        $sql="DELETE FROM $this->table";
            if(is_array($id)){
                $where= $this->a2s($id);
                $sql .= " WHERE ".join(" && ",$where);
            }else{
                $sql .= " WHERE  `id`='$id'";
            }
        return $this->pdo->exec($sql);
    }

    function save($array){
        // UPDATE table set `1`='1',`2`='2' where `ID`='ID'
        if(isset($array['id'])){    
            $id=$array['id'];
            unset($array['id']);
            $set=$this->a2s($array['id']);
            $sql="UPDATE $this->table SET".join(',',$set)." WHERE `id`='$id'";
        }
        // INSERT INTO table(``,``,``) VALUES('','','');
        else{
            $cols=array_keys($array);
            $sql ="";
        }
    }
    
    protected function math($math,$col='id',$where=[]){

    }
    function count($where=[]){

    }
    function sum($col,$where=[]){
        
    }

}
// db外
function q($sql){
    
}
function dd($array){
    
}
function to($url){
    
}