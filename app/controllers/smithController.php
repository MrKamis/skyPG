<?php
    class SmithController {
        public function __construct() {
            require_once __DIR__ . '\..\helpers/user.php';
            if (!User::isLogged()) {
                header('Location: login');
                return false;
            }
            require_once __DIR__ . '\..\helpers/user.php';
            $this->loadView(User::getAllInfo());
        }
        private function loadView($user) {
            require_once __DIR__ . '\..\views/smithView.phtml';
        }
    }
?>