<?php
    class Weapon {
        public $id;
        public $name;
        public $type = 'broń';
        public $statistics;
        public $state;
        public $typeOfWeapon;
        public $quality;
        public $value;
        public $HTMLQuality;
        private $types = ['drewniany', 'elficki', 'orkowy', 'deadrowy', 'ebonowy', 'smoczy'];
        private $names = ['miecz', 'kostur', 'ostrze', 'topór', 'sztylet', 'kilof', 'łuk', 'młot'];
        public function __construct($user) {
            $this->id = random_int(1, 99999);
            require_once __DIR__ . '\statistics.php';
            $this->quality = random_int(1, 5);
            $this->statistics = new Statistics($user['level'], $this->quality);
            $this->name = $this->names[random_int(0, 7)];
            $this->typeOfWeapon = $this->types[random_int(0, 5)];
            $this->state = false;
            $this->setQualityInHTML();
            $this->value = round($this->statistics->health + $this->statistics->strength * 1.1 + $this->statistics->luck * 1.3 + $this->statistics->block * 1.2 + $this->statistics->critical * 1.2 + $this->quality);
        }
        private function setQualityInHTML() {
            switch ($this->quality) {
                case 1:
                    $this->HTMLQuality = '<span>pospolity</span>';
                    break;
                case 2:
                    $this->HTMLQuality = '<span class="text-primary">rzadki</span>';
                    break;
                case 3:
                    $this->HTMLQuality = '<span class="text-warning">epicki</span>';
                    break;
                case 4:
                    $this->HTMLQuality = '<span class="text-danger">legendarny</span>';
                    break;
                case 5:
                    $this->HTMLQuality = '<span class="text-success">magiczny</span>';
                    break;
            }
        }
        public static function write($tableOfWeapons) {
            require_once __DIR__ . '\..\database\db.php';
            $conn = Db::getPDO();
            $query = $conn->prepare('UPDATE users SET weapons = ? WHERE username = ?');
            $weapons = json_encode($tableOfWeapons);
            $query->bindParam(1, $weapons);
            require_once __DIR__ . '\..\helpers/user.php';
            $username = User::getAllInfo()['username'];
            $query->bindParam(2, $username);
            $query->execute();
        }
    }
?>