<?php

require_once 'db_conaction.php';

$userName = $_POST['user']['username'];
$userPassword = $_POST['user']['password'];

$query = $mysqli->query("SELECT * FROM `users` WHERE `email` = '$userName'  AND `password` = md5('$userPassword')");

$row_cnt = $query->num_rows;

if ($row_cnt > 0){
    echo 'success';
}
