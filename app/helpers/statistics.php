<?php
    class Statistics {
        public $strength;
        public $health;
        public $block;
        public $critical;
        public $luck;
        public $quality;
        public function __construct($levelOfUser, $quality = false) {
            if (!$quality) {
                $quality = random_int(1, 4);
            }
            $this->quality = $quality;
            $this->strength = random_int(-2, 2) + $levelOfUser * $quality;
            $this->health = random_int(-1, 5) + $levelOfUser * $quality;
            $this->block = random_int(-1, 0.2) + $levelOfUser * $quality;
            $this->critical = random_int(-1, 0.2) + $levelOfUser * $quality;
            $this->luck = random_int(-3, 1) + $levelOfUser * $quality;
        }
    }
?>