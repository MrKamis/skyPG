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
                    require_once __DIR__ . '\..\controllers/registerController.php';
                    $controller = new RegisterController($get);
                    break;
                case 'profile':
                    require_once __DIR__ . '\..\controllers/profileController.php';
                    $controller = new ProfileController();
                    break;
                case 'smith':
                    require_once __DIR__ . '\..\controllers/smithController.php';
                    $controller = new SmithController();
                    break;
                case 'transaction':
                    require_once __DIR__ . '\..\controllers/transactionController.php';
                    $controller = new TransactionController($_GET);
                    break;
                case 'equip':
                    require_once __DIR__ . '\..\controllers/equipController.php';
                    if (!isset($_GET['id'])) {
                        return header('Location: \profile');
                    }
                    EquipController::equipItem($_GET['id']);
                    return header('Location: \profile');
                    break;
                case 'dequip':
                    require_once __DIR__ . '\..\controllers/dequipController.php';
                    if (!isset($_GET['id'])) {
                        return header('Location: \profile');
                    }
                    DequipController::dequipItem($_GET['id']);
                    return header('Location: \profile');
                    break;
                case 'sell':
                    if (!isset($_GET['id'])) {
                        return header('Location: \profile');
                    }
                    require_once __DIR__ . '\..\controllers/sellController.php';
                    $controller = new SellController($_GET['id']);
                    break;
                default:

                    break;
            }
            return true;
        }
    }
?>