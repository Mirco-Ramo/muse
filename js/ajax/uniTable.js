function UniTable(){}

UniTable.removeData = function() {
    var table=document.getElementById('ajax_filled_uni');
    if(table === null)
        return;
    
    while(table.hasChildNodes())
        table.removeChild(table.firstChild);    
}

UniTable.setEmpty = function(){
    UniTable.removeData;
}


UniTable.refreshData = function(data){
    UniTable.removeData();
    var table=document.getElementById('ajax_filled_uni');
    if (table === null || data === null || data.length <= 0)
	return;
    
    for(i=0; i<data.length; i++){
        var tableRow=document.createElement('tr');
        var uni = data[i].nomeAteneo;
        tableRow.appendChild(UniTable.createInput(uni, data[i].nomeAteneo, 'nomeAteneo'));
        tableRow.appendChild(UniTable.createInput(uni, data[i].citta, 'citta'));
        tableRow.appendChild(UniTable.createInput(uni, data[i].link, 'link'));
        tableRow.appendChild(UniTable.createInput(uni, data[i].nMatricole, 'nMatricole'));
        tableRow.appendChild(UniTable.createInput(uni, data[i].miur, 'miur'));
        tableRow.appendChild(UniTable.createInput(uni, data[i].censis, 'censis'));
        table.appendChild(tableRow);    
    }
    table.appendChild(UniTable.createEmptyRow());
}

UniTable.createInput = function(nomeAteneo, dato, nomeCampo){
    var td = document.createElement('td')
    var input = document.createElement('input');
    input.setAttribute('type', 'text');
    input.setAttribute('class', nomeCampo + '_input');
    input.setAttribute('id', nomeAteneo + '_' + nomeCampo + '_input');
    input.setAttribute('name', nomeAteneo + '_' + nomeCampo + '_input');
    input.setAttribute('autocomplete', 'off');
    input.setAttribute('size', '22');
    input.setAttribute('value', dato);
    if(dato === nomeAteneo)
        input.setAttribute('disabled', 'on');
    input.addEventListener('change', function(){UniLoader.modifyData(nomeAteneo, nomeCampo, input.value);}, false);
    td.appendChild(input);
    return td;
}

UniTable.createEmptyRow = function() {
    var tr = document.createElement('tr');
    var nomeAteneo = "";
    for(i=0; i<6; i++){
        
        var nomeCampo;
        switch(i){
            case 0: nomeCampo='nomeAteneo'; break;
            case 1: nomeCampo='citta'; break;
            case 2: nomeCampo='link'; break;
            case 3: nomeCampo='nMatricole'; break;
            case 4: nomeCampo='miur'; break;
            case 5: nomeCampo='censis'; break;   
        }
          
        var td = document.createElement('td');
        var input = document.createElement('input');
        input.setAttribute('type', 'text');
        input.setAttribute('class', nomeCampo + '_input');
        input.setAttribute('id', nomeAteneo + '_' + nomeCampo + '_input');
        input.setAttribute('name', nomeAteneo + '_' + nomeCampo + '_input');
        input.setAttribute('autocomplete', 'off');
        input.setAttribute('size', '22');
        td.appendChild(input);
        tr.appendChild(td);
    }
    var piu = UniTable.addPlusSign();
    piu.addEventListener('click', function(){
            var nomeAteneo = document.getElementById('_nomeAteneo_input').value;
            var citta = document.getElementById('_citta_input').value;
            var link = document.getElementById('_link_input').value;
            var nMatricole = document.getElementById('_nMatricole_input').value;
            var miur = document.getElementById('_miur_input').value;
            var censis = document.getElementById('_censis_input').value;
            UniLoader.addUni(nomeAteneo, citta, link, nMatricole, miur, censis);
            location.reload();
        }
    , false);
    tr.appendChild(piu);
    return tr;
}

UniTable.addPlusSign = function() {
    var img = document.createElement('img');
    img.setAttribute('src', '../../img/piu.jpg');
    img.setAttribute('alt', 'aggiungi');
    img.setAttribute('class', 'piu');
    return img;
}
