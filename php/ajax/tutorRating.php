<?php
    session_start();

    require_once __DIR__ . "/../costanti.php";
    require_once DIR_UTIL . "studentTutorInteractionDbManager.php";
    require_once DIR_SESSION . "sessionUtil.php";
    require_once DIR_AJAX_UTIL . "AjaxResponse.php";

    if (!isset($_GET['tutorName']) || !isset($_GET['voto'])){
        echo json_encode(new AjaxResponse());
        return;
    }

    $tutorName = $_GET['tutorName'];
    $voto = $_GET['voto'];
    $studente = isLogged();
    
    aggiornaVoto($studente, $tutorName, $voto);

    $message = "OK";	
    $response = setResponse($message);
    echo json_encode($response);

    function setResponse($message){
        $response = new AjaxResponse("0", $message);       
        return $response;
    }    

