<?php
    class TransactionController {
        public function __construct($get) {
            $type = $get['type'];
            $id = $get['id'];
            require_once __DIR__ . '\..\helpers/user.php';
            $user = User::getAllInfo();
            if ($type == 'weapon') {
                $weapons = json_decode($user['weapons']);
                for ($i = 0; $i < 5; $i++) {
                    if ($weapons[$i]->id == $id) {
                        $weapon = $weapons[$i];
                        if ($user['coins'] >= $weapon->value) {
                            $user['coins'] = $user['coins'] - $weapon->value;
                            $eq = json_decode($user['eq']);
                            array_push($eq, $weapon);
                            require_once __DIR__ . '\..\database/db.php';
                            $conn = Db::getPDO();
                            $query = $conn->prepare('UPDATE users SET eq = ?, coins = ? WHERE username = ?');
                            $eq = json_encode($eq);
                            $query->bindParam(1, $eq);
                            $query->bindParam(2, $user['coins']);
                            $query->bindParam(3, $user['username']);
                            $query->execute();
                            return;
                        } else {
                            echo '<h3 class="text-warning">Nie masz na tyle gotowki!!</h3>';
                            return;
                        }
                    }
                }
                echo '<h3 class="text-warning">Nie znaleziono takiej broni!</h3>';
            } else {

            }
        }
    }
?>