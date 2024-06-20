<?php

require_once '../config/conn.php';

function selectAll()
{
    global $connection;
    $sql = "SELECT * FROM users";
    return $connection->query($sql);
}