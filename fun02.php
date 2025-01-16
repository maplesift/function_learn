<?php
class DB{
    protected $dsn="mysql:host=localhost;charset=utf8;dbname=db03";
    protected $pdo;
    protected $table;
    
    public function __construct($table){
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

    protected  function fetchOne($sql){
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
    protected  function fetchAll($sql){
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    function all(...$arg){
        $sql="SELECT * FROM $this->table";
        if(!empty($arg[0])){
            if(is_array($arg[0])){
                $where=$this->a2s($arg[0]);
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
                
                $where=$this->a2s($id);
                $sql .= " WHERE ".join(" && ",$where); 
            }else{
                $sql .= "WHERE `id`='$id'";
            }

        return $this->fetchOne($sql);
    }
    
    function del($id){
        $sql="DELETE  FROM $this->table";
            if(is_array($id)){
                
                $where=$this->a2s($id);
                $sql .= " WHERE ".join(" && ",$where); 
            }else{
                $sql .= " WHERE `id`='$id'";
            }

        return $this->pdo->exec($sql);
    }
    

    function save($array){
        // update
        if(isset($array['id'])){
            $id=$array['id'];
            unset($array['id']);
            $set=$this->a2s($array);
            $sql ="UPDATE $this->table SET ".join(',',$set)." where `id`='$id'";
        }else{
            // insert into
            $cols=array_keys($array);
            $sql="INSERT INTO $this->table (`".join("`,`",$cols)."`) VALUES('".join("','",$array)."')";
        }
            return $this->pdo->exec($sql);
    }

    
    protected function math($math,$col='id',$where=[]){
        $sql= "SELECT $math($col) FROM $this->table";
        if(!empty($where)){
            $tmp=$this->a2s($where);
            $sql .= " WHERE ".jion(" && ",$tmp );
        }
        return $this->pdo->query($sql)->fetchColumn();
    }
    function sum($col,$where=[]){
        return $this->math('sum',$col,$where);
    }
    function count($where=[]){
        return $this->math('count','*',$where);
    }

}
// db外
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