function UserLoader(){}

UserLoader.DEFAUL_METHOD = "POST";
UserLoader.URL_REQUEST = "./ajax/userLoader.php";
UserLoader.URL_EXPLORE = "./ajax/userExplorer.php";
UserLoader.ASYNC_TYPE = true;

UserLoader.SUCCESS_RESPONSE = "0";
UserLoader.NO_MORE_DATA = "-1";


UserLoader.loadUserData = function(username){
    var query = "username=" + encodeURIComponent(username);
    var responseFunction = UserLoader.onUserDataAjaxResponse; 
    AjaxManager.performAjaxRequest(UserLoader.DEFAUL_METHOD, UserLoader.URL_REQUEST, UserLoader.ASYNC_TYPE, query, responseFunction);
}

UserLoader.searchUser = function(username){
    var query = "username=" + encodeURIComponent(username);
    var responseFunction = UserLoader.onUserSearchAjaxResponse; 
    AjaxManager.performAjaxRequest(UserLoader.DEFAUL_METHOD, UserLoader.URL_EXPLORE, UserLoader.ASYNC_TYPE, query, responseFunction);
}

UserLoader.onUserDataAjaxResponse = function(response){

    if (response.responseCode === UserLoader.SUCCESS_RESPONSE) {
        UserDashboard.refreshForm(response.data);
        return;
    }
    
    UserDashboard.setEmpty('form');
}

UserLoader.onUserSearchAjaxResponse = function(response){
    if (response.responseCode === UserLoader.SUCCESS_RESPONSE) {
        UserDashboard.refreshData(response.data);
        return;
    }
    
    UserDashboard.setEmpty('search');
}