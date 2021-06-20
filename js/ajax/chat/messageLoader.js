function MessageLoader(){}

MessageLoader.DEFAUL_METHOD = 'GET';
MessageLoader.WRITE_METHOD = 'POST';
MessageLoader.URL_READ_REQUEST = './ajaxChat/messageLoader.php';
MessageLoader.URL_WRITE_REQUEST = './ajaxChat/messageWriter.php';
MessageLoader.ASYNC_TYPE = true;

MessageLoader.ALL_MESSAGES = 0;
MessageLoader.NEW_MESSAGES = 1;
MessageLoader.COUNT_NEW_MESSAGES = 2;

MessageLoader.SUCCESS_RESPONSE = "0";
MessageLoader.NO_MORE_DATA = "-1";

MessageLoader.loadMessages = function(username, searchType, responseFunction){
    var querystring = "?username=" + username + "&searchType=" + searchType;
    var url = MessageLoader.URL_READ_REQUEST + querystring;
    
    AjaxManager.performAjaxRequest(MessageLoader.DEFAUL_METHOD, url, MessageLoader.ASYNC_TYPE, null, responseFunction);
}

MessageLoader.loadAllMessages = function(username){
    MessageLoader.loadMessages(username, MessageLoader.ALL_MESSAGES, MessageLoader.onAllMessagesAjaxResponse);
}

MessageLoader.loadNewMessages = function(username){
    MessageLoader.loadMessages(username, MessageLoader.NEW_MESSAGES, MessageLoader.onNewMessagesAjaxResponse);
}

MessageLoader.countNewMessages = function(username){
    var notifica = document.getElementById(username + '_new_message_counter');
    notifica.removeChild(notifica.firstChild);
    notifica.appendChild(document.createTextNode('0'));
    notifica.style.display = "none";
    MessageLoader.loadMessages(username, MessageLoader.COUNT_NEW_MESSAGES, MessageLoader.onCountMessagesAjaxResponse);
}

MessageLoader.sendNewMessage = function(username){
    
    var textarea = document.getElementById(username + "_message_textarea")
    var message = textarea.value;
    textarea.value="";
    if(!message || message==="" || message===null)
        return;
    
    username = encodeURIComponent(username);
    message = encodeURIComponent(message);
    var querystring = "username=" + username + "&message=" + message;
    var url = MessageLoader.URL_WRITE_REQUEST;
    var responseFunction = MessageLoader.onNewSentMessageAjaxResponse;
    
    AjaxManager.performAjaxRequest(MessageLoader.WRITE_METHOD, url, MessageLoader.ASYNC_TYPE, querystring, responseFunction);
}




MessageLoader.onAllMessagesAjaxResponse = function(response){
    if(response.responseCode === MessageLoader.SUCCESS_RESPONSE) {
        MessageDashboard.refreshData(response.data);
        return;
    }    
    MessageDashboard.setEmpty();
}

MessageLoader.onNewMessagesAjaxResponse = function(response){
    if(response.responseCode === MessageLoader.SUCCESS_RESPONSE) {
        MessageDashboard.addData(response.data);
    }
}

MessageLoader.onCountMessagesAjaxResponse = function(response){
    if(response.responseCode === MessageLoader.SUCCESS_RESPONSE) {
        var sender = response.data[0].from_utente;
        var notifica = document.getElementById(sender + '_new_message_counter');
        notifica.removeChild(notifica.firstChild);
        notifica.appendChild(document.createTextNode(response.data.length));
        if(response.data.length>0)
            notifica.style.display = "block";
    }
}

MessageLoader.onNewSentMessageAjaxResponse = function(response){
    if(response.responseCode === MessageLoader.SUCCESS_RESPONSE) {
        MessageDashboard.addData(response.data);
    }
}