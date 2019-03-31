<?php
    class ProfileController {
        public function __construct() {
            require_once __DIR__ . '\..\helpers/user.php';
            if (User::isLogged()) {
                $this->loadView();
                return true;
            } else {
                header('Location: /login');
            }
        }
        private function loadView() {
            require_once __DIR__ . '\..\views/profile.phtml';
        }
    }
?>