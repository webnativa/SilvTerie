<?php

include_once('../../configs/configs.php');
include_once('../../configs/seguranca.php');
include_once('../../configs/idiomas.php');
include_once('../../lib/Arquivo.php');

define('TITULO_MODULO', 'Equipe');
define('_TABLE_', 'institucional');
define('_MODULE_', 'equipe');
define('_ROUTE_ACTION_', _SITE_URL_ . '/' . _ADMIN_URL_ . '/' . _MODULE_);

$campos = array(
    'imagem' => array(
        'label' => "Imagem",
        'tipo' => "imagem",
        'pasta' => "conteudo",
        'width' => "100",
        'class' => "center",
    ),
    'titulo' => array(
        'label' => "Título",
        'tipo' => "texto",
        'width' => "100",
        'class' => "left",
    ),
    'status' => array(
        'label' => "Ativo?",
        'tipo' => "bool",
        'width' => "100",
        'class' => "center",
    ),
);

$acoes = array(
    'add',
    'editar',
    'remover',
);

function lista($conn) {
    $modulo = _MODULE_;
    $table = _TABLE_;
    $stmt = $conn->prepare("SELECT * FROM $table WHERE modulo = '$modulo' Order By id Desc");
    $stmt->execute();
    return $stmt;
}

function save($conn) {

    if ($_POST && array_key_exists('__send_form', $_POST)) {

        $table = _TABLE_;

        if (!array_key_exists('id', $_POST)) {

            $sql = "INSERT INTO $table (titulo, sintese, texto, imagem, status, modulo) "
                    . "VALUES "
                    . "(:titulo, :sintese, :texto, :imagem, :status, :modulo)";
        }

        if (array_key_exists('id', $_POST)) {

            $sql = "UPDATE $table SET "
                    . " titulo = :titulo, sintese=:sintese, texto=:texto, imagem= :imagem, status= :status "
                    . "WHERE id = :id";
        }

        $imagem = App_Arquivo::upload('conteudo', $_FILES['imagem']);

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':titulo', filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING));
        $stmt->bindValue(':sintese', filter_input(INPUT_POST, 'sintese', FILTER_SANITIZE_STRING));
        $stmt->bindValue(':texto', filter_input(INPUT_POST, 'texto', FILTER_SANITIZE_SPECIAL_CHARS));
        $stmt->bindValue(':status', filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT));
        $stmt->bindValue(':imagem', $imagem);

        if (array_key_exists('id', $_POST)) {
            $stmt->bindParam(':id', filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT), PDO::PARAM_INT);
        }
        
        if (!array_key_exists('id', $_POST)) {
            $modulo = _MODULE_;
            $stmt->bindParam(':modulo', $modulo, PDO::PARAM_STR);
        }
        
        $stmt->execute();
        set_traducao($_POST);
        header("location:" . _ROUTE_ACTION_ . '?sucesso=true');
        exit;
    }
    return;
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
        $stmt = $conn->prepare("DELETE FROM $table WHERE id = :id");
        $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
        $stmt->execute();

        echo json_encode(array('sucesso' => true));
        exit;
    }
}

save($conn);
remover($conn);
