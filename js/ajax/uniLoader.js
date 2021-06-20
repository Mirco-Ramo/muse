function UniLoader(){}

UniLoader.DEFAUL_METHOD = "GET";
UniLoader.URL_LIST_REQUEST = "./ajax/uniListLoader.php";
UniLoader.URL_DATA_REQUEST = "./ajax/uniDataLoader.php";
UniLoader.URL_MODIFIES = "./ajax/uniModifier.php";
UniLoader.ASYNC_TYPE = true;

UniLoader.SUCCESS_RESPONSE = "0";
UniLoader.NO_MORE_DATA = "-1";
UniLoader.UNI_RESULTS=1;

UniLoader.CHANGE=0;
UniLoader.INSERT=1;

UniLoader.loadList = function(){
    var url = UniLoader.URL_LIST_REQUEST;
    var responseFunction = UniLoader.onUniListAjaxResponse; 
    AjaxManager.performAjaxRequest(UniLoader.DEFAUL_METHOD, url, UniLoader.ASYNC_TYPE, null, responseFunction);
}

UniLoader.loadData = function(nomeAteneo){
    var query = "?nomeAteneo=" + nomeAteneo;
    var url = UniLoader.URL_DATA_REQUEST + query;
    var responseFunction = UniLoader.onUniDataAjaxResponse; 
    AjaxManager.performAjaxRequest(UniLoader.DEFAUL_METHOD, url, UniLoader.ASYNC_TYPE, null, responseFunction);
}

UniLoader.loadEverything = function(){
    var url = UniLoader.URL_DATA_REQUEST;
    var responseFunction = UniLoader.onEverythingAjaxResponse;
    AjaxManager.performAjaxRequest(UniLoader.DEFAUL_METHOD, url, UniLoader.ASYNC_TYPE, null, responseFunction);
}

UniLoader.modifyData = function(nomeAteneo, campo, valore){
    var query = "?nomeAteneo=" + nomeAteneo + "&campo=" + campo + "&valore=" + valore + "&modifyType=" + UniLoader.CHANGE;
    var url = UniLoader.URL_MODIFIES + query;
    var responseFunction = UniLoader.onModifySuccess; 
    AjaxManager.performAjaxRequest(UniLoader.DEFAUL_METHOD, url, UniLoader.ASYNC_TYPE, null, responseFunction);
}

UniLoader.addUni= function(nomeAteneo, citta, link, nMatricole, miur, censis){
    var query = "?nomeAteneo=" + nomeAteneo + "&citta=" + citta + "&link=" + link +
                "&nMatricole=" + nMatricole + "&miur=" + miur + "&censis=" + censis +
                "&modifyType=" + UniLoader.INSERT;
    var url = UniLoader.URL_MODIFIES + query;
    var responseFunction = UniLoader.onModifySuccess; 
    AjaxManager.performAjaxRequest(UniLoader.DEFAUL_METHOD, url, UniLoader.ASYNC_TYPE, null, responseFunction);
}


	
UniLoader.onUniListAjaxResponse = function(response){

    if (response.responseCode === UniLoader.SUCCESS_RESPONSE) {
        UniSelect.refreshData(response.data);
        return;
    }
    
    UniSelect.setEmpty();
}

UniLoader.onUniDataAjaxResponse = function(response){

    if (response.responseCode === UniLoader.SUCCESS_RESPONSE) {
        ResearchDashboard.refreshData(UniLoader.UNI_RESULTS, response.data);
        return;
    }
    
    ResearchDashboard.setEmpty(UniLoader.UNI_RESULTS);
}

UniLoader.onEverythingAjaxResponse = function(response){
    if (response.responseCode === UniLoader.SUCCESS_RESPONSE) {
        UniTable.refreshData(response.data);
        return;
    }
    
    UniTable.setEmpty();
}

UniLoader.onModifySuccess = function(response){
    if (response.responseCode !== UniLoader.SUCCESS_RESPONSE) {
        document.write("ERRORE");
        return;
    }
}