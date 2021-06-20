<?php
    session_start();

    require_once __DIR__ . "/../costanti.php";
    require_once DIR_UTIL . "userDbManager.php";
    require_once DIR_AJAX_UTIL . "AjaxResponse.php";

    if (!isset($_POST['username'])){
        echo json_encode(new AjaxResponse());
        return;
    }		

    $username = $_POST['username'];

    $resultAnagrafica= getDatiAnagraficaUtente($username);

    if (checkEmptyResult($resultAnagrafica)){
        $response = setEmptyResponse();
        echo json_encode($response);
        return;
    }

    $message = "OK";	
    $response = setResponse($resultAnagrafica, $username, $message);
    echo json_encode($response);
    return;

    function checkEmptyResult($result){
        if ($result === null || !$result)
            return true;

        return ($result->num_rows <= 0);
    }

    function setEmptyResponse(){
        $message = "No data to load";
        return new AjaxResponse("-1", $message);
    }

    function setResponse($resultAnagrafica, $username, $message){
        $response = new AjaxResponse("0", $message);
        
        $row = $resultAnagrafica->fetch_assoc();
        
        $nome=$row['nome'];
        $cognome=$row['cognome'];
        $dataNascita=$row['dataNascita'];
        $utente = new Utente(null, $username, null, $nome, $cognome, $dataNascita);
        $response->data = $utente;            
        
        return $response;
    }

?>