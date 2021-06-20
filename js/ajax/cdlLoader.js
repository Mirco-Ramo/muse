function CdlLoader(){}

CdlLoader.DEFAUL_METHOD = "GET";
CdlLoader.URL_LIST_REQUEST = "./ajax/cdlListLoader.php";
CdlLoader.URL_DATA_REQUEST = "./ajax/cdlDataLoader.php";
CdlLoader.URL_MODIFIES = "./ajax/cdlModifier.php";
CdlLoader.ASYNC_TYPE = true;

CdlLoader.SUCCESS_RESPONSE = "0";
CdlLoader.NO_MORE_DATA = "-1";
CdlLoader.CDL_RESULTS=2;

CdlLoader.CHANGE=0;
CdlLoader.INSERT=1;

CdlLoader.loadList = function(uniSelected){
    var queryString = "?uniSelected=" + uniSelected;
    var url = CdlLoader.URL_LIST_REQUEST + queryString;
    var responseFunction = CdlLoader.onCdlListAjaxResponse;
    AjaxManager.performAjaxRequest(CdlLoader.DEFAUL_METHOD, url, CdlLoader.ASYNC_TYPE, null, responseFunction);
}

CdlLoader.loadData = function(universita, corsoDiLaurea){
    var query = "?universita=" + universita + "&corsoDiLaurea=" + corsoDiLaurea;
    var url = CdlLoader.URL_DATA_REQUEST + query;
    var responseFunction = CdlLoader.onCdlDataAjaxResponse; 
    AjaxManager.performAjaxRequest(CdlLoader.DEFAUL_METHOD, url, CdlLoader.ASYNC_TYPE, null, responseFunction);
}

CdlLoader.loadEverything = function(){
    var url = CdlLoader.URL_DATA_REQUEST;
    var responseFunction = CdlLoader.onEverythingAjaxResponse;
    AjaxManager.performAjaxRequest(CdlLoader.DEFAUL_METHOD, url, CdlLoader.ASYNC_TYPE, null, responseFunction);
}

CdlLoader.modifyData = function(nome, campo, valore){
    var query = "?nome=" + nome + "&campo=" + campo + "&valore=" + valore + "&modifyType=" + CdlLoader.CHANGE;
    var url = CdlLoader.URL_MODIFIES + query;
    var responseFunction = CdlLoader.onModifySuccess; 
    AjaxManager.performAjaxRequest(CdlLoader.DEFAUL_METHOD, url, CdlLoader.ASYNC_TYPE, null, responseFunction);
}

CdlLoader.addCdl= function(nome, settore, descrizione){
    var query = "?nome=" + nome + "&settore=" + settore + "&descrizione=" + descrizione +
                "&modifyType=" + CdlLoader.INSERT;
    var url = CdlLoader.URL_MODIFIES + query;
    var responseFunction = CdlLoader.onModifySuccess; 
    AjaxManager.performAjaxRequest(CdlLoader.DEFAUL_METHOD, url, CdlLoader.ASYNC_TYPE, null, responseFunction);
}


CdlLoader.onCdlListAjaxResponse = function(response){

    if (response.responseCode === CdlLoader.SUCCESS_RESPONSE) {
        CdlSelect.refreshData(response.data);
        return;
    }
    
    CdlSelect.setEmpty();
}

CdlLoader.onCdlDataAjaxResponse = function(response){

    if (response.responseCode === CdlLoader.SUCCESS_RESPONSE) {
        ResearchDashboard.refreshData(CdlLoader.CDL_RESULTS, response.data);
        return;
    }
    
    ResearchDashboard.setEmpty(CdlLoader.CDL_RESULTS);
}

CdlLoader.onEverythingAjaxResponse = function(response){
    if (response.responseCode === CdlLoader.SUCCESS_RESPONSE) {
        CdlTable.refreshData(response.data);
        return;
    }
    
    CdlTable.setEmpty();
}

CdlLoader.onModifySuccess = function(response){
    if (response.responseCode !== CdlLoader.SUCCESS_RESPONSE) {
        document.write("ERRORE");
        return;
    }
}