function UniSelect(){}

UniSelect.removeData = function() {
    var select=document.getElementById('ajax_filled_uni');
    if(select === null)
        return;
    
    while(select.hasChildNodes())
        select.removeChild(select.firstChild);    
}

UniSelect.setEmpty = function(){
    UniSelect.removeData;
}


UniSelect.refreshData = function(data){
    UniSelect.removeData();
    var select=document.getElementById('ajax_filled_uni');
    if (select === null || data === null || data.length <= 0)
	return;
    
    var option=document.createElement('option');
    option.selected=true; option.value='default'; option.disabled=true;
    var optionText=document.createTextNode('--Seleziona qui--');
    option.appendChild(optionText); 
    select.appendChild(option);
    
    for(i=0; i<data.length; i++){
        var option=document.createElement('option');
        var nome=data[i].nomeAteneo;
        var optionText=document.createTextNode(nome);
        option.appendChild(optionText);
        option.value=nome;
        select.appendChild(option);
    }
}

