<?php
    class InputValidation {
        public static function check($string, $array) {
            for ($i = 0; $i < count($array); $i++) {
                if (strpos($string, $array[$i])) {
                    return false;
                }
            }
            return true;
        }
    }
?>