<?php
//lista delle classi inviabili come risposte a richieste AJAX. La risposta è codificata in JSON

//classe generica per le risposte
class AjaxResponse{
    public $responseCode; // 0 all ok - 1 some errors - -1 some warning
    public $message;
    public $data;

    function AjaxResponse($responseCode = 1, $message = "Something went wrong! Please try later.", $data = null){
        $this->responseCode = $responseCode;
        $this->message = $message;
        $this->data = null;
    }

}

//dati sulle università
class Universita {
    public $nomeAteneo;
    public $citta;
    public $link;
    public $nMatricole;
    public $miur;
    public $censis;
    
    function Universita($nomeAteneo=null, $citta=null, $link=null, $nMatricole=null, $miur=null, $censis=null){
        $this->nomeAteneo=$nomeAteneo;
        $this->citta=$citta;
        $this->link=$link;
        $this->nMatricole=$nMatricole;
        $this->miur=$miur;
        $this->censis=$censis;
    }
}

function UniversitaBuilder($row){
    $nomeAteneo=$row['nomeAteneo'];
    $citta=$row['citta'];
    $link=$row['link'];
    $nMatricole=$row['nMatricole'];
    $miur=$row['miur'];
    $censis=$row['censis'];
    return new Universita($nomeAteneo, $citta, $link, $nMatricole, $miur, $censis);
}

//dati sui corsi di laurea
class CorsoDiLaurea {
    public $nome;
    public $settore;
    public $descrizione;
    
    function CorsoDiLaurea($nome=null, $settore=null, $descrizione=null){
        $this->nome=$nome;
        $this->settore=$settore;
        $this->descrizione=$descrizione;
    }   
}

function CorsoDiLaureaBuilder($row){
    $nome=$row['nome'];
    $settore=$row['settore'];
    $descrizione=$row['descrizione'];
    return new CorsoDiLaurea($nome, $settore, $descrizione);
}

//dati sui corsi di laurea offerti da ogni università
class OffertaFormativa{
    public $Universita;
    public $CorsoDiLaurea;
    public $votoMedio;
    public $tempoMedio;
    public $occupati1anno;
    public $occupati5anni;
    
    function OffertaFormativa($Universita=null, $CorsoDiLaurea=null, $votoMedio=null, $tempomedio=null, $occupati1anno=null, $occupati5anni=null) {
        $this->Universita=$Universita;
        $this->CorsoDiLaurea=$CorsoDiLaurea;
        $this->votoMedio=$votoMedio;
        $this->tempoMedio=$tempomedio;
        $this->occupati1anno=$occupati1anno;
        $this->occupati5anni=$occupati5anni;
    }
}

//dati sui tutor
class Tutor{
    public $username;
    public $Universita;
    public $CorsoDiLaurea;
    public $annoIscrizione;
    public $annoFrequenza;
    public $mediaVoti;
    
    function Tutor($username=null, $Universita=null, $CorsoDiLaurea=null, $annoIscrizione=null, $annoFrequenza=null, $mediaVoti=null){
        $this->username=$username;
        $this->Universita=$Universita;
        $this->CorsoDiLaurea=$CorsoDiLaurea;
        $this->annoIscrizione=$annoIscrizione;
        $this->annoFrequenza=$annoFrequenza;
        $this->mediaVoti=$mediaVoti;
    }
}

class Utente{
    public $email;
    public $username;
    public $password;
    public $nome;
    public $cognome;
    public $dataNascita;
    public $tipo_utente;
    
    function Utente($email=null, $username=null, $password=null, $nome=null, $cognome=null, $dataNascita=null, $tipo_utente=null){
        $this->email=$email;
        $this->username=$username;
        $this->password=$password;
        $this->nome=$nome;
        $this->cognome=$cognome;
        $this->dataNascita=$dataNascita;
        $this->tipo_utente=$tipo_utente;
    }
}

class Messaggio{
    public $idmessaggio;
    public $from_utente;
    public $to_utente;
    public $msgText;
    public $timestamp;
    public $stato;
    
    function Messaggio($idmessaggio=null, $from_utente=null, $to_utente=null, $msgText=null, $timestamp=null, $stato=null) {
        $this->idmessaggio = $idmessaggio;
        $this->from_utente = $from_utente;
        $this->to_utente = $to_utente;
        $this->msgText = $msgText;
        $this->timestamp = $timestamp;
        $this->stato = $stato;
    }
}
