<?php
    require_once __DIR__ . "/../costanti.php";
    require_once DIR_UTIL . "museDbManager.php"; //include la classe del db

    function insertStudentTutorTouple($student, $tutor){
        global $MuseDb;
        $student = $MuseDb->sqlInjectionFilter($student);
        $tutor = $MuseDb->sqlInjectionFilter($tutor);
        
        $queryString = "INSERT INTO tutoraggio VALUES('" . $student . "', '" . $tutor . "', null);";
        $result = $MuseDb->performQuery($queryString);
        $MuseDb->closeConnection();
        return $result;
    }
    
    function removeStudentTutorTouple($student, $tutor){
        global $MuseDb;
        $student = $MuseDb->sqlInjectionFilter($student);
        $tutor = $MuseDb->sqlInjectionFilter($tutor);
        
        $queryString = "DELETE FROM tutoraggio WHERE utente='" . $student . "' AND tutor='" . $tutor . "';";
        $result = $MuseDb->performQuery($queryString);
        $MuseDb->closeConnection();
        return $result;
    }
    
    function removeAllUserInteractions($username){
        global $MuseDb;
        $username = $MuseDb->sqlInjectionFilter($username);
        
        $queryString = "DELETE FROM tutoraggio "
                    . "WHERE utente='" . $username . "' OR tutor='" . $username . "';";
        $result = $MuseDb->performQuery($queryString);
        $MuseDb->closeConnection();
        return $result;
    }
    
    function alreadyAssigned($student, $tutor){
        global $MuseDb;
        $student = $MuseDb->sqlInjectionFilter($student);
        $tutor = $MuseDb->sqlInjectionFilter($tutor);
        
        $queryString = "SELECT * FROM tutoraggio WHERE utente = '" . $student . "' AND tutor = '" . $tutor . "';";
        $result = $MuseDb->performQuery($queryString);
        $numRow = mysqli_num_rows($result);
        $MuseDb->closeConnection();
        return $numRow>0;
    }
    
    function getAssignedTutorList($student){
        global $MuseDb;
        $student = $MuseDb->sqlInjectionFilter($student);
        
        $queryString = "SELECT * FROM tutoraggio WHERE utente = '" . $student . "';";
        $result = $MuseDb->performQuery($queryString);
        $MuseDb->closeConnection();
        return $result;
    }
    
    function getAssignedStudentList($tutor){
        global $MuseDb;
        $tutor = $MuseDb->sqlInjectionFilter($tutor);
        
        $queryString = "SELECT * FROM tutoraggio WHERE tutor = '" . $tutor . "';";
        $result = $MuseDb->performQuery($queryString);
        $MuseDb->closeConnection();
        return $result;
    }
    
    function tooManyStudentsPerTutor($maxStudentNumber, $tutor){
        $result = getAssignedStudentList($tutor);
        $numRow = mysqli_num_rows($result);
        return $numRow > $maxStudentNumber;
    }
    
    function tooManyTutorsPerStudent($maxTutorNumber, $student){
        $result = getAssignedTutorList($student);
        $numRow = mysqli_num_rows($result);
        return $numRow > $maxTutorNumber;
    }
    
    function getMyTutorDataList($usernameStudente){
        global $MuseDb;
        $usernameStudente = $MuseDb->sqlInjectionFilter($usernameStudente);
        
        $queryString = "SELECT tr.* " 
                . "FROM tutoraggio T INNER JOIN tutor tr ON T.tutor = tr.username "
                . "WHERE T.utente = '" . $usernameStudente. "';";
        $result = $MuseDb->performQuery($queryString);
        $MuseDb->closeConnection();
        return $result;
    }
    
    function getAverageRating($tutor){
        global $MuseDb;
        $tutor = $MuseDb->sqlInjectionFilter($tutor);
        
        $queryString = "SELECT AVG(voto) AS Media " 
                . "FROM tutoraggio "
                . "WHERE tutor = '" . $tutor. "';";
        $result = $MuseDb->performQuery($queryString);
        $MuseDb->closeConnection();
        return $result; 
    }
    
    function getUserRating($studente, $tutor){
        global $MuseDb;
        $studente = $MuseDb->sqlInjectionFilter($studente);
        $tutor = $MuseDb->sqlInjectionFilter($tutor);
        
        $queryString = "SELECT voto FROM tutoraggio WHERE utente = '" . $studente . "' AND tutor = '" . $tutor . "';";
        $result = $MuseDb->performQuery($queryString);
        $MuseDb->closeConnection();
        return $result;
    }

    function aggiornaVoto($studente, $tutor, $voto){
        global $MuseDb;
        $studente = $MuseDb->sqlInjectionFilter($studente);
        $tutor = $MuseDb->sqlInjectionFilter($tutor);
        $voto = $MuseDb->sqlInjectionFilter($voto);
        
        $queryString = "UPDATE tutoraggio "
                . "SET voto='" . $voto . "' "
                . "WHERE utente = '" . $studente . "' AND tutor = '" . $tutor . "';";
        $result = $MuseDb->performQuery($queryString);
        $MuseDb->closeConnection();
        return $result;
    }