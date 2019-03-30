<?php
    class LoginController {
        public function __construct($get) {
            require_once __DIR__ . '\..\helpers/user.php';
            User::logout();
            if (isset($get['action'])) {
                if (isset($_POST['username']) && isset($_POST['password']) && $_POST['username'] != '' && $_POST['password'] != '') {
                    require_once __DIR__ . '\..\helpers/user.php';
                    if (!User::tryLogin($_POST['username'], $_POST['password'])) {
                        $this->loadView('Błędne dane!');
                        return false;
                    } else {
                        header('Location: /profile');
                        return true;
                    }
                } else {
                    $this->loadView('Musisz wypełnić wszystkie pola!');
                    return false;
                }
            }
            $this->loadView();
        }
        private function loadView($error = false) {
            require_once __DIR__ . '\..\views/loginView.phtml';
        }
    }
?>