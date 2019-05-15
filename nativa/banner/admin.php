<?php

include_once('../../configs/configs.php');
include_once('../../configs/seguranca.php');
include_once('../../configs/idiomas.php');
include_once('../../lib/Arquivo.php');

define('TITULO_MODULO', 'Banners');
define('_TABLE_', 'banner');
define('_MODULE_', 'banner');
define('_ROUTE_ACTION_', _SITE_URL_ . '/' . _ADMIN_URL_ . '/' . _MODULE_);

$campos = array(
    'imagem' => array(
        'label' => "Imagem",
        'tipo' => "imagem",
        'pasta' => "../../public/uploads/banner",
        'width' => "50",
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
    $table = _TABLE_;
    $stmt = $conn->prepare("SELECT * FROM $table Order By id Desc");
    $stmt->execute();
    return $stmt;
}

function save($conn) {

    if ($_POST && array_key_exists('__send_form', $_POST)) {

        $table = _TABLE_;

        if (!array_key_exists('id', $_POST)) {

            $sql = "INSERT INTO $table (titulo, link, status, imagem, tipo, modulo) "
                    . "VALUES "
                    . "(:titulo, :link, :status, :imagem, :tipo, :modulo)";
        }

        if (array_key_exists('id', $_POST)) {

            $sql = "UPDATE $table SET "
                    . " titulo = :titulo, link=:link, status=:status, imagem= :imagem, tipo=:tipo "
                    . "WHERE id = :id";
        }

        $imagem = App_Arquivo::upload('banner', $_FILES['imagem']);

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':titulo', filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING));
        $stmt->bindValue(':tipo', filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_STRING));
        $stmt->bindValue(':link', filter_input(INPUT_POST, 'link', FILTER_SANITIZE_STRING));
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
