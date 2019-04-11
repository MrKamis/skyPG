<?php
    class SellController {
        public function __construct($id) {
            $this->loadView($id);
        }
        private function loadView($id) {
            require_once __DIR__ . '\..\helpers\user.php';
            $user = User::getAllInfo();
            $eq = json_decode($user['eq']);
            $item;
            for ($i = 0; $i < count($eq); $i++) {
                if ($eq[$i]->id == $id) {
                    $item = $eq[$i];
                    break;
                }
            }
            require_once __DIR__ . '\..\views/sellView.phtml';
        }
    }
?>