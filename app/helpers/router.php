<?php
    class Router {
        public static function route($get) {
            $page = 'error';
            if (isset($get['page']) && $get != '') {
                $page = $get['page'];
            }
            switch ($page) {
                case 'home':
                    require_once __DIR__ . '\..\controllers/homeController.php';
                    $controller = new HomeController();
                    break;
                case 'login':
                    require_once __DIR__ . '\..\controllers/loginController.php';
                    $controller = new LoginController($get);
                    break;
                case 'register':

                    break;
                case 'profile':
                    require_once __DIR__ . '\..\controllers/profileController.php';
                    $controller = new ProfileController();
                    break;
                default:

                    break;
            }
            return true;
        }
    }
?>