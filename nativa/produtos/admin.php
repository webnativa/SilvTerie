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




function save($conn) {
   
    
    if ($_POST && array_key_exists('__send_form', $_POST)) {

        $table = _TABLE_;

        if (!array_key_exists('id', $_POST)) {

            $sql = "INSERT INTO $table (titulo, valor, valor_original, texto, status, destaque, imagem, imagem2, categoria_id, marca_id, modulo, cor_id, parcelamento, pbusca) "
                    . "VALUES "
                    . "(:titulo, :valor, :valor_original, :texto, :status, :destaque, :imagem, :imagem2, :categoria_id, :marca_id, :modulo, :cor_id, :parcelamento, :pbusca)";
        }

        if (array_key_exists('id', $_POST)) {

            $sql = "UPDATE $table SET "
                    . " titulo = :titulo, valor = :valor, valor_original = :valor_original, texto=:texto, "
                    . " status=:status, destaque=:destaque, imagem= :imagem, imagem2= :imagem2, categoria_id = :categoria_id, marca_id = :marca_id, cor_id = :cor_id,  parcelamento = :parcelamento, pbusca = :pbusca "
                    . "WHERE id = :id";
        }

        $imagem = App_Arquivo::upload('produtos', $_FILES['imagem']);
        $imagem2 = App_Arquivo::upload3('produtos', $_FILES['imagem2']);

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':titulo', filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING));
        $stmt->bindValue(':valor', filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_STRING));
        $stmt->bindValue(':valor_original', filter_input(INPUT_POST, 'valor_original', FILTER_SANITIZE_STRING));
        $stmt->bindValue(':texto', filter_input(INPUT_POST, 'texto', FILTER_SANITIZE_SPECIAL_CHARS));
        $stmt->bindValue(':status', filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT));
        $stmt->bindValue(':destaque', filter_input(INPUT_POST, 'destaque', FILTER_SANITIZE_NUMBER_INT));
        $stmt->bindValue(':categoria_id', filter_input(INPUT_POST, 'categoria_id', FILTER_SANITIZE_NUMBER_INT));
        $stmt->bindValue(':marca_id', filter_input(INPUT_POST, 'marca_id', FILTER_SANITIZE_NUMBER_INT));
        $stmt->bindValue(':cor_id', filter_input(INPUT_POST, 'cor_id', FILTER_SANITIZE_NUMBER_INT));
        $stmt->bindValue(':parcelamento', filter_input(INPUT_POST, 'parcelamento', FILTER_SANITIZE_STRING));
        $stmt->bindValue(':pbusca', filter_input(INPUT_POST, 'pbusca', FILTER_SANITIZE_STRING));
        $stmt->bindValue(':imagem', $imagem);
        $stmt->bindValue(':imagem2', $imagem2);


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