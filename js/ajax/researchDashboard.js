function ResearchDashboard(){}

ResearchDashboard.UNI_RESULTS=1;
ResearchDashboard.CDL_RESULTS=2;
ResearchDashboard.TUTOR_RESULTS=3;

ResearchDashboard.URL_FIRST_LETTER = '../img/lettere/';
ResearchDashboard.URL_STAR = '../css/img/';

ResearchDashboard.UNI_PARAMETERS=['Sito web', 'Numero di iscritti', 'Posizione nella classifica MIUR', 'Posizione nella classifica CENSIS'];
ResearchDashboard.CDL_PARAMETERS=['Voto medio di Laurea', 'Tempo medio di Laurea', '% occupati dopo 1 anno', '%occupati dopo 5 anni'];

ResearchDashboard.getCorrectElement = function(type){
    var correctDivId=null;
    switch(type){
        case ResearchDashboard.UNI_RESULTS:
            correctDivId='uni_stats';
            break;
        
        case ResearchDashboard.CDL_RESULTS:
            correctDivId='cdl_stats';
            break;
        case ResearchDashboard.TUTOR_RESULTS:
            correctDivId='tutors';
            break;
        default:
            return 'all';
    }
    return document.getElementById(correctDivId);
}

ResearchDashboard.removeData = function(type) {
    var elem=ResearchDashboard.getCorrectElement(type);
    
    if(elem === null)
        return;
    
    else if(elem === 'all') {
        ResearchDashboard.removeData(ResearchDashboard.UNI_RESULTS);
        ResearchDashboard.removeData(ResearchDashboard.CDL_RESULTS);
        ResearchDashboard.removeData(ResearchDashboard.TUTOR_RESULTS);
        return;
    }   
    
    while(elem.hasChildNodes())
        elem.removeChild(elem.firstChild);      
}

ResearchDashboard.removeAllData = function(){
    ResearchDashboard.removeData('all');
}

ResearchDashboard.setEmpty = function(type){

    ResearchDashboard.removeData(type);
    var wrapper=ResearchDashboard.getCorrectElement(type);
    
    var warningDivElem = document.createElement("div");
    warningDivElem.setAttribute("class", "warning");
    var warningSpanElem = document.createElement("span");
    warningSpanElem.textContent = "There are no tutors available!";

    warningDivElem.appendChild(warningSpanElem);
    wrapper.appendChild(warningDivElem);
}

ResearchDashboard.refreshData = function(type, data){
    ResearchDashboard.removeData(type);
    var wrapper = ResearchDashboard.getCorrectElement(type);
    if (wrapper === null || data === null || data.length <= 0)
	return;
   
    wrapper.style.display = "block";
    switch(type){
        case ResearchDashboard.UNI_RESULTS:
            ResearchDashboard.displayUniStats(wrapper, data);
            break;
            
        case ResearchDashboard.CDL_RESULTS:
            ResearchDashboard.displayCdlStats(wrapper, data);
            break;
            
        case ResearchDashboard.TUTOR_RESULTS:
            legend = document.createElement('h4');
            legend.setAttribute('id', 'tutor_wrapper_legend');
            legend.setAttribute('class', 'stat_wrapper_legend');
            legendContent = 'tutor disponibili: ';
            legend.appendChild(document.createTextNode(legendContent.toUpperCase()));
            wrapper.appendChild(legend);
            
            var newTutorListElem = ResearchDashboard.createTutorListElem();  //nuovo elemento <ul> per la lista dei tutor
            for (var i = 0; i < data.length; i++){
                var tutorItemElem = ResearchDashboard.createTutorItemElement(data[i]); //nuovo elemento li con i dati di un tutor
                newTutorListElem.appendChild(tutorItemElem);
            }
            
            wrapper.appendChild(newTutorListElem);
            break;
    }
}

