function MessageDashboard(){}

MessageDashboard.LIST_ELEM = null;

MessageDashboard.getMyName = function(){
    return "" + MYNAME +"";
}

MessageDashboard.removeData = function(){
    var elem = document.getElementById('ajax_filled_messages');
    
    if(elem === null)
        return;
    
    while(elem.hasChildNodes())
        elem.removeChild(elem.firstChild);
}

MessageDashboard.setEmpty = function(){
    MessageDashboard.removeData();
}

MessageDashboard.refreshData = function(data){
    MessageDashboard.removeData();
    var wrapper = document.getElementById('ajax_filled_messages');
    if (wrapper === null || data === null || data.length <= 0)
	return;
    
    MessageDashboard.LIST_ELEM = MessageDashboard.createMessageListElem(); //nuovo elemento <ul> per la lista dei messaggi  
    for (var i = 0; i < data.length; i++){
        var messageItemElem = MessageDashboard.createMessageItemElement(data[i]); //nuovo elemento li con i dati di un messaggio
        MessageDashboard.LIST_ELEM.appendChild(messageItemElem);
    }

    wrapper.appendChild(MessageDashboard.LIST_ELEM);
}

MessageDashboard.addData = function(data){
    if(MessageDashboard.LIST_ELEM === null) {
        MessageDashboard.refreshData(data);
        return;
    }    
    
    var messageListElem = MessageDashboard.LIST_ELEM;   
    for (var i = 0; i < data.length; i++){
        var messageItemElem = MessageDashboard.createMessageItemElement(data[i]); //nuovo elemento li con i dati di un messaggio
        messageListElem.appendChild(messageItemElem);
    }
    
}

MessageDashboard.createMessageListElem = function(){
    var ul = document.createElement('ul');
    ul.setAttribute('class', 'result_list');
    ul.setAttribute('id', 'message_list');
    return ul;
}

MessageDashboard.createMessageItemElement = function(dataItem){
    var messageListItemWrapper = document.createElement('li');
    if(dataItem.from_utente === MessageDashboard.getMyName()) {
        messageListItemWrapper.setAttribute('class', 'sent_message_list_item');
    }   
    else if(dataItem.to_utente === MessageDashboard.getMyName()){
        messageListItemWrapper.setAttribute('class', 'received_message_list_item');
    }
    else
        document.write("ERRORE");
    
    messageListItemWrapper.appendChild(MessageDashboard.createSenderHeadingItem(dataItem.from_utente));
    messageListItemWrapper.appendChild(MessageDashboard.createTextMessageItem(dataItem.msgText));
    messageListItemWrapper.appendChild(MessageDashboard.createTimestampItem(dataItem.timestamp));

    return messageListItemWrapper;    
}

MessageDashboard.createTextMessageItem = function(toWrite){
    var messageDataItem = document.createElement('p');
    messageDataItem.setAttribute('class', 'message_text_data_item');
    var messageDataItemContent = document.createTextNode(toWrite);
    messageDataItem.appendChild(messageDataItemContent);
    return messageDataItem;
}

MessageDashboard.createSenderHeadingItem = function(sender){
    var messageDataItem = document.createElement('h3');
    messageDataItem.setAttribute('class', 'sender_heading_data_item');
    var messageDataItemContent = document.createTextNode(sender);
    messageDataItem.appendChild(messageDataItemContent);
    return messageDataItem;
}

MessageDashboard.createTimestampItem = function(timestamp){
    var messageTimestamp=document.createElement('small');
    messageTimestamp.setAttribute('class', 'timestamp_data_item');
    var realTime = document.createTextNode(timestamp);
    messageTimestamp.appendChild(realTime);
    return messageTimestamp;
}
