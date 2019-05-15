<?php

class Moeda {

    static function formValorFront($valor) {

        if ($_SESSION['lang'] != 'pt') {
            $mbase = 1;
            $valor = ( $mbase / $_SESSION['valor_dolar'] * $valor);
        }
        return $valor;
    }

    static function formatToDb($valor) {

        if (!empty($valor)) {

            $novovalor = str_replace(".", "", $valor);
            $novovalor2 = str_replace(",", ".", $novovalor);
            return $novovalor2;
        }
        else
            return false;
    }

    static function formatToPt($valor) {

        if (!empty($valor)) {
            return number_format($valor, 2, ',', '.');
        }
        else
            return false;
    }

}