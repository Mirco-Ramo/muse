<?php
    session_start();
    require_once __DIR__ . "/../../costanti.php";
    require_once DIR_UTIL . "chatDbManager.php";
    require_once DIR_SESSION . "sessionUtil.php";
    require_once DIR_AJAX_UTIL . "AjaxResponse.php";

    if(!isset($_GET['username']) || !isset($_GET['searchType'])){
        echo json_encode(new AjaxResponse());
        return;
    }
    
    $otherContact = $_GET['username'];
    $searchType = $_GET['searchType'];
    $me = isLogged();
    $result=null;
    
    if($searchType != 0) {
        $result = loadNewMessages($otherContact, $me);
    }
    else  {
        $result = loadAllMessages($otherContact, $me);
    }
    
    if($searchType != 2){
        setReadMessages($otherContact, $me);
    }
    
    if(checkEmptyResult($result)){
        $response = setEmptyResponse();
        echo json_encode($response);
        return;
    }
    
    $message = "OK";
    $response = setResponse($result, $message);
    echo json_encode($response);
    return;
    
    
    function checkEmptyResult($result){
        if(!$result || $result===null || $result->num_rows <= 0)
            return true;
        return false;
    }
    
    function setEmptyResponse(){
        $message = "No data to load";
        return new AjaxResponse("-1", $message);
    }
    
    function setResponse($result, $message){
        $response = new AjaxResponse("0", $message);
        
        for($row = $result->fetch_assoc(), $index=0; $row; $row = $result->fetch_assoc(), $index++){
            $idmessaggio = $row['idmessaggio'];
            $from_utente = $row['from_utente'];
            $to_utente = $row['to_utente'];
            $msgText = $row['msgText'];
            $timestamp = $row['timestamp'];
            $stato = $row['stato'];
            
            $response->data[$index] = new Messaggio($idmessaggio, $from_utente, $to_utente, $msgText, $timestamp, $stato);
        }
        
        return $response;
    }
