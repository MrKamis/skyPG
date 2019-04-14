<?php
    class RegisterController {
        public function __construct($get) {
            require_once __DIR__ . '\..\helpers/user.php';
            User::logout();
            if (isset($get['check'])) {
                $valid = true;
                $username = $_POST['username'];
                $password = $_POST['password'];
                $repeatPassword = $_POST['password2'];
                $invalidChars = ['#', '<', '>', ' '];
                for ($i = 0; $i < count($invalidChars); $i++) {
                    if (strpos($username, $invalidChars[$i])) {
                        $valid = false;
                    }
                }
                if ((strlen($password) < 5) || $password != $repeatPassword) {
                    $valid = false;
                }

                if ($valid) {
                    if (User::register($username, $password)) {
                        return header('Location: \profile');
                    } else {
                        return header('Location: \register');
                    }
                } else {
                    return header('Location: \register');
                }
				
            } else {
                $this->loadView();
            }
        }
        private function loadView() {
            require_once __DIR__ . '\..\views/registerView.phtml';
        }
    }
?>
