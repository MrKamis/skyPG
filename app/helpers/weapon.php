<?php
    class Weapon {
        public static function generateWeapon($user) {
            return new Weapon($user);
        }
        public $name;
        public $type = 'broń';
        public $statistics;
        public $state;
        public $quality;
        private $types = ['drewniany', 'elficki', 'orkowy', 'deadrowy', 'ebonowy', 'smoczy'];
        private $names = ['miecz', 'kostur', 'ostrze', 'topór', 'sztylet', 'kilof', 'łuk', 'młot'];
        public function __construct($user) {
            require_once __DIR__ . '\statistics.php';
        }
    }
?>