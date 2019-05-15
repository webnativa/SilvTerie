<?php

class Consult {

    private $last_id;

    function insert($table, $postData = array()) {

        $q = "DESC $table";
        $q = mysql_query($q);

        $getFields = array();

        while ($field = mysql_fetch_array($q)) {
            $getFields[sizeof($getFields)] = $field['Field'];
        }

        $fields = "";
        $values = "";

        if (sizeof($getFields) > 0) {
            foreach ($getFields as $k) {
                if (isset($postData[$k])) {
                    $postData[$k] = htmlspecialchars($postData[$k]);

                    $fields .= "`$k`, ";
                    $values .= "'$postData[$k]', ";
                }
            }

            $fields = substr($fields, 0, strlen($fields) - 2);
            $values = substr($values, 0, strlen($values) - 2);

            $insert = "INSERT INTO $table ($fields) VALUES ($values)";

            if (mysql_query($insert)) {

                $this->last_id = mysql_insert_id();

                return true;
            } else {

                echo mysql_error();
                return false;
            }
        } else {
            return false;
        }
    }

    function last_id() {

        return $this->last_id;
    }

    function update($table, $postData = array(), $conditions = array()) {

        $q = "DESC $table";
        $q = mysql_query($q);

        $getFields = array();

        while ($field = mysql_fetch_array($q)) {
            $getFields[sizeof($getFields)] = $field['Field'];
        }

        $values = "";
        $conds = "";

        if (sizeof($getFields) > 0) {
            foreach ($getFields as $k) {
                if (isset($postData[$k])) {
                    $postData[$k] = htmlspecialchars($postData[$k]);

                    $values .= "`$k` = '$postData[$k]', ";
                }
            }

            $values = substr($values, 0, strlen($values) - 2);

            foreach ($conditions as $k => $v) {
                $v = htmlspecialchars($v);

                $conds .= "`$k` = '$v'";
            }

            $update = "UPDATE $table SET $values WHERE $conds";

            if (mysql_query($update)) {
                return true;
            } else {
                echo mysql_error();
                return false;
            }
        } else {
            return false;
        }
    }

    function delete($table, $conditions = array()) {
        $conds = null;
        foreach ($conditions as $k => $v) {

            $v = htmlspecialchars($v);

            $conds .= " $k =  $v ";
        }

        $delete = "DELETE FROM $table WHERE $conds";

        if (mysql_query($delete)) {
            return true;
        } else {
            echo mysql_error();
            return false;
        }
    }

}
