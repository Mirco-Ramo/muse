function TutorDashboard(){}

TutorDashboard.URL_FIRST_LETTER = '../img/lettere/';
TutorDashboard.URL_STAR = '../css/img/';
TutorDashboard.STATIC_RATING = false;
TutorDashboard.DYNAMIC_RATING = true;

TutorDashboard.removeData = function() {
    var elem=document.getElementById('ajax_filled_tutor');
    
    if(elem === null)
        return;   
    
    while(elem.hasChildNodes())
        elem.removeChild(elem.firstChild);      
}

TutorDashboard.setEmpty = function(){
    TutorDashboard.removeData();
    var elem = document.getElementById('ajax_filled_tutor');
    var a = document.createElement('a');
    a.setAttribute('href', 'areaDiRicerca.php');
    a.setAttribute('target', '_top');
    a.appendChild(document.createTextNode('Area di Ricerca'));
    var p = document.createElement('p');
    p.appendChild(document.createTextNode("Non hai nessun tutor assegnato, per richiederne vai all'"));
    elem.appendChild(p);
    elem.appendChild(a);
}

TutorDashboard.refreshData = function(data){
    TutorDashboard.removeData();
    var wrapper = document.getElementById('ajax_filled_tutor');
    if (wrapper === null || data === null || data.length <= 0)
	return;

    var newTutorListElem = TutorDashboard.createTutorListElem();  //nuovo elemento <ul> per la lista dei tutor
    for (var i = 0; i < data.length; i++){
        var tutorItemElem = TutorDashboard.createTutorItemElement(data[i]); //nuovo elemento li con i dati di un tutor
        newTutorListElem.appendChild(tutorItemElem);
    }

    wrapper.appendChild(newTutorListElem);
    
}

TutorDashboard.createTutorListElem = function() {
    var tutorListElem = document.createElement('ul');
    tutorListElem.setAttribute('id', 'tutorList');
    tutorListElem.setAttribute('class', 'tutor_list');
    return tutorListElem;
}

TutorDashboard.createTutorItemElement = function(dataItem){
    var tutorListItemWrapper = document.createElement('li');
    tutorListItemWrapper.setAttribute('id', 'tutor_item_' + dataItem.username);
    tutorListItemWrapper.setAttribute('class', 'tutor_list_item');
    
    tutorListItemWrapper.appendChild(TutorDashboard.getFirstLetterPhoto(dataItem.username));
    
    var tutorListItemDataWrapper=document.createElement('div');
    tutorListItemDataWrapper.setAttribute('class', 'data_tutor_container');
    tutorListItemDataWrapper.appendChild(TutorDashboard.createTutorDataItem(dataItem.username));
    tutorListItemDataWrapper.appendChild(TutorDashboard.createTutorDataItem(dataItem.Universita.nomeAteneo));
    tutorListItemDataWrapper.appendChild(TutorDashboard.createTutorDataItem(dataItem.CorsoDiLaurea.nome));
    tutorListItemDataWrapper.appendChild(TutorDashboard.createTutorDataItem('Anno di iscrizione: ' + dataItem.annoIscrizione));
    tutorListItemDataWrapper.appendChild(TutorDashboard.createTutorDataItem('Anno di lezioni frequentato: ' + dataItem.annoFrequenza));
    tutorListItemDataWrapper.appendChild(TutorDashboard.createRatingItem(dataItem.mediaVoti, dataItem.username, TutorDashboard.STATIC_RATING));
    tutorListItemWrapper.appendChild(tutorListItemDataWrapper);
    
    tutorListItemWrapper.appendChild(TutorDashboard.createButtonUserTutorInteraction(dataItem.username));
    
    return tutorListItemWrapper;
}

TutorDashboard.createTutorDataItem = function(toWrite){
    var tutorDataItem = document.createElement('p');
    tutorDataItem.setAttribute('class', 'block_data_item');
    var tutorDataItemContent = document.createTextNode(toWrite);
    tutorDataItem.appendChild(tutorDataItemContent);
    return tutorDataItem;
}

TutorDashboard.createButtonUserTutorInteraction = function(tutorName){
    var buttonWrapper = document.createElement('div');
    buttonWrapper.setAttribute('class', 'data_tutor_container');
    buttonWrapper.setAttribute('id', 'button_tutor_container');
    
    var button = document.createElement('a');
    button.appendChild(document.createTextNode('Rimuovi'));
    button.setAttribute('class', 'userTutorDeleteButton');
    var query = './userTutorDelete.php?tutorName=' + tutorName;
    button.setAttribute('href', query);
    button.addEventListener('click', function() {TutorDashboard.askConfirm(this, query)}, false);
    buttonWrapper.appendChild(button);
    return buttonWrapper;
}

