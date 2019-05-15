<?php

class App_FileSize {

    static function size($cFile) {
        
        if (file_exists($cFile)) {
            
            $nSize = filesize($cFile);

            if ($nSize < 1024) {

                return strval($nSize) . ' bytes';
            }

            if ($nSize < pow(1024, 2)) {

                return round($nSize / 1024) . ' KB';
            }

            if ($nSize < pow(1024, 3)) {

                return round($nSize / pow(1024, 2)) . ' MB';
            }
            if ($nSize < pow(1024, 4)) {

                return round($nSize / pow(1024, 1)) . ' GB';
            }
        }
    }

}