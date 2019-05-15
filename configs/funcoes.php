<?php

function bool($obj) {
    if ($obj) {
        return '<span class="label label-success arrowed">Ativo</span>';
    }

    return '<span class="label label-danger arrowed-in">Inativo</span>';
}

function posicao($obj, $id) {
    return '<input class="position_control center" type="number" pk="' . $id . '" value="' . $obj . '" />';
}

function texto($obj) {
    return $obj;
}

function imagem($obj, $pasta) {

    $local = _MEDIA_FILES_;
    $img = "<img src='../imagens/thumb.php?imagem=$pasta/$obj&x=150&y=110' width='90' height='70' class='img_loop' />";
    return $img;
}

function tipo_fiel($obj, $tipo, $id = false, $pasta = null) {
    
    if ($tipo == 'imagem') {
        return $tipo($obj, $pasta);
    }
    
    if ($tipo == 'posicao') {
        return $tipo($obj, $id);
    } 
    return $tipo($obj);
    
}

function getLastPathSegment() {
    $url = $_SERVER['REQUEST_URI'];
    $path = parse_url($url, PHP_URL_PATH); // to get the path from a whole URL
    $pathTrimmed = trim($path, '/'); // normalise with no leading or trailing slash
    $pathTokens = explode('/', $pathTrimmed); // get segments delimited by a slash

    if (substr($path, -1) !== '/') {
        array_pop($pathTokens);
    }
    return end($pathTokens); // get the last segment
}

function field_form($value) {

    if ($value == NULL) {
        return null;
    }
    return $value;
}

function curPageURL() {
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {
        $pageURL .= "s";
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

define('_MODULE_REFERENCE_', getLastPathSegment());
