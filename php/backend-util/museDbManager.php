<?php  	
    require_once __DIR__ . "/../costanti.php";
    require DIR_UTIL . "dbConfig.php"; 			// classe con i parametri del database
    $MuseDb = new MuseDbManager();                      // crea una nuova classe di amministrazione del database

    class MuseDbManager {
            
        private $mysqli_connection = null;
        
        function MuseDbManager(){
            $this->openConnection();
        }
    
    	function openConnection(){                  //apre la connessione con il db specificato
            if (!$this->isOpened()){
                global $dbHostname;
                global $dbUsername;
                global $dbPassword;
                global $dbName;

                $this->mysqli_connection = new mysqli($dbHostname, $dbUsername, $dbPassword);
                if ($this->mysqli_connection->connect_error) 
                    die('Connect Error (' . $this->mysqli_connection->connect_errno . ') ' . $this->mysqli_connection->connect_error);

                $this->mysqli_connection->select_db($dbName) or
                    die ('Can\'t use pweb: ' . mysqli_error());
                }
    	}
    
    	//Controlla se la connessione è aperta 
    	function isOpened(){
            return ($this->mysqli_connection != null);
    	}

        // Esegue la query passata come parametro, restituisce le righe risultato
        function performQuery($queryText) {
            if (!$this->isOpened())
                $this->openConnection();

            return $this->mysqli_connection->query($queryText);
        }
	
        //Previene "l'avvelenamento" degli input nel database
        function sqlInjectionFilter($parameter){
            if(!$this->isOpened())
                $this->openConnection();

            return $this->mysqli_connection->real_escape_string($parameter);
        }

        //Chiude la connessione in modo sicuro
        function closeConnection(){
        if($this->mysqli_connection !== null)
            $this->mysqli_connection->close();

        $this->mysqli_connection = null;
        }
    }

?>