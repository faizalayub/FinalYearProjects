<?php
    include 'config.php';

    runQuery("INSERT INTO `article_permission` (`id`, `article_id`, `user_id`, `status`) VALUES (NULL, '".$_GET['id']."', '".$_GET['user']."', '0')");

    echo "<script>alert('Request submitted, please wait for approval from owner');window.location.href='lecturer-study-material.php'</script>";
?>