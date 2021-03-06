<?php
    /**
    * Class of User
    */
    class User {
        /**
        * Check is user logged
        * @return boolean
        */
        public static function isLogged() {
            session_start();
            if (isset($_SESSION['username']) && $_SESSION['logged']) {
                session_write_close();
                return true;
            }
            session_write_close();
            return false;
        }
        public static function tryLogin($username, $password) {
            self::logout();
            require_once __DIR__ . '\..\database/db.php';
            $conn = Db::getPDO();
            $query = $conn->prepare('SELECT * FROM users WHERE username LIKE ? AND password LIKE ?');
            $query->bindParam(1, $username);
            $password = crypt($password, $username);
            $query->bindParam(2, $password);
            $query->execute();
            $result = $query->fetchAll();
            if (count($result) == 0) {
                return false;
            }
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['logged'] = true;
            $_SESSION['time'] = time();
            session_write_close();
            return true;
        }
        public static function logout() {
            session_start();
            session_destroy();
            session_write_close();
        }
        public static function getPublicInfo($username) {
            require_once __DIR__ . '\..\database/db.php';
            $conn = Db::getPDO();
            $query = $conn->prepare('SELECT username, level, statistics, race, desc, eq FROM users WHERE username LIKE ?');
            $query->bindParam(1, $username);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        public static function getAllInfo() {
            require_once __DIR__ . '\..\database/db.php';
            $conn = Db::getPDO();
            $query = $conn->prepare('SELECT * FROM users WHERE username LIKE ?');
            session_start();
            $query->bindParam(1, $_SESSION['username']);
            session_write_close();
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result[0];
        }
        public static function getAllUsers() {
            require_once __DIR__ . '\..\database/db.php';
            $conn = Db::getPDO();
            $query = $conn->prepare('SELECT username, level, ranking, statistics, eq FROM users ORDER BY ranking');
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result[0];
        }
        public static function writeEq($eq) {
            require_once __DIR__ . '\..\database/db.php';
            $conn = Db::getPDO();
            $query = $conn->prepare('UPDATE users SET eq = ? WHERE username = ?');
            $eq = json_encode($eq);
            $query->bindParam(1, $eq);
            $username = self::getAllInfo()['username'];
            $query->bindParam(2, $username);
            $query->execute();
        }
        public static function register($username, $password) {
            require_once __DIR__ . '\..\database/db.php';
            $conn = Db::getPDO();
            $query = $conn->prepare('INSERT INTO users(username, password) VALUES(?, ?)');
            $query->bindParam(1, $username);
            $passwordC = crypt($password, $username);
            $query->bindParam(2, $passwordC);
            if ($query->execute()) {
                self::tryLogin($username, $password);
                return true;
            } else {
                return false;
            }
        }
    }
?>