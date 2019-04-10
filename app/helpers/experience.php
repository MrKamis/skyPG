<?php
    class Experience {
        public static function getExperience() {

        }
        public static function getHTML() {
            require_once __DIR__ . '\user.php';
            $user = User::getAllInfo();
            $level = $user['level'];
            $experience = $user['experience'];
            $nextLevel = round($level * 10 + 10 * 0.8);
            return $experience . '/' . $nextLevel;
        }
        public static function howMuchNextLevel() {

        }
        private static function nextLevel() {
            
        }
    }
?>