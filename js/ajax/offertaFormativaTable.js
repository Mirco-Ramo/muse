function OffertaFormativaTable(){}

OffertaFormativaTable.removeData = function() {
    var table=document.getElementById('ajax_filled_of');
    if(table === null)
        return;
    
    while(table.hasChildNodes())
        table.removeChild(table.firstChild);    
}

OffertaFormativaTable.setEmpty = function(){
    OffertaFormativaTable.removeData;
}


OffertaFormativaTable.refreshData = function(data){
    OffertaFormativaTable.removeData();
    var table=document.getElementById('ajax_filled_of');
    if (table === null || data === null || data.length <= 0)
	return;
    
    for(i=0; i<data.length; i++){
        var tableRow=document.createElement('tr');
        var uni = data[i].Universita;
        var cdl = data[i].CorsoDiLaurea;
        tableRow.appendChild(OffertaFormativaTable.createInput(uni, cdl, data[i].Universita, 'universita'));
        tableRow.appendChild(OffertaFormativaTable.createInput(uni, cdl, data[i].CorsoDiLaurea, 'corsoDiLaurea'));
        tableRow.appendChild(OffertaFormativaTable.createInput(uni, cdl, data[i].votoMedio, 'votoMedio'));
        tableRow.appendChild(OffertaFormativaTable.createInput(uni, cdl, data[i].tempoMedio, 'tempoMedio'));
        tableRow.appendChild(OffertaFormativaTable.createInput(uni, cdl, data[i].occupati1anno, 'occupati1anno'));
        tableRow.appendChild(OffertaFormativaTable.createInput(uni, cdl, data[i].occupati5anni, 'occupati5anni'));
        table.appendChild(tableRow);    
    }
    table.appendChild(OffertaFormativaTable.createEmptyRow());
}

OffertaFormativaTable.createInput = function(uni, cdl, dato, nomeCampo){
    var td = document.createElement('td')
    var input = document.createElement('input');
    input.setAttribute('type', 'text');
    input.setAttribute('class', nomeCampo + '_input');
    input.setAttribute('id', uni + '_' + cdl + '_' + nomeCampo + '_input');
    input.setAttribute('id', uni + '_' + cdl + '_' + nomeCampo + '_input');
    input.setAttribute('autocomplete', 'off');
    input.setAttribute('size', '22');
    input.setAttribute('value', dato);
    if(dato === uni || dato === cdl)
        input.setAttribute('disabled', 'on');
    input.addEventListener('change', function(){OffertaFormativaLoader.modifyData(uni, cdl, nomeCampo, input.value);}, false);
    td.appendChild(input);
    return td;
}

OffertaFormativaTable.createEmptyRow = function() {
    var tr = document.createElement('tr');
    var uni = "";
    var cdl="";
    for(i=0; i<6; i++){
        
        var nomeCampo;
        switch(i){
            case 0: nomeCampo='universita'; break;
            case 1: nomeCampo='corsoDiLaurea'; break;
            case 2: nomeCampo='votoMedio'; break;
            case 3: nomeCampo='tempoMedio'; break;
            case 4: nomeCampo='occupati1anno'; break;
            case 5: nomeCampo='occupati5anni'; break;   
        }
          
        var td = document.createElement('td');
        var input = document.createElement('input');
        input.setAttribute('type', 'text');
        input.setAttribute('class', nomeCampo + '_input');
        input.setAttribute('id', uni + '_' + cdl + '_' + nomeCampo + '_input');
        input.setAttribute('id', uni + '_' + cdl + '_' + nomeCampo + '_input');
        input.setAttribute('autocomplete', 'off');
        input.setAttribute('size', '22');
        td.appendChild(input);
        tr.appendChild(td);
    }
    var piu = OffertaFormativaTable.addPlusSign();
    piu.addEventListener('click', function(){
            var universita = document.getElementById('__universita_input').value;
            var corsoDiLaurea = document.getElementById('__corsoDiLaurea_input').value;
            var votoMedio = document.getElementById('__votoMedio_input').value;
            var tempoMedio = document.getElementById('__tempoMedio_input').value;
            var occupati1anno = document.getElementById('__occupati1anno_input').value;
            var occupati5anni = document.getElementById('__occupati5anni_input').value;
            OffertaFormativaLoader.addOffertaFormativa(universita, corsoDiLaurea, votoMedio, tempoMedio, occupati1anno, occupati5anni);
            location.reload();
        }
    , false);
    tr.appendChild(piu);
    return tr;
}

OffertaFormativaTable.addPlusSign = function() {
    var img = document.createElement('img');
    img.setAttribute('src', '../../img/piu.jpg');
    img.setAttribute('alt', 'aggiungi');
    img.setAttribute('class', 'piu');
    return img;
}
