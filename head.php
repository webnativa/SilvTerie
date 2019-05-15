<?php
ini_set('display_errors', 0 );

session_start();
include_once('configs/configs.php');
include_once('configs/funcoes.php');
include_once('configs/idiomas.php');

$stmt = $conn->prepare("SELECT * FROM configuracoes");
$stmt->execute();
$config = $stmt->fetch();
?>

