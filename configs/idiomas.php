<?php

function getCampos($conn, $registro_id, $nome_campo, $style) {

    if (!$registro_id) {
        return;
    }

    $idiomas = listaIdiomas($conn);
    $html = '';

    $c = 1;
    while ($idioma = $idiomas->fetch()) {

        $titulo = $idioma['titulo'];
        $idioma_id = $idioma['id'];
        $modulo = _MODULE_;

        $sql = "SELECT * FROM campos WHERE campo = :campo And modulo = :modulo "
                . " And idioma_id = :idioma_id And registro_id = :registro_id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':campo', $nome_campo, PDO::PARAM_STR);
        $stmt->bindParam(':modulo', $modulo, PDO::PARAM_STR);
        $stmt->bindParam(':idioma_id', $idioma_id, PDO::PARAM_INT);
        $stmt->bindParam(':registro_id', $registro_id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch();
        $texto = null;

        if ($result) {
            $texto = $result['texto'];
        }

        if ($style == 'ckeditor') {
            $html .= '<div>' . $titulo . '<br />
                        <textarea  name="editor[]" rows="10" cols="80" type="text" campo="' . $nome_campo . '" '
                    . ' class="campo_traducao ' . $style . ' " registro_id="' . $registro_id . '" idioma_id="' . $idioma_id . '" modulo="' . $modulo . '">' . $texto . '</textarea>'
                    . '<input type="hidden" name="nome_campo[]" value="' . $nome_campo . '" /><input type="hidden" name="idioma[]" value="' . $idioma_id . '" /> <input type="hidden" name="modulo[]" value="' . $modulo . '" />'
                    . '</div>';
            $c++;
        } else {
            $html .= '<div>' . $titulo . '<br />
                        <input type="text" campo="' . $nome_campo . '" '
                    . ' class="campo_traducao ' . $style . ' " registro_id="' . $registro_id . '" idioma_id="' . $idioma_id . '" modulo="' . $modulo . '" value="' . $texto . '" />
                    </div>';
        }
    }
    return $html;
}

function set_traducao($dados) {

    if (is_null($dados['editor'])) {
        return false;
    }

    global $conn;

    $i = 0;
    foreach ($dados['editor'] as $key => $value) {

        $campo = $dados['nome_campo'][$i];
        $modulo = $dados['modulo'][$i];
        $registro_id = $dados['id'];
        $idioma_id = $dados['idioma'][$i];
        $sql = "SELECT * FROM campos WHERE campo = :campo And modulo = :modulo "
                . " And idioma_id = :idioma_id And registro_id = :registro_id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':campo', $campo, PDO::PARAM_STR);
        $stmt->bindParam(':modulo', $modulo, PDO::PARAM_STR);
        $stmt->bindParam(':idioma_id', $idioma_id, PDO::PARAM_INT);
        $stmt->bindParam(':registro_id', $registro_id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch();

        if ($result) {

            $id = (int) $result['id'];
            $sql = "UPDATE campos SET  texto = :texto WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':texto', $value);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } else {

            $sql = "INSERT INTO campos (campo, modulo, idioma_id, registro_id, texto)"
                    . "VALUES "
                    . "(:campo, :modulo, :idioma_id, :registro_id, :texto)";


            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':campo', $campo, PDO::PARAM_STR);
            $stmt->bindParam(':modulo', $modulo, PDO::PARAM_STR);
            $stmt->bindParam(':idioma_id', $idioma_id, PDO::PARAM_INT);
            $stmt->bindParam(':registro_id', $registro_id, PDO::PARAM_INT);
            $stmt->bindValue(':texto', $value);
            $stmt->execute();
        }
        $i++;
    }
}

function textos($slug) {

    $session_exists = array_key_exists('idioma_id', $_SESSION);
    global $conn;

    if (empty($_SESSION['idioma_id']) || !$session_exists) {

        $sql = "SELECT * FROM menu Where slug = :slug";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':slug', $slug, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch();
        if ($result) {

            return html_entity_decode($result['titulo']);
        }
    }

    $modulo = 'menu';
    $idioma_id = $_SESSION['idioma_id'];
    $sql = "SELECT C.* FROM campos C Inner Join menu M On M.id = C.registro_id WHERE slug = :slug And C.modulo = :modulo "
            . " And C.idioma_id = :idioma_id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':modulo', $modulo, PDO::PARAM_STR);
    $stmt->bindParam(':idioma_id', $idioma_id, PDO::PARAM_INT);
    $stmt->bindParam(':slug', $slug, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch();

    if ($result) {
        return ($result['texto']);
    }

    return html_entity_decode($obj[$campo]);
}


function menu($slug) {

    $session_exists = array_key_exists('idioma_id', $_SESSION);
    global $conn;

    if (empty($_SESSION['idioma_id']) || !$session_exists) {

        $sql = "SELECT * FROM menu Where slug = :slug";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':slug', $slug, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch();
        if ($result) {

            return ($result['titulo']);
        }
    }

    $modulo = 'menu';
    $idioma_id = $_SESSION['idioma_id'];
    $sql = "SELECT C.* FROM campos C Inner Join menu M On M.id = C.registro_id WHERE slug = :slug And C.modulo = :modulo "
            . " And C.idioma_id = :idioma_id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':modulo', $modulo, PDO::PARAM_STR);
    $stmt->bindParam(':idioma_id', $idioma_id, PDO::PARAM_INT);
    $stmt->bindParam(':slug', $slug, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch();

    if ($result) {
        return ($result['texto']);
    }

    return html_entity_decode($obj[$campo]);
}

function l($obj, $campo) {

    $session_exists = array_key_exists('idioma_id', $_SESSION);

    if (empty($_SESSION['idioma_id']) || !$session_exists) {
        return html_entity_decode($obj[$campo]);
    }

    global $conn;

    $modulo = $obj['modulo'];
    $registro_id = $obj['id'];
    $idioma_id = $_SESSION['idioma_id'];
    $sql = "SELECT * FROM campos WHERE campo = :campo And modulo = :modulo "
            . " And idioma_id = :idioma_id And registro_id = :registro_id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':campo', $campo, PDO::PARAM_STR);
    $stmt->bindParam(':modulo', $modulo, PDO::PARAM_STR);
    $stmt->bindParam(':idioma_id', $idioma_id, PDO::PARAM_INT);
    $stmt->bindParam(':registro_id', $registro_id, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch();
    if ($result) {
        return ($result['texto']);
    }

    return html_entity_decode($obj[$campo]);
}

function listaIdiomas($conn) {

    $stmt = $conn->prepare("SELECT * FROM idiomas Order By titulo ASC");
    $stmt->execute();
    return $stmt;
}
