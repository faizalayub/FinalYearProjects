<?php
include 'config.php';

$function = (isset($_POST['function']) ? $_POST['function'] : null);
$to = (isset($_POST['to']) ? $_POST['to'] : null);
$from = (isset($_POST['from']) ? $_POST['from'] : null);
$message = (isset($_POST['message']) ? $_POST['message'] : null);

if($function == 'save'){
    runQuery("INSERT INTO `chats` (`id`, `user_id`, `message`, `reply_to`, `created_date`) VALUES (NULL, '".$from."', '".$message."', '".$to."', current_timestamp())");
    echo 'done';
}

if($function == 'getusers'){
    $users = fetchRows("SELECT * FROM login WHERE type = 2");
    echo json_encode($users);
}
?>