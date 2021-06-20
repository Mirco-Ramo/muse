<?php   
    require_once __DIR__ . "/../costanti.php";
    require_once DIR_UTIL . "museDbManager.php"; //include la classe del db

    function authenticate ($username, $password){   
        return searchInUserDb('tipo_utente', 'username', $username, 'password', $password);
    }
    
    function alreadyRegistered($username) {
        return searchInUserDb('email', 'username', $username) !== 'err_not_found';
    } 
    
    function alreadyUsedEmail($email) {
        return searchInUserDb('username', 'email', $email) !== 'err_not_found';
    }
    
    function getTipoUtente($username){
        return searchInUserDb('tipo_utente', 'username', $username);
    }
    
    function searchInUserDb(){
        global $MuseDb;
        $toReturn= func_get_arg(0);
        $parameters= func_get_args();
        for($i=0; $i<func_num_args(); $i++)
            $parameters[$i]=$MuseDb->sqlInjectionFilter($parameters[$i]);
        
        $queryText="SELECT * FROM utente WHERE ";        
        for($i=1; $i<func_num_args(); $i=$i+2){
            if($i!=1)
                $queryText=$queryText . " AND ";
            $queryText=$queryText . $parameters[$i] . "='" . $parameters[$i+1] . "'";
        }
        
        $result = $MuseDb->performQuery($queryText);
        $numRow = mysqli_num_rows($result);
        if ($numRow > 1) //errore nel database: utente duplicato
            return 'err_duplicate';
        
        if($numRow==0)  //utente non esistente
            return 'err_not_found';
        
        $userRow = $result->fetch_assoc();
        $MuseDb->closeConnection();
        return $userRow[$toReturn];
    }
    
    function getDatiAnagraficaUtente($username){
        global $MuseDb;
        $username = $MuseDb->sqlInjectionFilter($username);
        $queryText="SELECT nome, cognome, dataNascita FROM utente WHERE username='" . $username ."';";
        $result = $MuseDb->performQuery($queryText);
        $MuseDb->closeConnection();
        return $result;
    }
    
    function cambiaAnagrafica($username, $nome, $cognome, $dataNascita){
        global $MuseDb;
        $username = $MuseDb->sqlInjectionFilter($username);
        $nome = $MuseDb->sqlInjectionFilter($nome);
        $cognome = $MuseDb->sqlInjectionFilter($cognome);
        $dataNascita = $MuseDb->sqlInjectionFilter($dataNascita);
        
        $queryText="UPDATE utente SET nome='" . $nome . "', cognome='" . $cognome . "', dataNascita='" . $dataNascita ."' ".
                    "WHERE username='" . $username ."';";
        $result = $MuseDb->performQuery($queryText);
        $MuseDb->closeConnection();
        return null;
    }
    
    function controllaPassword($username, $password){
        $realPassword = searchInUserDb('password', 'username', $username);
        return $realPassword === $password ? null : 'err_password';
    }
    
    function cambiaPassword($username, $password){
        global $MuseDb;
        $username = $MuseDb->sqlInjectionFilter($username);
        $password = $MuseDb->sqlInjectionFilter($password);
        
        $queryText="UPDATE utente SET password='" . $password . "' " .
                    "WHERE username='" . $username ."';";
        $result = $MuseDb->performQuery($queryText);
        $MuseDb->closeConnection();
        return $result;
    }
    
    function insertInUserDb($email, $username, $password, $nome, $cognome, $dataNascita, $tipo_utente){
        global $MuseDb;
        $email = $MuseDb->sqlInjectionFilter($email);
        $username = $MuseDb->sqlInjectionFilter($username);
        $password = $MuseDb->sqlInjectionFilter($password);
        $nome = $MuseDb->sqlInjectionFilter($nome);
        $cognome = $MuseDb->sqlInjectionFilter($cognome);
        $dataNascita = $MuseDb->sqlInjectionFilter($dataNascita);
        $tipo_utente = $MuseDb->sqlInjectionFilter($tipo_utente);
        
        $queryText="INSERT INTO utente VALUES('" . $email . "', '" . $username . "', '" .$password .
                   "', '" . $nome . "', '" . $cognome . "', '" .$dataNascita . "', '" . $tipo_utente . "');";
        
        $result = $MuseDb->performQuery($queryText);
        $MuseDb->closeConnection();
        return $result;    
    }
    
    function removeFromUserDb($username){
        global $MuseDb;
        $username = $MuseDb->sqlInjectionFilter($username);
        
        $queryText="DELETE FROM utente "
                . "WHERE username='" . $username . "'";
                
        $result = $MuseDb->performQuery($queryText);
        $MuseDb->closeConnection();
        return $result;
    }
    
    function insertInTutorDb($username, $universita, $corsoDiLaurea, $annoIscrizione, $annoFrequenza){
        global $MuseDb;
        $username = $MuseDb->sqlInjectionFilter($username);
        $universita = $MuseDb->sqlInjectionFilter($universita);
        $corsoDiLaurea = $MuseDb->sqlInjectionFilter($corsoDiLaurea);
        $annoIscrizione = $MuseDb->sqlInjectionFilter($annoIscrizione);
        $annoFrequenza = $MuseDb->sqlInjectionFilter($annoFrequenza);
        
        $queryText="INSERT INTO tutor VALUES('". $username ."', '" . $universita . "', '" . $corsoDiLaurea . 
                "', '" . $annoIscrizione . "', " . $annoFrequenza . ");";
                
        $result = $MuseDb->performQuery($queryText);
        $MuseDb->closeConnection();
        return $result;
    }
    
    function removeFromTutorDb($username){
        global $MuseDb;
        $username = $MuseDb->sqlInjectionFilter($username);
        
        $queryText="DELETE FROM tutor "
                . "WHERE username='" . $username . "'";
                
        $result = $MuseDb->performQuery($queryText);
        $MuseDb->closeConnection();
        return $result;
    }
    
    function insertInStudentDb($username, $tipoScuola, $nomeScuola, $cittaScuola, $provinciaScuola, $annoFrequentato){
        global $MuseDb;
        $username = $MuseDb->sqlInjectionFilter($username);
        $tipoScuola = $MuseDb->sqlInjectionFilter($tipoScuola);
        $nomeScuola = $MuseDb->sqlInjectionFilter($nomeScuola);
        $cittaScuola = $MuseDb->sqlInjectionFilter($cittaScuola);
        $provinciaScuola = $MuseDb->sqlInjectionFilter($provinciaScuola);
        $annoFrequentato = $MuseDb->sqlInjectionFilter($annoFrequentato);
        
        $queryText="INSERT INTO studente VALUES('" . $username ."', '" . $tipoScuola . "', '" . $nomeScuola . 
                "', '" . $cittaScuola . "', '" . $provinciaScuola . "', " . $annoFrequentato . ");";
                
        $result = $MuseDb->performQuery($queryText);
        $MuseDb->closeConnection();
        return $result;
    }
    
    function removeFromStudentDb($username){
        global $MuseDb;
        $username = $MuseDb->sqlInjectionFilter($username);
        
        $queryText="DELETE FROM studente "
                . "WHERE username='" . $username . "'";
                
        $result = $MuseDb->performQuery($queryText);
        $MuseDb->closeConnection();
        return $result;
    }
    
    function getTutorDataList($universita, $corsoDiLaurea){
        global $MuseDb;
        $universita=$MuseDb->sqlInjectionFilter($universita);
        $corsoDiLaurea=$MuseDb->sqlInjectionFilter($corsoDiLaurea);
        
        $queryText="SELECT * FROM tutor WHERE universita='" . $universita . "' "
                 . "AND corsoDiLaurea='" . $corsoDiLaurea . "';";        
        
        $result = $MuseDb->performQuery($queryText);
        
        $MuseDb->closeConnection();
        return $result;
    }
    
    function getSearchUserByName($pattern){
        global $MuseDb;
        $pattern = $MuseDb->sqlInjectionFilter($pattern);
        
        $queryText = "SELECT * " .
                     "FROM utente " .
                     "WHERE username LIKE '%" . $pattern . "%';";
        
        $result = $MuseDb->performQuery($queryText);
        
        $MuseDb->closeConnection();
        return $result;
    }

?>