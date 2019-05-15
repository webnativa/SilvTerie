<?php
/* Informa o nível dos erros que serão exibidos */
error_reporting(E_ALL);

/* Habilita a exibição de erros */
ini_set("display_errors", 0);

$url = "www.silvterie.com.br";

define('_AUTOR_', "Web Nativa");
define('_CREDITOS_', "NATIVA - Gerenciador de conteúdo");
define('_NOME_SITE_', "SilvTerie");
define('_EMAIL_CONTATO_', "contato@webnativa.com");

define('_STATIC_FILES_', 'https://' . $url . "/public/");
define('_MEDIA_FILES_', 'https://' . $url . "/public/uploads");
define('_SITE_URL_', 'https://' . $url);
define('_ADMIN_URL_', 'nativa');
define('_REGISTROS_POR_PAGINA_', '6');
define('_REGISTROS_UNIDADES_', '30');
define('_REGISTROS_BUSCA_', '200');

define('_SALT_', 'i%0*1^gt6iy$)td%=z*87&4fJjj+x5g=04e&yu&72fr=2&m&vn');

$dsn = 'mysql:host=192.185.223.20;dbname=silvteri_site';
$user = 'silvteri_site';
$password = 'webnet12';

try {

    $conn = new PDO($dsn, $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("set names utf8");
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}
