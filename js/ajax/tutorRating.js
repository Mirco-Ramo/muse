function TutorRating(){}

TutorRating.DEFAUL_METHOD = "GET";
TutorRating.URL_REQUEST = "./ajax/tutorRating.php";
TutorRating.ASYNC_TYPE = true;

TutorRating.SUCCESS_RESPONSE = "0";

TutorRating.aggiornaVoto = function(tutorName, voto){  
    var queryString = "?tutorName=" + tutorName + "&voto=" + voto; 
    var url = TutorRating.URL_REQUEST + queryString;
    var responseFunction = TutorRating.onUpdateAjaxResponse;
    AjaxManager.performAjaxRequest(TutorRating.DEFAUL_METHOD, url, TutorRating.ASYNC_TYPE, null, responseFunction);
}
	
TutorRating.onUpdateAjaxResponse = function(response){

    if (response.responseCode !== TutorRating.SUCCESS_RESPONSE) {
        document.write("ERRORE");
    }
}
