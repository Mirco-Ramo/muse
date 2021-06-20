<?php
    session_start();
    require_once __DIR__ . "/costanti.php";
    require_once DIR_SESSION . "sessionUtil.php";
    require_once DIR_UTIL . "userDbManager.php";
    require_once DIR_UTIL . "studentTutorInteractionDbManager.php";

    $message = null;
    $page = './eliminaTutor.php';   
    
    if(!isset($_GET['tutorName'])){
       $page = './eliminaTutor.php';
       $message = "Errore nel passaggio di parametri"; 
    }
        
    $tutorName = $_GET['tutorName'];

//controlla il valore ricevuto
    if(getTipoUtente($tutorName) != 'tutor'){
        $message = "Errore nell' eliminazione di questo tutor, si prega di sceglierne un altro";
    }
//controlla che il richiedente abbia effettuato il login
    if(!($user = isLogged())){
        $message = 'Si prega di effettuare il login per eliminare un tutor';
        echo '<script type="text/javascript"> alert("' . $message . '"); </script>' ;
    }
//controlla che il richiedente non sia tutor
    if(userIsTutor()){
        $message = 'I tutor non possono eliminare altri tutor!';
    }
    
//controlla che ci sia già stata associazione tra i due
    if(!alreadyAssigned($user, $tutorName)){
        $message = "Non sei ancora assegnato a questo tutor!";
    }

//associa i due utenti
    if($message === null){   //tutto ok 
        removeStudentTutorTouple($user, $tutorName);    
        $message = 'Rimozione completata!';
    }        
    header('location: ' . $page . '?message=' . $message );
