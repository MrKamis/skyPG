<?php
    class User {
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
    }
?>