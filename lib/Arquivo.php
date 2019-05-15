<?php

class App_Arquivo {

    static function extension($fileName) {

        preg_match("/\.(gif|bmp|png|jpg|jpeg|mp3|doc|txt|pdf|swf|odt|docx|csv){1}$/i", $fileName["name"], $ext);

        if (!empty($fileName))
            return "." . strtolower($ext[1]);
        else {

            return null;
        }
    }

    static public function uploadFront($folder, $file, $prefix = false) {

        if (empty($file['name'])) {
            return $_POST['__imagem'];
        }

        $arquivo = isset($file) ? $file : false;
        $arquivoNome = $file['name'];

        if (!empty($arquivoNome)) {

            $extensao = App_Arquivo::extension($file);
            $imagem_nome = $prefix . "_" . uniqid() . $extensao;

            $imagem_dir = "public/uploads/" . $folder . "/" . $imagem_nome;
            move_uploaded_file($arquivo["tmp_name"], $imagem_dir);

            return $imagem_nome;
        } else {
            return $_POST['__imagem'];
        }
    }

    static public function upload($folder, $file, $prefix = false) {

        if (empty($file['name'])) {
            return $_POST['__imagem'];
        }

        $arquivo = isset($file) ? $file : false;
        $arquivoNome = $file['name'];

        if (!empty($arquivoNome)) {

            $extensao = App_Arquivo::extension($file);
            $imagem_nome = $prefix . "_" . uniqid() . $extensao;

            $imagem_dir = "../../public/uploads/" . $folder . "/" . $imagem_nome;
            move_uploaded_file($arquivo["tmp_name"], $imagem_dir);

            return $imagem_nome;
        } else {
            return $_POST['__imagem'];
        }
    }

    static public function upload3($folder, $file, $prefix = false) {

        if (empty($file['name'])) {
            return $_POST['__imagem2'];
        }

        $arquivo = isset($file) ? $file : false;
        $arquivoNome = $file['name'];

        if (!empty($arquivoNome)) {

            $extensao = App_Arquivo::extension($file);
            $imagem_nome = $prefix . "_" . uniqid() . $extensao;

            $imagem_dir = "../../public/uploads/" . $folder . "/" . $imagem_nome;
            move_uploaded_file($arquivo["tmp_name"], $imagem_dir);

            return $imagem_nome;
        } else {
            return $_POST['__imagem2'];
        }
    }

    static public function upload2($folder, $file, $prefix = false) {

        $arquivo = isset($file) ? $file : false;

        $arquivoNome = $file['name'];

        if (!empty($arquivoNome)) {

            $extensao = App_Arquivo::extension($file);
            $imagem_nome = $prefix . "_" . uniqid() . $extensao;

            $imagem_dir = "public/uploads/" . $folder . "/" . $imagem_nome;
            move_uploaded_file($arquivo["tmp_name"], $imagem_dir);

            return $imagem_nome;
        } else
            return false;
    }

    static function extensionString($fileName) {

        preg_match("/\.(gif|bmp|png|jpg|jpeg|mp3|swf|doc|txt|pdf|docx|csv){1}$/i", $fileName, $ext);

        if (!empty($fileName) && isset($ext[1]))
            return "." . strtolower($ext[1]);
        else
            return null;
    }

    static function folder($folder) {

        $novo_dir = "../../public/uploads/" . $folder;

        if (!file_exists($novo_dir)) {

            mkdir($novo_dir, 0777);
            chmod($novo_dir, 0777);
        }
    }

}
