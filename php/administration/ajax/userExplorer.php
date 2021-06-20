<?php
    session_start();

    require_once __DIR__ . "/../../costanti.php";
    require_once DIR_UTIL . "userDbManager.php";
    require_once DIR_AJAX_UTIL . "AjaxResponse.php";

    if (!isset($_POST['username'])){
        echo json_encode(new AjaxResponse());
        return;
    }		

    $username = $_POST['username'];

    $result= getSearchUserByName($username);

    if (checkEmptyResult($result)){
        $response = setEmptyResponse();
        echo json_encode($response);
        return;
    }

    $message = "OK";	
    $response = setResponse($result, $message);
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

    function setResponse($result, $message){
        $response = new AjaxResponse("0", $message);
        
        for($row = $result->fetch_assoc(), $index=0; $row; $row = $result->fetch_assoc(), $index++) {
            $username = $row['username'];
            $nome=$row['nome'];
            $cognome=$row['cognome'];
            $dataNascita = $row['dataNascita'];
            $tipo_utente=$row['tipo_utente'];
            $utente = new Utente(null, $username, null, $nome, $cognome, $dataNascita, $tipo_utente);
            $response->data[$index] = $utente; 
        }
       
        return $response;
    }

?>