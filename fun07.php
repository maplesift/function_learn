<?php 

session_start();

class DB{
    protected $table;
    protected $pdo;
    protected $dsn="mysql:host=localhost;charset=utf8;dbname=web03";

    public function __construct($table) {
        $this->table = $table;
        $this->pdo= new pdo($this->$dsn,'root','');
    }
    function a2s($array){
        $tmp=[];
        foreach ($array as $key => $val) {
            $tmp[]="`$key`='$val'";
        }
        return $tmp;
    }
    function fetchOne($sql) {
        return $this->pdo->query($sql)->fetch(PDO::FETCT_ASSOC);
    }
    function fetchAll($sql) {
        return $this->pdo->query($sql)->fetchAll(PDO::FETCT_ASSOC);
    }
    function all(...$array){
        $sql="SELECT * FROM $this->table";
        if(!empty($array[0]) && is_array($array[0])){
            $where= $this->a2s($array[0]);
            $sql .= " WHERE ".join(" && ",$where);
        }else{
            $sql .= $array[0];
        }
        if(!empty($array[1])){
            $sql .= $array[1];
        }
        return $this->fetchAll($sql);
    }
    function find($id){
        $sql="SELECT * FROM $this->table";
        if(is_array($id)){
            $where= $this->a2s($id);
            $sql .= " where ".join(" && ",$where );
        }
        else{
            $sql .= " where `id`='$id' ";
        }
        return $this->fetchOne($sql);
    }
    function del($id){
        $sql="DELETE FROM $this->table";
        if(is_array($id)){
            $where= $this->a2s($id);
            $sql .= " where ".join(" && ",$where );
        }
        else{
            $sql .= " where `id`='$id' ";
        }
        return $this->pdo->exec($sql);
    }
    function save($array){
        // UPDATE $this->table set
        if(isset($array['id'])){
            $id=$array['id'];
            unset($array['id']);
            $tmp=$this->a2s($array);
            $sql = " UPDATE $this->table SET ".join(',',$tmp)." WHERE `id`='$id' ";
        }
        else{
            // INSERT INTO $THIS->TABLE
            $keys =join("`,`",array_keys($array));
            $val =join("','",$array);
            $sql =" INSERT INTO $this->table(`{$keys}`) VALUES('{$val}')";

        }
        return $this->pdo->exec($sql);
    }
    function count(...$array) {
        $sql="SELECT count(*) FROM $this->table";
        if(!empty($array[0]) && is_array($array[0])){
            $where= $this->a2s($array[0]);
            $sql .= " WHERE ".join(" && ",$where);
        }else{
            $sql .= $array[0];
        }
        if(!empty($array[1])){
            $sql .= $array[1];
        }
        return $this->pdo->query($sql)->fetchColumn();
        
        
    }
}
// DB外
function q($sql){
    $dsn="mysql:host=localhost;charset=utf8;dbname=web03";
    $pdo=new pdo($dsn,'root','');
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