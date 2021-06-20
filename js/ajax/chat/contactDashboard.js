function ContactDashboard() {}

ContactDashboard.URL_FIRST_LETTER = '../../img/lettere/';

ContactDashboard.removeData = function(){
    var elem = document.getElementById('ajax_filled_contacts');
    
    if(elem === null)
        return;
    
    while(elem.hasChildNodes())
        elem.removeChild(elem.firstChild);
}

ContactDashboard.setEmpty = function(){
    ContactDashboard.removeData();
}

ContactDashboard.refreshData = function(data){
    ContactDashboard.removeData();
    var wrapper = document.getElementById('ajax_filled_contacts');
    if (wrapper === null || data === null || data.length <= 0)
	return;
    
    var newContactListElem = ContactDashboard.createContactListElem();  //nuovo elemento <ul> per la lista dei contatti
    for (var i = 0; i < data.length; i++){
        var contactItemElem = ContactDashboard.createContactItemElement(data[i]); //nuovo elemento li con i dati di un contatto
        newContactListElem.appendChild(contactItemElem);
    }

    wrapper.appendChild(newContactListElem);
}

ContactDashboard.createContactListElem = function(){
    var ul = document.createElement('ul');
    ul.setAttribute('class', 'result_list');
    ul.setAttribute('id', 'contact_list');
    return ul;
}

ContactDashboard.createContactItemElement = function(dataItem){
    var contactListItemWrapper = document.createElement('li');
    contactListItemWrapper.setAttribute('id', 'contact_item_' + dataItem.username);
    contactListItemWrapper.setAttribute('class', 'contact_list_item');
    
    contactListItemWrapper.appendChild(ContactDashboard.getFirstLetterPhoto(dataItem.username));
    
    var contactListItemDataWrapper=document.createElement('div');
    contactListItemDataWrapper.setAttribute('class', 'data_contact_container');
    contactListItemDataWrapper.appendChild(ContactDashboard.createContactDataItem(dataItem.username));
    contactListItemDataWrapper.appendChild(ContactDashboard.createContactDataItem(dataItem.nome));
    contactListItemDataWrapper.appendChild(ContactDashboard.createContactDataItem(dataItem.cognome));
    contactListItemWrapper.appendChild(contactListItemDataWrapper);
    
    contactListItemWrapper.appendChild(ContactDashboard.createButtonOpenChat(dataItem.username));
    
    return contactListItemWrapper;
}

ContactDashboard.createContactDataItem = function(toWrite){
    var contactDataItem = document.createElement('p');
    contactDataItem.setAttribute('class', 'block_data_item');
    var contactDataItemContent = document.createTextNode(toWrite);
    contactDataItem.appendChild(contactDataItemContent);
    return contactDataItem;
}

ContactDashboard.createButtonOpenChat = function(contactName){
    var buttonWrapper = document.createElement('div');
    buttonWrapper.setAttribute('class', 'data_contact_container');
    buttonWrapper.setAttribute('id', 'button_contact_container');
    
    var button = document.createElement('button');
    button.setAttribute('value', 'apri la chat');
    button.appendChild(document.createTextNode('Apri la chat'));
    button.setAttribute('class', 'openChatButton');
    button.addEventListener('click', function() {beginChat(contactName);}, false);
    buttonWrapper.appendChild(button);
    return buttonWrapper;
}


ContactDashboard.getFirstLetterPhoto = function(contactName){
    var div = document.createElement('div');
    div.setAttribute('class', 'data_contact_container');
    div.setAttribute('id', 'photoWrapper');
    var photo = document.createElement('img');
    photo.setAttribute('class', 'round');
    photo.setAttribute('id', contactName + '_profile_photo');
    photo.setAttribute('alt', contactName + '_profile_photo');
    photo.setAttribute('src', ContactDashboard.URL_FIRST_LETTER + contactName.charAt(0) + '.jpg');
    div.appendChild(photo);
    var counter = document.createElement('p');
    counter.setAttribute('class', 'new_message_counter');
    counter.setAttribute('id', contactName + '_new_message_counter');
    counter.appendChild(document.createTextNode('0'));
    
    startCountTimer(contactName, 2000);
 
    div.appendChild(counter);
    return div;
}

