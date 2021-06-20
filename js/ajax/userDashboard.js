function UserDashboard(){}

UserDashboard.PARAMETERS=['Nome', 'Cognome', 'Data di nascita'];
UserDashboard.URL_FIRST_LETTER = '../../img/lettere/';

UserDashboard.removeData = function(id) {
    var elem=document.getElementById(id);
    
    if(elem === null)
        return; 
    
    while(elem.hasChildNodes())
        elem.removeChild(elem.firstChild);      
}

UserDashboard.setEmpty = function(type){
    switch (type){
        case 'form':
            UserDashboard.removeData('ajax_filled_form');
            break;
        case 'search':
            UserDashboard.removeData('ajax_filled_user');
            break;
    }
}

UserDashboard.refreshForm = function(data){
    UserDashboard.setEmpty('form');
    var form = document.getElementById('ajax_filled_form');
    if (form === null || data === null || data.length <= 0)
	return;
   
    for(i=0; i<UserDashboard.PARAMETERS.length; i++){
        var label=document.createElement('label');
        label.appendChild(document.createTextNode(UserDashboard.PARAMETERS[i]+':'));
        label.setAttribute('class', 'modificaDatiLabel');
        var input=document.createElement('input');
        switch(i){
            case 0:
                input.setAttribute('type', 'text');
                input.setAttribute('value', data.nome);
                input.setAttribute('name', 'nome');
                break;
            case 1:    
                input.setAttribute('type', 'text');
                input.setAttribute('value', data.cognome);
                input.setAttribute('name', 'cognome');
                break;
            case 2:
                input.setAttribute('type', 'date');
                input.setAttribute('value', data.dataNascita);
                input.setAttribute('name', 'dataNascita');
                break;
        }
        
        input.setAttribute('class', 'modificaDatiInput');
        input.required;
        form.appendChild(label);
        form.appendChild(input);
    }
    
    var submit=document.createElement('input');
    submit.type="submit";
    form.appendChild(submit);
    var reset=document.createElement('input');
    reset.type="reset";
    form.appendChild(reset);
}




UserDashboard.refreshData = function(data){
    UserDashboard.removeData('ajax_filled_user');
    var wrapper = document.getElementById('ajax_filled_user');
    if (wrapper === null || data === null || data.length <= 0)
	return;

    var newUserListElem = UserDashboard.createUserListElem();  //nuovo elemento <ul> per la lista degli utenti
    for (var i = 0; i < data.length; i++){
        if(data[i].tipo_utente === 'admin')
            continue;
        var userItemElem = UserDashboard.createUserItemElement(data[i]); //nuovo elemento li con i dati di un utente
        newUserListElem.appendChild(userItemElem);
    }

    wrapper.appendChild(newUserListElem);
    
}

UserDashboard.createUserListElem = function() {
    var userListElem = document.createElement('ul');
    userListElem.setAttribute('id', 'userList');
    userListElem.setAttribute('class', 'user_list');
    return userListElem;
}

UserDashboard.createUserItemElement = function(dataItem){
    var userListItemWrapper = document.createElement('li');
    userListItemWrapper.setAttribute('id', 'user_item_' + dataItem.username);
    userListItemWrapper.setAttribute('class', 'user_list_item');
    
    userListItemWrapper.appendChild(UserDashboard.getFirstLetterPhoto(dataItem.username));
    
    var userListItemDataWrapper=document.createElement('div');
    userListItemDataWrapper.setAttribute('class', 'data_user_container');
    userListItemDataWrapper.appendChild(UserDashboard.createUserDataItem(dataItem.username));
    userListItemDataWrapper.appendChild(UserDashboard.createUserDataItem(dataItem.nome));
    userListItemDataWrapper.appendChild(UserDashboard.createUserDataItem(dataItem.cognome));
    userListItemDataWrapper.appendChild(UserDashboard.createUserDataItem(dataItem.dataNascita));
    userListItemDataWrapper.appendChild(UserDashboard.createUserDataItem(dataItem.tipo_utente));
    userListItemWrapper.appendChild(userListItemDataWrapper);
    
    userListItemWrapper.appendChild(UserDashboard.createButtonUserDelete(dataItem.username));
    
    return userListItemWrapper;
}

UserDashboard.createUserDataItem = function(toWrite){
    var userDataItem = document.createElement('p');
    userDataItem.setAttribute('class', 'block_data_item');
    var userDataItemContent = document.createTextNode(toWrite);
    userDataItem.appendChild(userDataItemContent);
    return userDataItem;
}

UserDashboard.createButtonUserDelete = function(username){
    var buttonWrapper = document.createElement('div');
    buttonWrapper.setAttribute('class', 'data_user_container');
    buttonWrapper.setAttribute('id', 'button_user_container');
    
    var button = document.createElement('a');
    button.appendChild(document.createTextNode('Rimuovi'));
    button.setAttribute('class', 'userDeleteButton');
    var query = './userDelete.php?username=' + username;
    button.setAttribute('href', query);
    button.addEventListener('click', function() {UserDashboard.askConfirm(this, query)}, false);
    buttonWrapper.appendChild(button);
    return buttonWrapper;
}

UserDashboard.askConfirm = function(elem, query){
    if(!confirm("Sei sicuro di voler rimuovere questo utente?"))
        elem.setAttribute('href', '#');
    else
        elem.setAttribute('href', query);
}

UserDashboard.getFirstLetterPhoto = function(word){
    var div = document.createElement('div');
    div.setAttribute('class', 'data_user_container');
    div.setAttribute('id', 'photoWrapper');
    var photo = document.createElement('img');
    photo.setAttribute('class', 'round profile_photo');
    photo.setAttribute('id', word + 'profile_photo');
    photo.setAttribute('alt', word + 'profile_photo');
    photo.setAttribute('src', UserDashboard.URL_FIRST_LETTER + word.charAt(0) + '.jpg');
    div.appendChild(photo);
    return div;
}