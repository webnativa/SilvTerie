<?php

session_start();

include_once('../../configs/configs.php');

$_SESSION['logado'] = true;
$_SESSION['id'] = $result['id'];

header("location:" . _SITE_URL_ . '/' . _ADMIN_URL_ . '/login/');
