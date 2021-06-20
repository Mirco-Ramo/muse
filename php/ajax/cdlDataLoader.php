<?php
    session_start();

    require_once __DIR__ . "/../costanti.php";
    require_once DIR_UTIL . "uniDbManager.php";
    require_once DIR_UTIL . "cdlDbManager.php";
    require_once DIR_AJAX_UTIL . "AjaxResponse.php";

    if (!isset($_GET['universita']) || !isset($_GET['corsoDiLaurea'])){
        echo json_encode(new AjaxResponse());
        return;
    }		

    $universita = $_GET['universita'];
    $corsoDiLaurea=$_GET['corsoDiLaurea'];
    
    $result = getOffertaFormativaData($universita, $corsoDiLaurea);

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

        $row=$result->fetch_assoc();
        
        $uniDataResult = getUniData($row['universita']);
        $uniDataRow = $uniDataResult->fetch_assoc();
        $Universita = UniversitaBuilder($uniDataRow);
        
        $cdlDataResult = getCdlData($row['corsoDiLaurea']);
        $cdlDataRow = $cdlDataResult->fetch_assoc();
        $CorsoDiLaurea = CorsoDiLaureaBuilder($cdlDataRow);
        
        $votoMedio=$row['votoMedio'];
        $tempoMedio=$row['tempoMedio'];
        $occupati1anno=$row['occupati1anno'];
        $occupati5anni=$row['occupati5anni'];
        $offerta = new OffertaFormativa($Universita, $CorsoDiLaurea, $votoMedio, $tempoMedio, $occupati1anno, $occupati5anni);
        
        $response->data[0] = $CorsoDiLaurea;
        $response->data[1] = $offerta;                    

        return $response;
    }

?>