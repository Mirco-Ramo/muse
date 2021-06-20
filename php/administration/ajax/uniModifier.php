<?php
    session_start();

    require_once __DIR__ . "/../../costanti.php";
    require_once DIR_UTIL . "uniDbManager.php";
    require_once DIR_AJAX_UTIL . "AjaxResponse.php";
    
    if(!isset($_GET['modifyType'])){
        echo json_encode(new AjaxResponse());
        return;
    }
    
    $modifyType = $_GET['modifyType'];
    
    if($modifyType == 0){
        if (!isset($_GET['nomeAteneo']) || !isset($_GET['campo']) || !isset($_GET['valore'])){
            echo json_encode(new AjaxResponse());
            return;
        }		

        $nomeAteneo = $_GET['nomeAteneo'];
        $campo = $_GET['campo'];
        $valore = $_GET['valore'];

        $result= modifyUniData($nomeAteneo, $campo, $valore);
    }
    
    else if($modifyType == 1) {
        if (!isset($_GET['nomeAteneo']) || !isset($_GET['citta']) || !isset($_GET['link'])
            || !isset($_GET['nMatricole']) || !isset($_GET['miur']) || !isset($_GET['censis'])){
            echo json_encode(new AjaxResponse());
            return;
        }
        
        $nomeAteneo = $_GET['nomeAteneo'];
        $citta = $_GET['citta'];
        $link = $_GET['link'];
        $nMatricole = $_GET['nMatricole'];
        $miur = $_GET['miur'];
        $censis = $_GET['censis'];
        
        $result = insertInUniDb($nomeAteneo, $citta, $link, $nMatricole, $miur, $censis); 
    }
    

    $message = "OK";	
    echo json_encode(new AjaxResponse("0", $message));
    return;

?>