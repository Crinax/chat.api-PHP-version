<?php
    class DB {
        static private $db;
        public static function connect() {
            self::$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if (self::$db === false) {
                echo 'Error DB connection';
            }
        }
        public static function getAllUsers() {
            $query = "SELECT `id`, `isAdmin` FROM `users`";
            $result = self::$db->query($query);
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        public static function getMessagesFrom($id) {
            $query = "SELECT * FROM `messages` WHERE `userId` = '{$id}' ORDER BY `timestamp` ASC";
            $result = self::$db->query($query);
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        public static function getUser($id) {
            $query = "SELECT * FROM `users` WHERE `id` = '{$id}'";
            $result = self::$db->query($query);
            return $result->fetch_all(MYSQLI_ASSOC)[0];
        }
        public static function getCurrentUser() {
            if (isset($_COOKIE['uid'])) {
                $uid = $_COOKIE['uid'];
                $result = self::$db->query("SELECT * FROM `users` WHERE `id` = '{$uid}'");
                $result = $result->fetch_all(MYSQLI_ASSOC);
                $result = $result[0];
                return $result;
            }
            else {
                $uid = Scrambler::generateUid();
                $key = Scrambler::generateKey();
                $iv = Scrambler::generateIV();
                $result = self::$db->query("INSERT INTO `users` (`id`, `isAdmin`, `secret`, `iv`) VALUES ('{$uid}', false, '{$key}', '{$iv}')");
                if ($result) {
                    $eventName = md5($uid);
                    $result = self::$db->query("CREATE EVENT `{$eventName}-event` ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL 30 DAY DO DELETE FROM `users` WHERE `id` = '{$uid}'");
                    if ($result) {
                        setcookie('uid', $uid, time()+30*24*3600, '/');
                        $user = self::$db->query("SELECT * FROM `users` WHERE `id` = '{$uid}'");
                        $user = $user->fetch_all(MYSQLI_ASSOC);
                        $user = $user[0];
                        return $user;
                    }
                    else {
                        return ['status' => 'error', 'message' => self::$db->error];
                    }
                }
                else {
                    return ['status' => 'error', 'message' => self::$db->error];
                }
            }
        }
        public static function pushMessage($message, $id) {
            if (gettype($message) == 'object') {
                if (get_class($message) == 'Message') {
                    $message->encrypt();
                    $isAdmin = $message->isAdminMessage() ? 'true' : 'false';
                    $query = "INSERT INTO `messages` (`userId`, `isAdmin`, `content`) VALUES ('{$id}', {$isAdmin}, '{$message->getContent()}')";
                    $result = self::$db->query($query);
                    if (!$result) {
                        return ['error' => self::$db->error];
                    }
                    else { return $result; }
                }
                else {
                    throw 'Push Error: parameter must be Message type';
                }
            }
            else {
                throw 'Push Error: parameter must be Message type';
            }
        }
    }
    DB::connect();
?>