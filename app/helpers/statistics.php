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
        public static function getStatisticsWithEq($username) {
            require_once __DIR__ . '\user.php';
            $user = User::getPublicInfo($username);
            if (empty($user)) {
                return header('Location: \profile');
            }
            $user = $user[0];
            $statistics = json_decode($user['statistics']);
            $eq = json_decode($user['eq']);
            $weapon;
            $armor;
            for ($i = 0; $i < count($eq); $i++) {
                if ($eq[$i]->type == 'broń' && $eq[$i]->state == true) {
                    $weapon = $eq[$i];
                } else if ($eq[$i]->type == 'pancerz' && $eq[$i]->state == true) {
                    $armor = $eq[$i];
                }
            }
            if (@$weapon) {
                $statistics->strength += $weapon->statistics->strength;
                $statistics->health += $weapon->statistics->health;
                $statistics->critical += $weapon->statistics->critical;
                $statistics->block += $weapon->statistics->block;
                $statistics->luck += $weapon->statistics->luck;
            }
            if (@$armor) {
                $statistics->strength += $armor->statistics->strength;
                $statistics->health += $armor->statistics->health;
                $statistics->critical += $armor->statistics->critical;
                $statistics->block += $armor->statistics->block;
                $statistics->luck += $armor->statistics->luck;
            }
            return $statistics;
        }
        public static function howMuchCost($value, $skill, $level) {
            switch ($skill) {
                //strength
                case 0:
                    return round($value * $level * 0.1 + 5);
                    break;
                //health
                case 1:
                    return round($value * $level * 0.01 + 5);
                    break;
                //critical
                case 2:
                    return round($value * $level * 0.25 + 5);
                    break;
                //block
                case 3:
                    return round($value * $level * 0.25 + 5);
                    break;
                //luck
                case 4:
                    return round($value * $level * 0.75 + 5);
                    break;
            }
            return false;
        }
    }
?>