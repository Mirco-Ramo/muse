<?php
    session_start();
    require_once __DIR__ . "/../../costanti.php";
    require_once DIR_UTIL . "chatDbManager.php";
    require_once DIR_AJAX_UTIL . "AjaxResponse.php";

    if(!isset($_GET['username'])){
        echo json_encode(new AjaxResponse());
        return;
    }
    
    $username = $_GET['username'];
    
    $result = loadMyContacts($username);
    
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
            $email = $row['e-mail'];
            $username = $row['username'];
            $nome = $row['nome'];
            $cognome = $row['cognome'];
            $tipo_utente = $row['tipo_utente'];
            
            $response->data[$index] = new Utente($email, $username, null, $nome, $cognome, null, $tipo_utente);
        }
        
        return $response;
    }
