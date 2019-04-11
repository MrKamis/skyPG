<?php
    class DequipController {
        public static function dequipItem($id) {
            require_once __DIR__ . '\..\helpers/user.php';
            $user = User::getAllInfo();
            $eq = json_decode($user['eq']);
            for ($i = 0; $i < count($eq); $i++) {
                if ($eq[$i]->id == $id) {
                    $eq[$i]->state = false;
                    return User::writeEq($eq);
                }
            }
        }
    }
?>