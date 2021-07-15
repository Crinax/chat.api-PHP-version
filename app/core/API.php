<?php
    class API {
        public static function pushMessage() {
            if (!empty($_POST)) {
                $content = $_POST['content'];
                $uid = $_POST['uid'];
                $isAdmin = isset($_POST['isAdmin']) ? $_POST['isAdmin'] : false;
                $user = DB::getUser($uid);
                $message = new Message($content, $user['secret'], $user['iv'], $isAdmin);
                $result = $message->sendMessage($uid);
                echo json_encode(['result' => $result]);
            }
            else {
                echo json_encode(['status' => 'error']);
            }
        }
        private static function getFormateMessages($id) {
            $messages = DB::getMessagesFrom($id);
            $user = DB::getUser($id);
            foreach ($messages as $key => $message) {
                $obj = new Message($message['content'], $user['secret'], $user['iv'], $message['isAdmin']);
                $obj->decrypt();
                $messages[$key]['content'] = $obj->getContent();
            }
            return $messages;
        }
        public static function getMessages() {
            if (isset($_POST['uid'])) {
                $messages = self::getFormateMessages($_POST['uid']);
                echo json_encode($messages);
            }
            else {
                echo json_encode(['status' => 'error']);
            }
        }
        public static function getUsers() {
            $result = DB::getAllUsers();
            echo json_encode($result);
        }
        public static function getCurrentUser() {
            if (isset($_POST['id'])) {
                $result = DB::getCurrentUser();
                $result = ['uid' => $result['id']];
                echo json_encode($result);
            }
            else {
                echo json_encode(['status' => 'error']);
            }
        }
        public static function getLastMessage() {
            if (isset($_POST['uid'])) {
                $messages = self::getFormateMessages($_POST['uid']);
                echo json_encode($messages[count($messages)-1]);
            }
            else {
                echo json_encode(['status' => 'error']);
            }
        }
        public static function test() {
            echo 'Nothing to see here...';
        }
    }
?>