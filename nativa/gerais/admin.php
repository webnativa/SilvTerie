<?php
ini_set('display_errors', 'off');

include_once('../../configs/configs.php');
include_once('../../configs/seguranca.php');
include_once('../../configs/idiomas.php');
include_once('../../lib/Arquivo.php');

define('TITULO_MODULO', 'Configurações gerais');
define('_TABLE_', 'configuracoes');
define('_MODULE_', 'gerais');
define('_ROUTE_ACTION_', _SITE_URL_ . '/' . _ADMIN_URL_ . '/' . _MODULE_);

$campos = array(
    'titulo' => array(
        'label' => "Título",
        'tipo' => "texto",
        'width' => "100",
        'class' => "left",
    )
);

$acoes = array(
    'editar',
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

            $sql = "INSERT INTO $table (facebook, linkedin, gplus, instagram,  telefones, telefones2, telefones3, email, assinatura, imagem, modulo, seo_titulo, seo_palavras, seo_descricao, texto) "
                    . "VALUES "
                    . "(:facebook, :linkedin, :gplus, :instagram,  :telefones, :telefones2, :telefones3, :email, :assinatura, :imagem, :modulo, :seo_titulo, :seo_palavras, :seo_descricao, :texto)";
        }

        if (array_key_exists('id', $_POST)) {

            $sql = "UPDATE $table SET "
                    . "facebook=:facebook, linkedin=:linkedin, gplus=:gplus, instagram=:instagram, telefones=:telefones, telefones2=:telefones2, telefones3=:telefones3, email=:email, assinatura=:assinatura, imagem=:imagem, seo_titulo=:seo_titulo, seo_palavras=:seo_palavras, seo_descricao=:seo_descricao, texto=:texto "
                    . "WHERE id = :id";
        }

        $imagem = App_Arquivo::upload('conteudo', $_FILES['imagem']);

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':facebook', filter_input(INPUT_POST, 'facebook', FILTER_SANITIZE_STRING));
        $stmt->bindValue(':linkedin', filter_input(INPUT_POST, 'linkedin', FILTER_SANITIZE_STRING));
        $stmt->bindValue(':gplus', filter_input(INPUT_POST, 'gplus', FILTER_SANITIZE_STRING));
        $stmt->bindValue(':instagram', filter_input(INPUT_POST, 'instagram', FILTER_SANITIZE_STRING));
        $stmt->bindValue(':telefones', filter_input(INPUT_POST, 'telefones', FILTER_SANITIZE_STRING));
        $stmt->bindValue(':telefones2', filter_input(INPUT_POST, 'telefones2', FILTER_SANITIZE_STRING));
        $stmt->bindValue(':telefones3', filter_input(INPUT_POST, 'telefones3', FILTER_SANITIZE_STRING));
        $stmt->bindValue(':email', filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
        $stmt->bindValue(':assinatura', filter_input(INPUT_POST, 'assinatura', FILTER_SANITIZE_STRING));
        $stmt->bindValue(':seo_titulo', filter_input(INPUT_POST, 'seo_titulo', FILTER_SANITIZE_STRING));
        $stmt->bindValue(':seo_descricao', filter_input(INPUT_POST, 'seo_descricao', FILTER_SANITIZE_STRING));
        $stmt->bindValue(':seo_palavras', filter_input(INPUT_POST, 'seo_palavras', FILTER_SANITIZE_STRING));
        $stmt->bindValue(':texto', filter_input(INPUT_POST, 'texto', FILTER_SANITIZE_SPECIAL_CHARS));
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