TutorDashboard.askConfirm = function(elem, query){
    if(!confirm("Sei sicuro di voler rimuovere questo tutor?"))
        elem.setAttribute('href', '#');
    else
        elem.setAttribute('href', query);
}

TutorDashboard.getFirstLetterPhoto = function(word){
    var div = document.createElement('div');
    div.setAttribute('class', 'data_tutor_container');
    div.setAttribute('id', 'photoWrapper');
    var photo = document.createElement('img');
    photo.setAttribute('class', 'round');
    photo.setAttribute('id', word + 'profile_photo');
    photo.setAttribute('alt', word + 'profile_photo');
    photo.setAttribute('src', TutorDashboard.URL_FIRST_LETTER + word.charAt(0) + '.jpg');
    div.appendChild(photo);
    return div;
}

TutorDashboard.createRatingItem = function(mediaVoti, tutorName, ratingMode){
    var tutorDataItem = document.createElement('p');
    tutorDataItem.setAttribute('class', 'block_data_item');
    if(mediaVoti!==null || ratingMode===TutorDashboard.DYNAMIC_RATING){
        if(ratingMode === TutorDashboard.DYNAMIC_RATING){
           tutorDataItem.appendChild(document.createTextNode('Il tuo voto:'));
        }
        else{
           tutorDataItem.appendChild(document.createTextNode('Media voti:')); 
        }        
        var img=null;
        for(var i=1; i<=5; i++){
                img = document.createElement('img');
                img.setAttribute('class', 'star');
                img.setAttribute('id', i + '_star_' + tutorName);
                img.setAttribute('alt', 'star');
                if(ratingMode === TutorDashboard.DYNAMIC_RATING){
                    img.addEventListener('mouseover', function(){ingrandisci(this);}, false)
                    img.addEventListener('mouseout', function(){rimpicciolisci(this);}, false)
                    img.addEventListener('click', function() {
                            TutorRating.aggiornaVoto(tutorName, parseInt(this.id));
                            setTimeout(location.reload(), 130);
                        }, false);
                }
            if(parseFloat(mediaVoti)+0.5 >= i){           
                img.setAttribute('src', TutorDashboard.URL_STAR + 'star.png');            
            }
            else{
                img.setAttribute('src', TutorDashboard.URL_STAR + 'star-outline.png');
            }
            tutorDataItem.appendChild(img);
        }
    }
    else
        tutorDataItem.appendChild(document.createTextNode('Media voti non disponibile'));
    return tutorDataItem;
}

TutorDashboard.cambiaContenutoBottone = function(value, newClass){
    bottoni=document.getElementsByClassName('userTutorDeleteButton');
    for(var i=0; i<bottoni.length; i++){
        bottoni[i].setAttribute('value', value);
        bottoni[i].setAttribute('class', newClass);
    }
}





TutorDashboard.refreshRating = function(data){
    TutorDashboard.removeData();
    var wrapper = document.getElementById('ajax_filled_tutor');
    if (wrapper === null || data === null || data.length <= 0)
	return;

    var newTutorListElem = TutorDashboard.createTutorListElem();  //nuovo elemento <ul> per la lista dei tutor
    for (var i = 0; i < data.length; i++){
        var tutorItemElem = TutorDashboard.createTutorRatingElement(data[i]); //nuovo elemento li con i dati di un tutor
        newTutorListElem.appendChild(tutorItemElem);
    }

    wrapper.appendChild(newTutorListElem);
    
}

TutorDashboard.createTutorRatingElement = function(dataItem){
    var tutorListItemWrapper = document.createElement('li');
    tutorListItemWrapper.setAttribute('id', 'tutor_item_' + dataItem.username);
    tutorListItemWrapper.setAttribute('class', 'tutor_list_item');
    
    tutorListItemWrapper.appendChild(TutorDashboard.getFirstLetterPhoto(dataItem.username));
    
    var tutorListItemDataWrapper=document.createElement('div');
    tutorListItemDataWrapper.setAttribute('class', 'data_tutor_container');
    tutorListItemDataWrapper.appendChild(TutorDashboard.createTutorDataItem(dataItem.username));
    tutorListItemDataWrapper.appendChild(TutorDashboard.createTutorDataItem(dataItem.Universita.nomeAteneo));
    tutorListItemDataWrapper.appendChild(TutorDashboard.createTutorDataItem(dataItem.CorsoDiLaurea.nome));
    tutorListItemDataWrapper.appendChild(TutorDashboard.createRatingItem(dataItem.mediaVoti, dataItem.username, TutorDashboard.DYNAMIC_RATING));
    tutorListItemWrapper.appendChild(tutorListItemDataWrapper);
    
    return tutorListItemWrapper;
}