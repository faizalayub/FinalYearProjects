<?php
session_start();

function connect(){
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'watchstore';

    try{
        $con = new PDO("mysql:host=" . $host . ";dbname=" . $database, $user, $password);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $con;
    }catch(PDOException $e){
        echo "Connection error: ".$e->getMessage();
    }
}

function numRows($query){
    try{
        $connect = connect();
        $stmt = $connect->query($query);
        $result = $stmt->rowCount();
        return $result;
    }catch(PDOException $e){
        echo "SQL error: ". $e->getMessage();
    }
} 

function fetchRows($query){
     try{
        $connect = connect();
        $stmt = $connect->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        echo "SQL error: ". $e->getMessage();
    } 
} 

function fetchRow($query){
    try{
        $connect = connect();        
        $stmt = $connect->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        echo "SQL error: ". $e->getMessage();
    }
}  

function runQuery($query){
    try{
        $connect = connect();
        $stmt = $connect->prepare($query);
        $stmt->execute();
        return true;
    }catch(PDOException $e){
        echo "SQL error: ". $e->getMessage();
    }

}
?>