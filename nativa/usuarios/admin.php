<?php

include_once('../../configs/configs.php');
include_once('../../configs/seguranca.php');
include_once('../../configs/idiomas.php');
include_once('../../lib/Arquivo.php');

define('TITULO_MODULO', 'Usuários');
define('_TABLE_', 'usuarios');
define('_MODULE_', 'usuarios');
define('_ROUTE_ACTION_', _SITE_URL_ . '/' . _ADMIN_URL_ . '/' . _MODULE_);

$campos = array(
    'nome' => array(
        'label' => "Nome",
        'tipo' => "texto",
        'width' => "100",
        'class' => "left",
    ),
    'email' => array(
        'label' => "e-mail",
        'tipo' => "texto",
        'width' => "100",
        'class' => "left",
    ),
);

$acoes = array(
    'add',
    'editar',
    'remover',
);

function lista($conn) {
    $table = _TABLE_;
    $stmt = $conn->prepare("SELECT * FROM $table Order By nome ASC");
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

function save($conn) {

    if ($_POST && array_key_exists('__send_form', $_POST)) {

        $table = _TABLE_;

        if (!array_key_exists('id', $_POST)) {

            $sql = "INSERT INTO $table (nome, email, senha) "
                    . "VALUES "
                    . "(:nome, :email, :senha)";

            $senha = sha1(_SALT_ . filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING));
        }

        if (array_key_exists('id', $_POST)) {

            $sql = "UPDATE $table SET "
                    . " nome = :nome, email=:email, senha=:senha"
                    . " WHERE id = :id";

            $senhaTemp = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

            if (empty($senhaTemp)) {
                $obj = find($conn, $_POST['id']);
                $senha = $obj['senha'];
            } else {
                $senha = sha1(_SALT_ . $senhaTemp);
            }
        }

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':nome', filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING));
        $stmt->bindValue(':email', filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
        $stmt->bindValue(':senha', $senha);

        if (array_key_exists('id', $_POST)) {
            $stmt->bindParam(':id', filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT), PDO::PARAM_INT);
        }
        $stmt->execute();
        set_traducao($_POST);
        header("location:" . _ROUTE_ACTION_ . '?sucesso=true');
        exit;
    }
    return;
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
