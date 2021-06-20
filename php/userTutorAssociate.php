<?php
    session_start();
    require_once __DIR__ . "/costanti.php";
    require_once DIR_SESSION . "sessionUtil.php";
    require_once DIR_UTIL . "userDbManager.php";
    require_once DIR_UTIL . "studentTutorInteractionDbManager.php";

    $message = null;
    $page = './home.php';   
    
    if(!isset($_GET['tutorName'])){
       $page = './areaDiRicerca.php';
       $message = "Errore nel passaggio di parametri"; 
    }
        
    $tutorName = $_GET['tutorName'];

//controlla il valore ricevuto
    if(getTipoUtente($tutorName) != 'tutor'){
        $page = './areaDiRicerca.php';
        $message = "Errore nell' associazione con questo tutor, si prega di sceglierne un altro";
    }
//controlla che il richiedente abbia effettuato il login
    if(!($user = isLogged())){
        $message = 'Si prega di effettuare il login per poter richiedere un tutor';
        echo '<script type="text/javascript"> alert("' . $message . '"); </script>' ;
        $page = './loginForm.php';
    }
//controlla che il richiedente non sia tutor
    if(userIsTutor()){
        $message = 'I tutor non possono richiedere altri tutor!';
        $page = './areaDiRicerca.php';
    }
    
//controlla che non ci sia gia stata associazione tra i due
    if(alreadyAssigned($user, $tutorName)){
        $message = "Sei già assegnato a questo tutor!";
        $page = './areaDiRicerca.php';
    }
//controlla che il tutor abbia meno di 5 studenti
    if(tooManyStudentsPerTutor(5, $tutorName)){
        $message = "Questo tutor è già al completo, si prega di scegliere un altro tutor";
        $page = './areaDiRicerca.php';
    }
//controlla che lo studente abbia meno di 10 tutor
    if(tooManyTutorsPerStudent(10, $user)){
        $message = "Hai raggiunto il numero massimo di tutor assegnabili!";
    }
//associa i due utenti
    if($message == null){   //tutto ok 
        insertStudentTutorTouple($user, $tutorName);    
        $message = 'Associazione completata!';
    }        
    header('location: ' . $page . '?message=' . $message );
