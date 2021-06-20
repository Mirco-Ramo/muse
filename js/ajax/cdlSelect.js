function CdlSelect(){}

CdlSelect.removeData = function() {
    var selectbox=document.getElementById('ajax_filled_cdl');
    if(selectbox === null)
        return;
    
    for(i=selectbox.options.length-1; i>= 0 ;i--)
    {
        selectbox.remove(i);
    }    
}

CdlSelect.setEmpty = function(){
    CdlSelect.removeData;
}

CdlSelect.refreshData = function(data){
    CdlSelect.setEmpty();
    CdlSelect.removeData();
    var select=document.getElementById('ajax_filled_cdl');
    if (select === null || data === null || data.length <= 0)
	return;
    
    var option=document.createElement('option');
    option.selected=true; option.value='default'; option.disabled=true;
    var optionText=document.createTextNode('--Seleziona qui--');
    option.appendChild(optionText); 
    select.appendChild(option);
    
    for(i=0; i<data.length; i++){
        var option=document.createElement('option');
        var nome=data[i].nome;
        var optionText=document.createTextNode(nome);
        option.appendChild(optionText);
        option.value=nome;
        select.appendChild(option);
    }
    
}