<?php
    class EquipController {
        public static function equipItem($id) {
            require_once __DIR__ . '\..\helpers/user.php';
            $user = User::getAllInfo();
            $eq = json_decode($user['eq']);
            for ($i = 0; $i < count($eq); $i++) {
                if ($eq[$i]->state == true) {
                    $eq[$i]->state = false;
                }
                if ($eq[$i]->id == $id) {
                    $eq[$i]->state = true;
                }
            }
            User::writeEq($eq);
        }
    }
?>