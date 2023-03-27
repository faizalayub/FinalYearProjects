<?php
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');

$isAdmin = (isset($_SESSION['account_session']) && $_SESSION['account_session'] == 6);
$systemTime = date("Y-m-d H:i:s");

function connect(){
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'asas_fotografi';

    try{
        $con = new PDO("mysql:host=" . $host . ";dbname=" . $database, $user, $password);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $con;
    }catch(PDOException $e){
        echo "Connection error: ".$e->getMessage();
    }
}

function reArrayFiles($file_post){
    $file_array = array();
    $file_count = count($file_post['tmp_name']);
    $file_key = array_keys($file_post);
    
    for($i = 0; $i < $file_count; $i++){
        foreach($file_key as $key){
            $file_array[$i][$key] = $file_post[$key][$i];
        }
    }
    return $file_array;
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