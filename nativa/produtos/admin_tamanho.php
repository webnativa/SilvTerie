<?php

include_once('../../configs/configs.php');
include_once('../../configs/seguranca.php');
include_once('../../configs/idiomas.php');
include_once('../../lib/Arquivo.php');

define('TITULO_MODULO', 'Produtos');
define('_TABLE_', 'produtos');
define('_MODULE_', 'produtos');
define('_ROUTE_ACTION_', _SITE_URL_ . '/' . _ADMIN_URL_ . '/' . _MODULE_);

$campos = array(
    'nome_produto' => array(
        'label' => "Título",
        'tipo' => "texto",
        'width' => "100",
        'class' => "left",
    ),
    'nome_categoria' => array(
        'label' => "Categoria",
        'tipo' => "texto",
        'width' => "100",
        'class' => "left",
    ),
    'valor' => array(
        'label' => "Valor",
        'tipo' => "texto",
        'width' => "100",
        'class' => "left",
    ),
    'status' => array(
        'label' => "Status",
        'tipo' => "bool",
        'width' => "50",
        'class' => "center",
    ),
    'destaque' => array(
        'label' => "Destaque",
        'tipo' => "bool",
        'width' => "50",
        'class' => "center",
    ),
    'imagem' => array(
        'label' => "Imagem",
        'tipo' => "imagem",
        'pasta' => "produtos",
        'width' => "100",
        'class' => "center",
    ),
);

$acoes = array(
    'add',
    'editar',
    'remover',
    'fotos',
);

function lista($conn) {
    
    $table = _TABLE_;
    $sql = "SELECT PRODUTO.*, PRODUTO.titulo as nome_produto, CATEGORIA.id as categoria_id, CATEGORIA.titulo as nome_categoria"
            . " FROM $table PRODUTO Inner Join categorias CATEGORIA"
            . " on CATEGORIA.id = PRODUTO.categoria_id Order By PRODUTO.id DESC";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt;
}

function getCategorias($conn) {
    $table = _TABLE_;
    $stmt = $conn->prepare("SELECT * FROM categorias Order By titulo ASC");
    $stmt->execute();
    return $stmt;
}
function getMarcas($conn) {
    $table = _TABLE_;
    $stmt = $conn->prepare("SELECT * FROM marcas Order By titulo ASC");
    $stmt->execute();
    return $stmt;
}
function getCores($conn) {
    $table = _TABLE_;
    $stmt = $conn->prepare("SELECT * FROM cores Order By titulo ASC");
    $stmt->execute();
    return $stmt;
}

function getTamanho($conn) {

    $stmt = $conn->prepare("SELECT * FROM tamanho Order By nome ASC");
    $stmt->execute();
    return $stmt;
}
function getTamanhoMarcado($produto_id, $conn) {

    $stmt = $conn->prepare("SELECT * FROM tamanho_produto Where produto_id = $produto_id");
    $stmt->execute();
    return $stmt;
}


function last_id($conn) {

    $query = "SELECT MAX(id) as id FROM produtos";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    return $stmt->fetch();
}

function addTamanho($produto_id, $conn) {

    $tamanho = $_POST['tamanho'];

    $stmt = $conn->prepare("DELETE FROM tamanho_produto WHERE produto_id = :produto_id");
    $stmt->bindParam(':produto_id', $produto_id, PDO::PARAM_INT);
    $stmt->execute();

    foreach ($tamanho as $key => $caracteristica_id) {

        $sql = "INSERT INTO tamanho_produto (produto_id, caracteristisca_id)"
                . " VALUES (:produto_id, :caracteristisca_id)";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':produto_id', $produto_id);
        $stmt->bindValue(':caracteristisca_id', $caracteristica_id);
        $stmt->execute();
    }
}




function save($conn) {
   
    
    if ($_POST && array_key_exists('__send_form', $_POST)) {

        $table = _TABLE_;


            $sql = "UPDATE $table SET "
                    . " addTamanho=:addTamanho WHERE id = :id";


        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':addTamanho', filter_input(INPUT_POST, 'addTamanho', FILTER_SANITIZE_NUMBER_INT));


        if (array_key_exists('id', $_POST)) {
            
            $produto_id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $stmt->bindParam(':id', $produto_id, PDO::PARAM_INT);
        }


        if (array_key_exists('id', $_POST)) {
            $stmt->bindParam(':id', filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT), PDO::PARAM_INT);
        }
        
        if (!array_key_exists('id', $_POST)) {
            $modulo = _MODULE_;
            $stmt->bindParam(':modulo', $modulo, PDO::PARAM_STR);
        }


        try {
            $stmt->execute();
            $result = last_id($conn);
            if (!array_key_exists('id', $_POST)) {
                $produto_id = $result['id'];
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }

        addTamanho($produto_id, $conn);

        
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