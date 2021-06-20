/*il form di registrazione è riempito dinamicamente con le domande riguardanti i tutor o gli studenti a seconda che gli utenti
 * scelgano uno o l'altro tipo di utente.
*/

//Prima parte: dichiarazione dei due possibili slot di domande
var labelTutor = ['Università: ','Corso di Laurea: ', "Anno di iscrizione all'Università: ", 'Anno di frequenza delle lezioni: ' ];
var domandeTutor = ['universita', 'corsoDiLaurea', 'annoIscrizione', 'annoFrequenza'];

var divTutor=document.createElement('div');
divTutor.id="tutorQuestions";

var i=0; var domanda;
for(; i<4; i++){
    var container=document.createElement('div');
    var label=document.createElement('label');
    var labelContent=document.createTextNode(labelTutor[i]);
    label.appendChild(labelContent);
    if(i===0){
        domanda=document.createElement('select');
        domanda.id='ajax_filled_uni';
    }
    else if(i===1) {
        domanda=document.createElement('select');
        domanda.id='ajax_filled_cdl';    
    }    
    else {
        domanda=document.createElement('input');
        domanda.type="number";
        if(i===3)
            domanda.maxlength="4";
        domanda.required;
    }
    domanda.name=domandeTutor[i];
    container.appendChild(label);
    container.appendChild(domanda);
    divTutor.appendChild(container);
}

var labelStudent = ['Tipo di scuola frequentata: ','Nome della tua scuola: ','Città della tua scuola: ', 'Provincia: ', 'Anno frequentato(1-5): ' ];
var domandeStudente = ['tipoScuola', 'nomeScuola', 'cittaScuola', 'provinciaScuola', 'annoFrequentato'];

var divStudent=document.createElement('div');
divStudent.id="studentQuestions";

i=0; domanda=null;
for(; i<5; i++){
    var container=document.createElement('div');
    var label=document.createElement('label');
    var labelContent=document.createTextNode(labelStudent[i]);
    label.appendChild(labelContent);
        domanda=document.createElement('input');
    if(i===4) {
        domanda.type="number";
        domanda.min="1";
        domanda.max="5";
        domanda.step="1";
    }
    else
        domanda.type="text";
    
    domanda.name=domandeStudente[i];
    container.appendChild(label);
    container.appendChild(domanda);
    divStudent.appendChild(container);
}


//seconda parte: funzioni che decidono quali domande mostrare

function mostraDomandeTutor(){
    giaPresente=document.getElementById('studentQuestions');
    parent=document.getElementsByTagName('form');
    if(giaPresente===null)
        parent[0].appendChild(divTutor);
    else
        parent[0].replaceChild(divTutor, divStudent);
    if(document.getElementById('enter_register_button') === null)
        parent[0].appendChild(aggiungiBottone());
    addAjaxEvents();
}

function mostraDomandeStudente(){
    giaPresente=document.getElementById('tutorQuestions');
    parent=document.getElementsByTagName('form');
    if(giaPresente===null)
        parent[0].appendChild(divStudent);
    else
        parent[0].replaceChild(divStudent, divTutor);
    if(document.getElementById('enter_register_button') === null)
        parent[0].appendChild(aggiungiBottone());
}

function aggiungiBottone(){
    bottone=document.createElement('input');
    bottone.setAttribute('id', 'enter_register_button');
    bottone.setAttribute('type', 'submit');
    bottone.setAttribute('value', 'Registrati');
    return bottone;
}

function addAjaxEvents(){
    UniLoader.loadList();
    uniSelect=document.getElementById('ajax_filled_uni');
    uniSelect.addEventListener("change", changeHandler, false);
}

function changeHandler(evt) {
    var field=evt.target;
    var selectedItem=field.value;
    CdlLoader.loadList(selectedItem);
}    