ResearchDashboard.displayUniStats = function(wrapper, data) {
    legend = document.createElement('h4');
    legend.setAttribute('id', 'uni_stat_wrapper_legend');
    legend.setAttribute('class', 'stat_wrapper_legend');
    legendContent = 'dati università: ';
    legend.appendChild(document.createTextNode(legendContent.toUpperCase()));
    wrapper.appendChild(legend);
    
    for(i=0; i<ResearchDashboard.UNI_PARAMETERS.length; i++){
        var box = document.createElement('div');
        box.setAttribute('class', 'uni_stat_item');
        var label = document.createElement('label');
        label.appendChild(document.createTextNode(ResearchDashboard.UNI_PARAMETERS[i]));
        var dato;
        switch(i){
            case 0:
                dato = document.createElement('a');
                dato.setAttribute('href', data.link);
                dato.setAttribute('target', '_blank');
                dato.appendChild(document.createTextNode(data.link));
                break;
            case 1:
                dato = document.createElement('p');
                dato.appendChild(document.createTextNode(data.nMatricole));
                break;
            case 2:
                dato = document.createElement('p');
                dato.appendChild(document.createTextNode(data.miur));
                break;
            case 3:
                dato = document.createElement('p');
                dato.appendChild(document.createTextNode(data.censis));
                break;
            default:
                break;
        }
        box.appendChild(label); box.appendChild(dato);
        wrapper.appendChild(box);
    }    
}

ResearchDashboard.displayCdlStats = function(wrapper, data) {
    legend = document.createElement('h4');
    legend.setAttribute('id', 'cdl_stat_wrapper_legend');
    legend.setAttribute('class', 'stat_wrapper_legend');
    legendContent = 'dati Corso Di Laurea: ';
    legend.appendChild(document.createTextNode(legendContent.toUpperCase()));
    wrapper.appendChild(legend);
    
    settore = document.createElement('p');
    settore.setAttribute('id', 'cdl_settore_description');
    settore.setAttribute('class', 'cdl_description');
    settoreContent = 'Settore: ' + data[0].settore;
    settore.appendChild(document.createTextNode(settoreContent));
    wrapper.appendChild(settore);
    
    descrizione = document.createElement('p');
    descrizione.setAttribute('id', 'cdl_descrizione_description');
    descrizione.setAttribute('class', 'cdl_description');
    descrizioneContent = 'Descrizione: ' + data[0].descrizione;
    descrizione.appendChild(document.createTextNode(descrizioneContent));
    wrapper.appendChild(descrizione);
    
    for(i=0; i<ResearchDashboard.UNI_PARAMETERS.length; i++){
        var box = document.createElement('div');
        box.setAttribute('class', 'cdl_stat_item');
        var label = document.createElement('label');
        label.appendChild(document.createTextNode(ResearchDashboard.CDL_PARAMETERS[i]));
        var dato=document.createElement('p');
        switch(i){
            case 0:
                dato.setAttribute('href', data.link);
                dato.appendChild(document.createTextNode(data[1].votoMedio));
                break;
            case 1:
                dato.appendChild(document.createTextNode(data[1].tempoMedio));
                break;
            case 2:
                dato.appendChild(document.createTextNode(data[1].occupati1anno));
                break;
            case 3:
                dato.appendChild(document.createTextNode(data[1].occupati5anni));
                break;
            default:
                break;
        }
        box.appendChild(label); box.appendChild(dato);
        wrapper.appendChild(box);
    }  
}

ResearchDashboard.createTutorListElem = function() {
    var tutorListElem = document.createElement('ul');
    tutorListElem.setAttribute('id', 'tutorList');
    tutorListElem.setAttribute('class', 'tutor_list');
    return tutorListElem;
}

