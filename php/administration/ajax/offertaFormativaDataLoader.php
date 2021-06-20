<?php
    session_start();

    require_once __DIR__ . "/../../costanti.php";
    require_once DIR_UTIL . "cdlDbManager.php";
    require_once DIR_AJAX_UTIL . "AjaxResponse.php";		

    $result= getAllOffertaFormativaData();

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
        
        $index=0;
        
        for($row = $result->fetch_assoc(); $row; $row = $result->fetch_assoc(), $index++){
            
            $universita=$row['universita'];
            $corsoDiLaurea=$row['corsoDiLaurea'];
            $votoMedio=$row['votoMedio'];
            $tempoMedio=$row['tempoMedio'];
            $occupati1anno=$row['occupati1anno'];
            $occupati5anni=$row['occupati5anni'];
            $offertaFormativa = new OffertaFormativa($universita, $corsoDiLaurea, $votoMedio, $tempoMedio, $occupati1anno, $occupati5anni);
            $response->data[$index] = $offertaFormativa; 
        }  
        
        return $response;
    }

?>