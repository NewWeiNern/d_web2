<?php

class DB{
    protected static $local = "localhost";
    protected static $root = "root";
    protected static $pass = "";
    protected static $db = "db_a2_newweinern";
    function __construct(){
        $this->connect = new mysqli(self::$local, self::$root, self::$pass, self::$db);
    }
    public function close_db(){
        $this->connect->close();
    }
    public function get($table){
        $query = $this->connect->query("SELECT * FROM $table");
        $res = $query->fetch_assoc();
        $query->close();
        return $res;
    }
    public function find($table, $cond){
        $query = $this->connect->query("SELECT * FROM $table WHERE $cond");
        $res = $query->fetch_assoc();
        $query->close();
        return $res;
    }
    public function custom_select($select = "*", $table, $cond){
        echo "SELECT $select FROM $table $cond";
        $query = $this->connect->query("SELECT $select FROM $table $cond");
        $res = $query->fetch_assoc();
        $query->close();
        return $res;
    }
    public function select($select, $table, $where){
        $query = $this->connect->query("SELECT $select FROM $table WHERE $where");
        $res = $query->fetch_assoc();
        $query->close();
        return $res;
    }
    public function update($table, $update, $where){
        $query = $this->connect->query("UPDATE $table SET $update WHERE $where");
    }
    public function insert($table, $col, $val){
        $query = $this->connect->query("INSERT INTO $table ($col) VALUES ($val)");
    }
    public function exist($table, $key, $v){
        $query = $this->find($table, "$key = '$v'");
        return $query;
    }
    function delete($table, $where){
        $query = $this->connect->query("DELETE FROM $table WHERE $where");
    }
}

?>