<?php
Class DbQuery{
    var $conn;
    var $result;
    var $last_id;
    var $posts;
    function __construct(){
        date_default_timezone_set("Asia/Bangkok");
        $this->conn =  new mysqli('localhost','root','','calendar');
        mysqli_set_charset ($this->conn, 'utf8');
    }
    //insert into table
    function save($data,$tableName){
        $values = (array)$data;
        $columns = implode(", ",array_keys($values));
        foreach ($values as $idx=>$data) $insdata[$idx] = "'".$data."'";
        $insvalues = implode(", ",$insdata);
        $query = "INSERT into $tableName ($columns) VALUES ($insvalues)";
        if($this->conn->query($query) == true){
            $this->last_id = $this->conn->insert_id;
            return $this->result = "success";
        }
        else{return $this->result = $this->conn->error;}
    }
    // select from table with id
    function find($id, $tableName){
        $query = "SELECT * from $tableName where id = '$id'";
        $result = $this->conn->query($query);
        return $this->result = $result;
    }
    //select from tabel with other condition
    function findCondition($condition,$tableName){
            $query = "SELECT * from $tableName $condition";
            $result = $this->conn->query($query);
            return $this->result = $result;
    }
    //select all rows from tabele
    function getall($tableName){
        $query = "SELECT * from $tableName order by id desc";
        $result = $this->conn->query($query);
        return $this->result = $result;
    }
    //delect with id
    function destroy($id,$tableName){
        $query= "DELETE from $tableName where id= '$id'";
        if($this->conn->query($query) == true){
            return $this->result = "success";
        }
        else{return $this->result = $this->conn->error;;}
    }
    function destroyCondition($condition,$tableName){
        $query= "DELETE from $tableName $condition";
        if($this->conn->query($query) == true){
            return $this->result = "success";
        }
        else{return $this->result = $this->conn->error;;}
    }
    //update with id 
    function update($id,$data,$tableName){
        foreach($data as $key => $value){$okv[$key] = $key. "='". $value."'";}
        $ok = implode(", ",$okv);
        $query = "UPDATE $tableName SET $ok where id = '$id'";
        if($this->conn->query($query) == true){
            return $this->result = "success";
        }
        else{return $this->result = $this->conn->error;;}
    }
    function htmlDecode($data){
        $db =$this->conn;
        function change($haha,$db){
           return htmlspecialchars(mysqli_real_escape_string($db,trim($haha)));
        }
        $this->posts = array_map(
            function($input) use ($db) { return change($input, $db); },
            $data
        );
    }

}

?>