ResearchDashboard.createTutorItemElement = function(dataItem){
    var tutorListItemWrapper = document.createElement('li');
    tutorListItemWrapper.setAttribute('id', 'tutor_item_' + dataItem.username);
    tutorListItemWrapper.setAttribute('class', 'tutor_list_item');
    
    tutorListItemWrapper.appendChild(ResearchDashboard.getFirstLetterPhoto(dataItem.username));
    
    var tutorListItemDataWrapper=document.createElement('div');
    tutorListItemDataWrapper.setAttribute('class', 'data_tutor_container');
    tutorListItemDataWrapper.appendChild(ResearchDashboard.createTutorDataItem(dataItem.username));
    tutorListItemDataWrapper.appendChild(ResearchDashboard.createTutorDataItem(dataItem.Universita.nomeAteneo));
    tutorListItemDataWrapper.appendChild(ResearchDashboard.createTutorDataItem(dataItem.CorsoDiLaurea.nome));
    tutorListItemDataWrapper.appendChild(ResearchDashboard.createTutorDataItem('Anno di iscrizione: ' + dataItem.annoIscrizione));
    tutorListItemDataWrapper.appendChild(ResearchDashboard.createTutorDataItem('Anno di lezioni frequentato: ' + dataItem.annoFrequenza));
    tutorListItemDataWrapper.appendChild(ResearchDashboard.createRatingItem(dataItem.mediaVoti));
    tutorListItemWrapper.appendChild(tutorListItemDataWrapper);
    
    tutorListItemWrapper.appendChild(ResearchDashboard.createButtonUserTutorInteraction(dataItem.username));
    
    return tutorListItemWrapper;
}

ResearchDashboard.createTutorDataItem = function(toWrite){
    var tutorDataItem = document.createElement('p');
    tutorDataItem.setAttribute('class', 'inline-block_data_item')
    var tutorDataItemContent = document.createTextNode(toWrite);
    tutorDataItem.appendChild(tutorDataItemContent);
    return tutorDataItem;
}

ResearchDashboard.createButtonUserTutorInteraction = function(tutorName){
    var buttonWrapper = document.createElement('div');
    buttonWrapper.setAttribute('class', 'data_tutor_container');
    buttonWrapper.setAttribute('id', 'button_tutor_container');
    
    var button = document.createElement('a');
    button.appendChild(document.createTextNode('Richiedi'));
    button.setAttribute('class', 'userTutorButton');
    var query = './userTutorAssociate.php?tutorName=' + tutorName;
    button.setAttribute('href', query);
    buttonWrapper.appendChild(button);
    return buttonWrapper;
}

ResearchDashboard.getFirstLetterPhoto = function(word){
    var div = document.createElement('div');
    div.setAttribute('class', 'data_tutor_container');
    div.setAttribute('id', 'photoWrapper');
    var photo = document.createElement('img');
    photo.setAttribute('class', 'round');
    photo.setAttribute('id', word + 'profile_photo');
    photo.setAttribute('alt', word + 'profile_photo');
    photo.setAttribute('src', ResearchDashboard.URL_FIRST_LETTER + word.charAt(0) + '.jpg');
    div.appendChild(photo);
    return div;
}

ResearchDashboard.createRatingItem = function(mediaVoti){
    var tutorDataItem = document.createElement('p');
    tutorDataItem.setAttribute('class', 'block_data_item');
    if(mediaVoti!==null){
        tutorDataItem.appendChild(document.createTextNode('Media voti:'));
        var img=null;
        for(i=1; i<=5; i++){
                img = document.createElement('img');
                img.setAttribute('class', 'star');
                img.setAttribute('alt', 'star');
            if(parseFloat(mediaVoti)+0.5>=i){           
                img.setAttribute('src', ResearchDashboard.URL_STAR + 'star.png');            
            }
            else{
                img.setAttribute('src', ResearchDashboard.URL_STAR + 'star-outline.png');
            }
            tutorDataItem.appendChild(img);
        }
    }
    else
        tutorDataItem.appendChild(document.createTextNode('Media voti non disponibile'));
    return tutorDataItem;
}
