<?php

require_once '../config/conn.php';

$_SESSION = [];
session_unset();
session_destroy();

header('Location: ' . BASEURL . '/view/login.php');
