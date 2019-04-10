<?php
    class TransactionController {
        public function __construct($get) {
            $type = $get['type'];
            $id = $get['id'];
            require_once __DIR__ . '\..\helpers/user.php';
            $user = User::getAllInfo();
            if ($type == 'weapon') {
                $weapons = json_decode($user['weapons']);
                for ($i = 0; $i < count($weapons); $i++) {
                    if ($weapons[$i]->id == $id) {
                        $weapon = $weapons[$i];
                        if ($user['coins'] >= $weapon->value) {
                            $user['coins'] = $user['coins'] - $weapon->value;
                            $eq = json_decode($user['eq']);
                            array_push($eq, $weapon);
                            $weapons[$i] = $weapons[count($weapons) - 1];
                            array_pop($weapons);
                            $weapons = json_encode($weapons);
                            require_once __DIR__ . '\..\database/db.php';
                            $conn = Db::getPDO();
                            $query = $conn->prepare('UPDATE users SET eq = ?, coins = ?, weapons = ? WHERE username = ?');
                            $eq = json_encode($eq);
                            $query->bindParam(1, $eq);
                            $query->bindParam(2, $user['coins']);
                            $query->bindParam(3, $weapons);
                            $query->bindParam(4, $user['username']);
                            $query->execute();
                            header('Location: \smith');
                            return;
                        } else {
                            echo '<div class="text-center p-3"><h3 class="text-danger">Nie masz na tyle gotowki!!</h3></div>';
                            return;
                        }
                    }
                }
                header('Location: \smith');
            } else {
                $armors = json_decode($user['armors']);
                for ($i = 0; $i < count($armors); $i++) {
                    if ($armors[$i]->id == $id) {
                        $armor = $armors[$i];
                        if ($user['coins'] >= $armor->value) {
                            $user['coins'] = $user['coins'] - $armor->value;
                            $eq = json_decode($user['eq']);
                            array_push($eq, $armor);
                            $armors[$i] = $armors[count($armors) - 1];
                            array_pop($armors);
                            $armors = json_encode($armors);
                            require_once __DIR__ . '\..\database/db.php';
                            $conn = Db::getPDO();
                            $query = $conn->prepare('UPDATE users SET eq = ?, coins = ?, armors = ? WHERE username = ?');
                            $eq = json_encode($eq);
                            $query->bindParam(1, $eq);
                            $query->bindParam(2, $user['coins']);
                            $query->bindParam(3, $armors);
                            $query->bindParam(4, $user['username']);
                            $query->execute();
                            header('Location: \smith');
                            return;
                        } else {
                            echo '<div class="text-center p-3"><h3 class="text-danger">Nie masz na tyle gotowki!!</h3></div>';
                            return;
                        }
                    }
                }
            }
        }
    }
?>