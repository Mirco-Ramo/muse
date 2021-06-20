<?php
    session_start();

    require_once __DIR__ . "/../costanti.php";
    require_once DIR_UTIL . "userDbManager.php";
    require_once DIR_UTIL . "uniDbManager.php";
    require_once DIR_UTIL . "studentTutorInteractionDbManager.php";
    require_once DIR_UTIL . "cdlDbManager.php";
    require_once DIR_SESSION . "sessionUtil.php";
    require_once DIR_AJAX_UTIL . "AjaxResponse.php";

    if (!isset($_GET['searchType'])){
        echo json_encode(new AjaxResponse());
        return;
    }

    $searchType = $_GET['searchType'];
    $result=null;
    $studente = null;
    
    if($searchType==0){
        if(!isset($_GET['universita']) || !isset($_GET['corsoDiLaurea'])){
            echo json_encode(new AjaxResponse());
            return;
        }
        $universita = $_GET['universita'];
        $corsoDiLaurea = $_GET['corsoDiLaurea'];
        $result= getTutorDataList($universita, $corsoDiLaurea);
    }
    
    else{
        $studente = isLogged();
        $result = getMyTutorDataList($studente);
    }  

    if (checkEmptyResult($result)){
        $response = setEmptyResponse();
        echo json_encode($response);
        return;
    }

    $message = "OK";	
    $response = setResponse($result, $message, $searchType, $studente);
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

    function setResponse($result, $message, $searchType, $studente){
        $response = new AjaxResponse("0", $message);
        $tutor=null;

        for ($row = $result->fetch_assoc(), $index=0; $row; $row = $result->fetch_assoc(), $index++){

            $username=$row['username'];

            $uniDataResult = getUniData($row['universita']);
            $uniDataRow = $uniDataResult->fetch_assoc();
            $Universita = UniversitaBuilder($uniDataRow);

            $cdlDataResult = getCdlData($row['corsoDiLaurea']);
            $cdlDataRow = $cdlDataResult->fetch_assoc();
            $CorsoDiLaurea = CorsoDiLaureaBuilder($cdlDataRow);

            $annoIscrizione=$row['annoIscrizione'];
            $annoFrequenza=$row['annoFrequenza'];
            
            if($searchType !=2){
                $ratingDataResult = getAverageRating($username);
                $ratingRow = $ratingDataResult->fetch_assoc();
                $voto = $ratingRow['Media'];
            }
            else{
                $ratingDataResult = getUserRating($studente, $username);
                $ratingRow = $ratingDataResult->fetch_assoc();
                $voto = $ratingRow['voto'];
            }
            $tutor=new Tutor($username, $Universita, $CorsoDiLaurea, $annoIscrizione, $annoFrequenza, $voto);            

            $response->data[$index] = $tutor;            
        }       
        return $response;
    }    

?>