<?php
    session_start();

    require_once __DIR__ . "/../../costanti.php";
    require_once DIR_UTIL . "cdlDbManager.php";
    require_once DIR_AJAX_UTIL . "AjaxResponse.php";
   
    if(!isset($_GET['modifyType'])){
        echo json_encode(new AjaxResponse());
        return;
    }
    
    $modifyType = $_GET['modifyType'];
    
    if($modifyType == 0) {
        if (!isset($_GET['nome']) || !isset($_GET['campo']) || !isset($_GET['valore'])){
            echo json_encode(new AjaxResponse());
            return;
        }		

        $nome = $_GET['nome'];
        $campo = $_GET['campo'];
        $valore = $_GET['valore'];

        $result= modifyCdlData($nome, $campo, $valore);
    } 
    else if($modifyType == 1) {
        if (!isset($_GET['nome']) || !isset($_GET['settore']) || !isset($_GET['descrizione'])){
            echo json_encode(new AjaxResponse());
            return;
        }
        
        $nome = $_GET['nome'];
        $settore = $_GET['settore'];
        $descrizione = $_GET['descrizione'];
        
        $result = insertInCdlDb($nome, $settore, $descrizione); 
    }
    
    $message = "OK";	
    echo json_encode(new AjaxResponse("0", $message));
    return;

?>