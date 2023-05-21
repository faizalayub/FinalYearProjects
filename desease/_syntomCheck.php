<?php
include 'config.php';

$finalArray = [];
$body = (isset($_POST['body']) ? $_POST['body'] : '');
$syntom = (isset($_POST['syntom']) ? $_POST['syntom'] : '');

if(!empty($body)){
    $bodyCards = [];
    $bodyQuery = "SELECT id FROM `possible_disease` WHERE ";

    foreach(explode(",", $body) as $b){
        $bodyCards[] = "(`possible_disease`.`body` LIKE '%".$b."%')";
    }

    $searchBody = fetchRows($bodyQuery.implode(' OR ', $bodyCards));
    
    //# Validate symptoms of body part
    foreach($searchBody as $key => $value){
        $bodyId = ($value['id']);
        $syntomCards = [];
        $syntomQuery = "SELECT * FROM `possible_disease` WHERE `id` = ".$bodyId;

        foreach(explode(",", $syntom) as $b){
            $syntomCards[] = "(`possible_disease`.`syntom` LIKE '%".$b."%')";
        }

        $resultSyntom = fetchRow("$syntomQuery AND (".implode(' OR ', $syntomCards).")");

        if(!empty($resultSyntom)){
            $finalArray[] = json_decode($resultSyntom['possible']);
        }
    }
}

$response = [];

foreach($finalArray as $disease){
    foreach($disease as $n){
        if(!in_array($n, $response)){
            array_push($response, $n);
        }
    } 
}

echo json_encode($response);
?>