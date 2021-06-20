function TutorLoader(){}

TutorLoader.DEFAUL_METHOD = "GET";
TutorLoader.URL_REQUEST = "./ajax/tutorLoader.php";
TutorLoader.ASYNC_TYPE = true;

TutorLoader.SUCCESS_RESPONSE = "0";
TutorLoader.NO_MORE_DATA = "-1";
TutorLoader.TUTOR_RESULTS=3;

TutorLoader.loadData = function(searchType, universita, corsoDiLaurea){  
    var queryString = null;
    switch(searchType){
        case 0: 
            queryString = "?searchType=" + searchType + "&universita=" + universita + "&corsoDiLaurea=" + corsoDiLaurea;
            var responseFunction = TutorLoader.onTutorDataAjaxResponse;
            break;
        case 1: 
            queryString = "?searchType=" + searchType;
            var responseFunction = TutorLoader.onMyTutorAjaxResponse;
            break;
        case 2:
            queryString = "?searchType=" + searchType;
            var responseFunction = TutorLoader.onRatingAjaxResponse;
            break;
    }  
    var url = TutorLoader.URL_REQUEST + queryString;
    AjaxManager.performAjaxRequest(TutorLoader.DEFAUL_METHOD, url, TutorLoader.ASYNC_TYPE, null, responseFunction);
}
	
TutorLoader.onTutorDataAjaxResponse = function(response){

    if (response.responseCode === TutorLoader.SUCCESS_RESPONSE) {
        ResearchDashboard.refreshData(TutorLoader.TUTOR_RESULTS, response.data);
        return;
    }
    
    ResearchDashboard.setEmpty(TutorLoader.TUTOR_RESULTS);
}

TutorLoader.onMyTutorAjaxResponse = function(response){
    if (response.responseCode === TutorLoader.SUCCESS_RESPONSE) {
        TutorDashboard.refreshData(response.data);
        return;
    }
    
    TutorDashboard.setEmpty();
}

TutorLoader.onRatingAjaxResponse = function(response){
    if (response.responseCode === TutorLoader.SUCCESS_RESPONSE) {
        TutorDashboard.refreshRating(response.data);
        return;
    }
    
    TutorDashboard.setEmpty();
}
