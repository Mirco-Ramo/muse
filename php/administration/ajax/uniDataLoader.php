<?php
    session_start();

    require_once __DIR__ . "/../../costanti.php";
    require_once DIR_UTIL . "uniDbManager.php";
    require_once DIR_AJAX_UTIL . "AjaxResponse.php";		

    $result= getAllUniData();

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
            
            $nomeAteneo=$row['nomeAteneo'];
            $citta=$row['citta'];
            $link=$row['link'];
            $nMatricole=$row['nMatricole'];
            $miur=$row['miur'];
            $censis=$row['censis'];
            $universita = new Universita($nomeAteneo, $citta, $link, $nMatricole, $miur, $censis);
            $response->data[$index] = $universita; 
        }  
        
        return $response;
    }

?>