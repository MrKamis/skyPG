<?php
    class ShopRefresher {
        public static function refresh() {
            require_once __DIR__ . '\user.php';
            $user = User::getAllInfo();
            if (time() - $user['lastRefreshShop'] >= 3600) {
                require_once __DIR__ . '\..\database/db.php';
                $conn = Db::getPDO();
                require_once __DIR__ . '\weapon.php';
                require_once __DIR__ . '\armor.php';
                $weapons = [];
                $armors = [];
                for ($i = 0; $i < 5; $i++) {
                    array_push($weapons, new Weapon($user));
                    array_push($armors, new Armor($user));
                }
                $weapons = json_encode($weapons);
                $armors = json_encode($armors);
                $query = $conn->prepare('UPDATE users SET weapons = ?, lastRefreshShop = ?, armors = ? WHERE username = ?');
                $query->bindParam(1, $weapons);
                $time = time();
                $query->bindParam(2, $time);
                $query->bindParam(3, $armors);
                $username = $user['username'];
                $query->bindParam(4, $username);
                $query->execute();
            }
            return true;
        }
    }
?>