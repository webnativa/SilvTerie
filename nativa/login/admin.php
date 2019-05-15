<?php

session_start();

include_once('../../configs/configs.php');
define('TITULO_MODULO', 'Lofig');
define('_TABLE_', 'usuarios');
define('_MODULE_', 'login');
define('_ROUTE_ACTION_', _SITE_URL_ . '/' . _ADMIN_URL_ . '/' . _MODULE_);

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

    $response = array('sucesso' => false);

    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    if (empty($senha) || empty($email)) {
        $response['mensagem'] = "Informe seu e-mail e senha.";
        echo json_encode($response);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['mensagem'] = "e-mail inválido.";
        echo json_encode($response);
        exit;
    }

    $table = _TABLE_;
    
    $senha = sha1(_SALT_ . $senha);
    
    $stmt = $conn->prepare("SELECT * FROM $table WHERE email = :email And senha = :senha");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch();

    if (!$result) {
        $response['mensagem'] = "Dados incorretos.";
        echo json_encode($response);
        exit;
    }
    
    $_SESSION['logado'] = true;
    $_SESSION['id'] = $result['id'];

    $response['sucesso'] = true;
    echo json_encode($response);
    exit;
}
