<?php
    class EquipController {
        public static function equipItem($id) {
            require_once __DIR__ . '\..\helpers/user.php';
            $user = User::getAllInfo();
            $eq = json_decode($user['eq']);
            $type;
            $x;
            for ($i = 0; $i < count($eq); $i++) {
                if ($eq[$i]->id == $id) {
                    $eq[$i]->state = true;
                    $type = $eq[$i]->type;
                    $x = $i;
                    break;
                }
            }
            for ($i = 0; $i < count($eq); $i++) {
                if ($i != $x && $eq[$i]->type == $type) {
                    $eq[$i]->state = false;
                }
            }
            User::writeEq($eq);
        }
    }
?>