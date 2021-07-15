<?php
    class Message {
        private $message, $key, $iv, $isAdmin;
        public function __construct($content, $key, $iv, $isAdmin) {
            $this->message = htmlspecialchars($content);
            $this->key = $key;
            $this->iv = $iv;
            $this->isAdmin = $isAdmin;
        }
        public function encrypt() {
            $this->message = htmlspecialchars($this->message);
            $this->message = Scrambler::encrypt($this->message, $this->key, $this->iv);
        }
        public function decrypt() {
            $this->message = Scrambler::decrypt($this->message, $this->key, $this->iv);
            $this->message = htmlspecialchars_decode($this->message);
            return $this->message;
        }
        public function getContent() {
            return $this->message;
        }
        public function getKey() {
            return $this->key;
        }
        public function getIV() {
            return $this->iv;
        }
        public function isAdminMessage() {
            return $this->isAdmin;
        }
        public function sendMessage($id = null) {
            return DB::pushMessage($this, $id);
        }
    }
?>