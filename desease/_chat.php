<?php
include 'config.php';

$to                = (isset($_POST['to']) ? $_POST['to'] : null);
$from              = (isset($_POST['from']) ? $_POST['from'] : null);;
$message           = (isset($_POST['message']) ? $_POST['message'] : null);
$function          = (isset($_POST['function']) ? $_POST['function'] : null);

if($function == 'save'){
    runQuery("INSERT INTO `chats` (`id`, `user_id`, `message`, `reply_to`, `created_date`) VALUES (NULL, '".$from."', '".$message."', '".$to."', current_timestamp())");
    echo 'done';
}

if($function == 'getusers'){
    $users = fetchRows("SELECT * FROM `login`");
    echo json_encode($users);
}

if($function == 'getchats'){
    $chats = fetchRows("SELECT * FROM `chats` WHERE (`user_id` = ".$from." OR `user_id` = ".$to.") AND (`reply_to` = ".$from." OR `reply_to` = ".$to.")");

    echo json_encode($chats);
}
?>