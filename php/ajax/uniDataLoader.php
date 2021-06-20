<?php
    session_start();

    require_once __DIR__ . "/../costanti.php";
    require_once DIR_UTIL . "uniDbManager.php";
    require_once DIR_AJAX_UTIL . "AjaxResponse.php";

    if (!isset($_GET['nomeAteneo'])){
        echo json_encode(new AjaxResponse());
        return;
    }		

    $nomeAteneo = $_GET['nomeAteneo'];

    $result= getUniData($nomeAteneo);

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
        
        $row = $result->fetch_assoc();
        
        $nomeAteneo=$row['nomeAteneo'];
        $citta=$row['citta'];
        $link=$row['link'];
        $nMatricole=$row['nMatricole'];
        $miur=$row['miur'];
        $censis=$row['censis'];
        $universita = new Universita($nomeAteneo, $citta, $link, $nMatricole, $miur, $censis);
        $response->data = $universita;            
        
        return $response;
    }

?>