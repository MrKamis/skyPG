<?php
    class Message {
        public $from;
        public $to;
        public $topic;
        public $content;
        public $date;
        public function sendMessage(){}
        public static function getAllMessages($user){}
    }
?>