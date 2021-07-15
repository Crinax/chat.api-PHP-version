class Messages {
    constructor() {
        this.uid;
        this.messages;
        this.lastMessage;
        this.intervalId;
        $.ajax({
            url: '/api/get-current-user/',
            method: 'POST',
            datatype: 'json',
            data: {id: Math.random()},
            async: false,
        }).done((data) => {
            this.uid = JSON.parse(data);
        });
        this.uid = this.uid['uid'];
        this.getMessages();
        this.lastMessage = this.getLasMessage();
    }
    getLasMessage() {
        var message;
        $.ajax({
            url: '/api/message/',
            method: 'POST',
            datatype: 'json',
            data: {uid: this.uid},
            async: false,
        }).done((data) => {
            message = JSON.parse(data);
        });
        return message;
    }
    getMessages() {
        $.ajax({
            url: '/api/get-messages/',
            method: 'POST',
            datatype: 'json',
            data: {uid: this.uid},
            async: false,
        }).done((data) => {
            this.messages = JSON.parse(data);
        });
    }
    view() {
        $('.messages-place').empty();
        for (let message of this.messages) {
            this.appendMessage(message);
        }
    }
    submit() {
        if (!$('.send-message').hasClass('block-button')) {
            var text = $('.message-textarea').val();
            $.ajax({
                url: '/api/push-message/',
                method: 'POST',
                datatype: 'json',
                data: {content: text, uid: this.uid},
                async: false
            }).done((data) => {
                $('.message-textarea').val('');
                this.checkInput(document.querySelector('.message-textarea'));
            });
        }
        else {
            alert('Введите сообщение!');
        }
    }
    checkInput(el) {
        var text = el.value;
        if (text.length == 0) {
            $('.send-message').toggleClass('block-button', true);
        }
        else {
            $('.send-message').toggleClass('block-button', false);
        }
    }
    appendMessage(message) {
        $('.messages-place').append(`
            <div class="message-body ${message['isAdmin'] == '0' ? 'recipient' : 'user'} message-id-${message['id']}">
                <p class="message-text ${message['isAdmin'] == '1' ? 'recipient' : 'user'}-text  message-id-${message['id']}-text">${message['content']}</p>
            </div>
        `);
    }
    listen() {
        if (this.intervalId == undefined) {
            this.intervalId = setInterval(() => {
                var message = this.getLasMessage();
                if (JSON.stringify(message) != JSON.stringify(this.lastMessage)) {
                    this.lastMessage = message;
                    this.appendMessage(this.lastMessage);
                }
            }, 500);
        }
        else {
            throw 'Listening already'
        }
        
    }
    closeLisening() {
        if (this.intervalId != undefined) {
            clearInterval(this.intervalId);
            this.intervalId = undefined;
        }
        else {
            throw 'Listening already closed.'
        }
    }
}
var messager = new Messages();