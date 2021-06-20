function OffertaFormativaLoader(){}

OffertaFormativaLoader.DEFAUL_METHOD = "GET";
OffertaFormativaLoader.URL_DATA_REQUEST = "./ajax/offertaFormativaDataLoader.php";
OffertaFormativaLoader.URL_MODIFIES = "./ajax/offertaFormativaModifier.php";
OffertaFormativaLoader.ASYNC_TYPE = true;

OffertaFormativaLoader.SUCCESS_RESPONSE = "0";
OffertaFormativaLoader.NO_MORE_DATA = "-1";

OffertaFormativaLoader.CHANGE=0;
OffertaFormativaLoader.INSERT=1;

OffertaFormativaLoader.loadEverything = function(){
    var url = OffertaFormativaLoader.URL_DATA_REQUEST;
    var responseFunction = OffertaFormativaLoader.onEverythingAjaxResponse;
    AjaxManager.performAjaxRequest(OffertaFormativaLoader.DEFAUL_METHOD, url, OffertaFormativaLoader.ASYNC_TYPE, null, responseFunction);
}

OffertaFormativaLoader.modifyData = function(uni, cdl, campo, valore){
    var query = "?universita="  + uni + "&corsoDiLaurea=" + cdl + "&campo=" + campo + "&valore=" + valore + "&modifyType=" + OffertaFormativaLoader.CHANGE;
    var url = OffertaFormativaLoader.URL_MODIFIES + query;
    var responseFunction = OffertaFormativaLoader.onModifySuccess; 
    AjaxManager.performAjaxRequest(OffertaFormativaLoader.DEFAUL_METHOD, url, OffertaFormativaLoader.ASYNC_TYPE, null, responseFunction);
}

OffertaFormativaLoader.addOffertaFormativa= function(universita, corsoDiLaurea, votoMedio, tempoMedio, occupati1anno, occupati5anni){
    var query = "?universita=" + universita + "&corsoDiLaurea=" + corsoDiLaurea + "&votoMedio=" + votoMedio +
                "&tempoMedio=" + tempoMedio + "&occupati1anno=" + occupati1anno + "&occupati5anni=" + occupati5anni +
                "&modifyType=" + OffertaFormativaLoader.INSERT;
    var url = OffertaFormativaLoader.URL_MODIFIES + query;
    var responseFunction = OffertaFormativaLoader.onModifySuccess; 
    AjaxManager.performAjaxRequest(OffertaFormativaLoader.DEFAUL_METHOD, url, !OffertaFormativaLoader.ASYNC_TYPE, null, responseFunction);
}




OffertaFormativaLoader.onEverythingAjaxResponse = function(response){
    if (response.responseCode === OffertaFormativaLoader.SUCCESS_RESPONSE) {
        OffertaFormativaTable.refreshData(response.data);
        return;
    }
    
    OffertaFormativaTable.setEmpty();
}

OffertaFormativaLoader.onModifySuccess = function(response){
    if (response.responseCode !== OffertaFormativaLoader.SUCCESS_RESPONSE) {
        document.write("ERRORE");
        return;
    }
}