<?php
    session_start();
    require_once __DIR__ . "/../../costanti.php";
    require_once DIR_UTIL . "chatDbManager.php";
    require_once DIR_SESSION . "sessionUtil.php";
    require_once DIR_AJAX_UTIL . "AjaxResponse.php";

    if(!isset($_POST['username']) || !isset($_POST['message'])){
        echo json_encode(new AjaxResponse());
        return;
    }
    
    $otherContact = $_POST['username'];
    $msgText = $_POST['message'];
    $me = isLogged();
    
    $result = writeNewMessage($me, $otherContact, $msgText); 
    
    $message = "OK";
    $response = setResponse($me, $otherContact, $msgText, $message, $result);
    echo json_encode($response);
    
    function setResponse($me, $otherContact, $msgText, $message, $result){
        $response = new AjaxResponse("0", $message);
        
        $timestamp = $result->fetch_assoc()['current_timestamp'];
        $response->data[0] = new Messaggio(null, $me, $otherContact, $msgText, $timestamp, 1);       
        
        return $response;
    }
