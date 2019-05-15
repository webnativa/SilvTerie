<?php

if (!isset($_SESSION)) {
    session_start();
}
if (empty($_SESSION['id']) || empty($_SESSION['logado'])) {
    header("location:" . _SITE_URL_ . '/' . _ADMIN_URL_ . '/login/');
}