function CdlTable(){}

CdlTable.removeData = function() {
    var table=document.getElementById('ajax_filled_uni');
    if(table === null)
        return;
    
    while(table.hasChildNodes())
        table.removeChild(table.firstChild);    
}

CdlTable.setEmpty = function(){
    CdlTable.removeData;
}


CdlTable.refreshData = function(data){
    CdlTable.removeData();
    var table=document.getElementById('ajax_filled_cdl');
    if (table === null || data === null || data.length <= 0)
	return;
    
    for(i=0; i<data.length; i++){
        var tableRow=document.createElement('tr');
        var nome = data[i].nome;
        tableRow.appendChild(CdlTable.createInput(nome, data[i].nome, 'nome'));
        tableRow.appendChild(CdlTable.createInput(nome, data[i].settore, 'settore'));
        tableRow.appendChild(CdlTable.createInput(nome, data[i].descrizione, 'descrizione'));
        table.appendChild(tableRow);
    }
    table.appendChild(CdlTable.createEmptyRow());
}

CdlTable.createInput = function(nome, dato, nomeCampo){
    var td = document.createElement('td')
    var input = document.createElement('input');
    input.setAttribute('type', 'text');
    input.setAttribute('class', nomeCampo + '_input');
    input.setAttribute('id', nome + '_' + nomeCampo + '_input');
    input.setAttribute('name', nome + '_' + nomeCampo + '_input');
    input.setAttribute('autocomplete', 'off');
    input.setAttribute('size', '28');
    input.setAttribute('value', dato);
    if(dato === nome)
        input.setAttribute('disabled', 'on');
    input.addEventListener('change', function(){CdlLoader.modifyData(nome, nomeCampo, input.value);}, false);
    td.appendChild(input);
    return td;
}

CdlTable.createEmptyRow = function() {
    var tr = document.createElement('tr');
    var nome = "";
    for(i=0; i<3; i++){
        
        var nomeCampo;
        switch(i){
            case 0: nomeCampo='nome'; break;
            case 1: nomeCampo='settore'; break;
            case 2: nomeCampo='descrizione'; break;;   
        }
          
        var td = document.createElement('td');
        var input = document.createElement('input');
        input.setAttribute('type', 'text');
        input.setAttribute('class', nomeCampo + '_input');
        input.setAttribute('id', nome + '_' + nomeCampo + '_input');
        input.setAttribute('name', nome + '_' + nomeCampo + '_input');
        input.setAttribute('autocomplete', 'off');
        input.setAttribute('size', '28');
        td.appendChild(input);
        tr.appendChild(td);
    }
    var piu = CdlTable.addPlusSign();
    piu.addEventListener('click', function(){
            var nome = document.getElementById('_nome_input').value;
            var settore = document.getElementById('_settore_input').value;
            var descrizione = document.getElementById('_descrizione_input').value;
            CdlLoader.addCdl(nome, settore, descrizione);
            location.reload();
        }
    , false);
    tr.appendChild(piu);
    return tr;
}

CdlTable.addPlusSign = function() {
    var img = document.createElement('img');
    img.setAttribute('src', '../../img/piu.jpg');
    img.setAttribute('alt', 'aggiungi');
    img.setAttribute('class', 'piu');
    return img;
}

