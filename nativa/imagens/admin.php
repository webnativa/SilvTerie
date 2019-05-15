<?php

include_once('../../configs/configs.php');
include_once('../../configs/seguranca.php');
include_once('../../configs/idiomas.php');
include_once('../../lib/Arquivo.php');

define('TITULO_MODULO', 'Imagens');
define('_TABLE_', 'imagens');
define('_MODULE_', 'imagens');
define('_ROUTE_ACTION_', _SITE_URL_ . '/' . _ADMIN_URL_ . '/' . _MODULE_);

$campos = array(
    'img' => array(
        'label' => "Imagem",
        'tipo' => "imagem",
        'width' => "10",
        'class' => "left",
    ),
    'posicao' => array(
        'label' => "Posição",
        'tipo' => "posicao",
        'width' => "10",
        'class' => "center",
    )
);

$acoes = array(
    'remover',
    'posicao',
);

function lista($conn, $entity_id, $tipo) {

    App_Arquivo::folder("imagens/$entity_id");

    $table = _TABLE_;
    $sql = "SELECT *, concat('imagens/', entity_id, '/', imagem) as img FROM $table "
            . " Where entity_id = '$entity_id' And tipo = '$tipo' Order By posicao ASC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt;
}

function find($conn, $id) {

    if (!$id) {
        return false;
    }

    $table = _TABLE_;
    $stmt = $conn->prepare("SELECT * FROM $table WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch();

    return $result;
}

function remover($conn) {

    if (!array_key_exists('remove', $_POST)) {
        return;
    }

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            
        $table = _TABLE_;
        $obj = find($conn, $_POST['id']);
        $entity_id = $obj['entity_id'];
        $imagem = $obj['imagem'];
        
        unlink("../../public/uploads/imagens/$entity_id/$imagem");
        $stmt = $conn->prepare("DELETE FROM $table WHERE id = :id");
        $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
        $stmt->execute();
        
        echo json_encode(array('sucesso' => true));
        exit;
    }
}

function ordenar_posicao($conn) {

    if (!array_key_exists('ordenar', $_POST)) {
        return;
    }

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $table = _TABLE_;


        $sql = "UPDATE $table SET "
                . " posicao = :posicao "
                . "WHERE id = :id";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':posicao', filter_input(INPUT_POST, 'posicao', FILTER_SANITIZE_STRING));
        $stmt->bindParam(':id', filter_input(INPUT_POST, 'pk', FILTER_SANITIZE_NUMBER_INT), PDO::PARAM_INT);

        $stmt->execute();

        echo json_encode(array('sucesso' => true));
        exit;
    }
}

ordenar_posicao($conn);
remover($conn);
