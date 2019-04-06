<?php
    class Db {
        public static function getPDO() {
            $pdo = new PDO('sqlite:' . __DIR__ . '\database.sqlite');
            return $pdo;
        }
        private function createTables() {
            $pdo = self::getPDO();
            $query = $pdo->prepare('CREATE TABLE `users` (
                `id` INTEGER PRIMARY KEY AUTOINCREMENT, 
                `username` TEXT UNIQUE, `password` TEXT, 
                `eq` TEXT DEFAULT "[]", 
                `messages` TEXT DEFAULT "[]", 
                `history` TEXT DEFAULT "[]", 
                `coins` INTEGER DEFAULT 100, 
                `level` INTEGER DEFAULT 1, 
                `statistics` TEXT DEFAULT `{ "strength": 15, "health": 100, "critical": 5, "block": 5, "luck": 5 }`, 
                `race` TEXT, 
                `desc` TEXT DEFAULT "", 
                `banned` INTEGER DEFAULT 0,
                `ranking` INTEGER DEFAULT 0)');
        $query->execute();
        }
    }
?>