function ContactLoader(){}

ContactLoader.DEFAUL_METHOD = 'GET';
ContactLoader.URL_REQUEST = './ajaxChat/contactLoader.php';
ContactLoader.ASYNC_TYPE = true;

ContactLoader.SUCCESS_RESPONSE = "0";
ContactLoader.NO_MORE_DATA = "-1";

ContactLoader.loadMyContacts = function(username){
    var querystring = "?username=" + username;
    var url = ContactLoader.URL_REQUEST + querystring;
    var responseFunction = ContactLoader.onMyContactsAjaxResponse;
    
    AjaxManager.performAjaxRequest(ContactLoader.DEFAUL_METHOD, url, ContactLoader.ASYNC_TYPE, null, responseFunction);
}

ContactLoader.onMyContactsAjaxResponse = function(response){
    if(response.responseCode === ContactLoader.SUCCESS_RESPONSE) {
        ContactDashboard.refreshData(response.data);
        return;
    }    
    ContactDashboard.setEmpty();
}