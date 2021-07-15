<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="<?php echo CSS . 'main.css'; ?>" />
    <script src="<?php echo JS . 'jquery-min.js'; ?>"></script>
    <script src="<?php echo JS . 'main.js'; ?>"></script>
</head>
<body>
    <div class="chat-form">
        <div class="messages-wrapper">
            <div class="message-recipient">
                <p class="message-recipient-text">Администратор</p>
            </div>
            <div class="messages-place">
                <div class="message-body recipient">
                    <p class="message-text recipient-text">Lorem ipsum dolar sit amet</p>
                </div>
                <div class="message-body user">
                    <p class="message-text user-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>
            <textarea name="message" class="message-field message-textarea" placeholder="Введите сообщение..." oninput="messager.checkInput(this);"></textarea>
            <button class="send-message block-button" onclick="messager.submit()">Отправить сообщение</button>
        </form>
    </div>
    <script>
        messager.view();
        messager.listen();
    </script>
</body>
</html>