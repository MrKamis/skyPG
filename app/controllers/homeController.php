<?php
    class HomeController {
        public function __construct() {
            require_once __DIR__ . '\..\helpers/user.php';
            if (User::isLogged()) {
                header('Location: /profile');
            } else {
                $this->loadView();
            }
        }
        private function loadView() {
            require_once __DIR__ . '\..\views/homeView.phtml';
        }
    }
?>