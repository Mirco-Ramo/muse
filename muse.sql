-- Progettazione Web 
DROP DATABASE if exists muse; 
CREATE DATABASE muse; 
USE muse; 
-- MySQL dump 10.13  Distrib 5.6.20, for Win32 (x86)
--
-- Host: localhost    Database: muse
-- ------------------------------------------------------
-- Server version	5.6.20

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `corsodilaurea`
--

DROP TABLE IF EXISTS `corsodilaurea`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `corsodilaurea` (
  `nome` varchar(50) NOT NULL,
  `settore` varchar(50) DEFAULT NULL,
  `descrizione` text,
  PRIMARY KEY (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `corsodilaurea`
--

LOCK TABLES `corsodilaurea` WRITE;
/*!40000 ALTER TABLE `corsodilaurea` DISABLE KEYS */;
INSERT INTO `corsodilaurea` VALUES ('Ingegneria Chimica','Ingegneria Civile e Industriale','Studio e progettazione di impianti e di processi alla base dell\'industria chimica'),('Ingegneria Informatica','Ingegneria dell\'Informazione','Studio, progettazione, realizzazione e gestione di sistemi di elaborazione dei dati, sia hardware che software'),('Psicologia dello Sviluppo','Scienze Psicologiche','Studio delle teorie riguardanti il funzionamento della psiche durante gli anni dello sviluppo e dell\'evoluzione');
/*!40000 ALTER TABLE `corsodilaurea` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messaggio`
--

DROP TABLE IF EXISTS `messaggio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messaggio` (
  `idmessaggio` int(11) NOT NULL AUTO_INCREMENT,
  `from_utente` varchar(45) NOT NULL,
  `to_utente` varchar(45) NOT NULL,
  `msgText` text,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `stato` tinyint(4) NOT NULL,
  PRIMARY KEY (`idmessaggio`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messaggio`
--

LOCK TABLES `messaggio` WRITE;
/*!40000 ALTER TABLE `messaggio` DISABLE KEYS */;
INSERT INTO `messaggio` VALUES (1,'p','minnie','proviamo1','2020-09-08 16:44:30',0),(2,'p','minnie','proviamo1','2020-09-08 16:44:30',0),(3,'topolino','minnie','proviamo1','2020-09-08 16:45:36',0),(4,'topolino','minnie','proviamo2','2020-09-08 16:45:36',0),(17,'p','minnie','ciao Minnie!','2020-09-08 16:44:30',0),(18,'minnie','p','oi ciao Paperino!','2020-09-08 16:44:01',0);
/*!40000 ALTER TABLE `messaggio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offertaformativa`
--

DROP TABLE IF EXISTS `offertaformativa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offertaformativa` (
  `universita` varchar(45) NOT NULL,
  `corsoDiLaurea` varchar(50) NOT NULL,
  `votoMedio` float DEFAULT NULL,
  `tempoMedio` float DEFAULT NULL,
  `occupati1anno` float DEFAULT NULL,
  `occupati5anni` float DEFAULT NULL,
  PRIMARY KEY (`universita`,`corsoDiLaurea`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offertaformativa`
--

LOCK TABLES `offertaformativa` WRITE;
/*!40000 ALTER TABLE `offertaformativa` DISABLE KEYS */;
INSERT INTO `offertaformativa` VALUES ('Alma Mater Studiorum UNIBO','Ingegneria Chimica',96.7,3.7,14.5,95.7),('Alma Mater Studiorum UNIBO','Ingegneria Informatica',99.2,3.8,25.3,97.5),('Alma Mater Studiorum UNIBO','Psicologia dello Sviluppo',101.7,3.4,22.9,82.3),('Universita di Chieti UNICH','Psicologia dello Sviluppo',92.8,3.8,13.3,63),('Universita di Pisa UNIPI','Ingegneria Chimica',100,4.2,23.5,96.8),('Universita di Pisa UNIPI','Ingegneria Informatica',100.9,5,31,100);
/*!40000 ALTER TABLE `offertaformativa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `studente`
--

DROP TABLE IF EXISTS `studente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `studente` (
  `username` varchar(45) NOT NULL,
  `tipoScuola` varchar(45) DEFAULT NULL,
  `nomeScuola` varchar(45) DEFAULT NULL,
  `cittaScuola` varchar(45) DEFAULT NULL,
  `provinciaScuola` varchar(45) DEFAULT NULL,
  `annoFrequentato` int(11) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studente`
--

LOCK TABLES `studente` WRITE;
/*!40000 ALTER TABLE `studente` DISABLE KEYS */;
INSERT INTO `studente` VALUES ('minnie','Istituto Professionale della Moda','Walt Disney','Orlando','MI',4),('pluto','Liceo artistico','Walt Disney','Orlando','MI',5);
/*!40000 ALTER TABLE `studente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tutor`
--

DROP TABLE IF EXISTS `tutor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tutor` (
  `username` varchar(45) NOT NULL,
  `universita` varchar(45) NOT NULL,
  `corsoDiLaurea` varchar(50) NOT NULL,
  `annoIscrizione` year(4) NOT NULL,
  `annoFrequenza` int(11) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tutor`
--

LOCK TABLES `tutor` WRITE;
/*!40000 ALTER TABLE `tutor` DISABLE KEYS */;
INSERT INTO `tutor` VALUES ('gastone','Universita di Pisa UNIPI','Ingegneria Informatica',2016,3),('p','Universita di Pisa UNIPI','Ingegneria Chimica',2017,3),('paperone','Universita di Chieti UNICH','Psicologia dello Sviluppo',2017,2),('topolino','Universita di Pisa UNIPI','Ingegneria Chimica',2006,3);
/*!40000 ALTER TABLE `tutor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tutoraggio`
--

DROP TABLE IF EXISTS `tutoraggio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tutoraggio` (
  `utente` varchar(45) NOT NULL,
  `tutor` varchar(45) NOT NULL,
  `voto` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`utente`,`tutor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tutoraggio`
--

LOCK TABLES `tutoraggio` WRITE;
/*!40000 ALTER TABLE `tutoraggio` DISABLE KEYS */;
INSERT INTO `tutoraggio` VALUES ('minnie','p',4),('minnie','topolino',5);
/*!40000 ALTER TABLE `tutoraggio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `universita`
--

DROP TABLE IF EXISTS `universita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `universita` (
  `nomeAteneo` varchar(45) NOT NULL,
  `citta` varchar(45) NOT NULL,
  `link` varchar(90) DEFAULT NULL,
  `nMatricole` bigint(20) DEFAULT NULL,
  `miur` int(11) DEFAULT NULL,
  `censis` int(11) DEFAULT NULL,
  PRIMARY KEY (`nomeAteneo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `universita`
--

LOCK TABLES `universita` WRITE;
/*!40000 ALTER TABLE `universita` DISABLE KEYS */;
INSERT INTO `universita` VALUES ('Alma Mater Studiorum UNIBO','Bologna','https://www.unibo.it/it',87758,2,1),('Universita di Chieti UNICH','Chieti','https://www.unich.it/',24718,25,15),('Universita di Pisa UNIPI','Pisa','https://www.unipi.it/',45434,9,5);
/*!40000 ALTER TABLE `universita` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utente`
--

DROP TABLE IF EXISTS `utente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utente` (
  `e-mail` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `cognome` varchar(45) NOT NULL,
  `dataNascita` date NOT NULL,
  `tipo_utente` varchar(45) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `e-mail_UNIQUE` (`e-mail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utente`
--

LOCK TABLES `utente` WRITE;
/*!40000 ALTER TABLE `utente` DISABLE KEYS */;
INSERT INTO `utente` VALUES ('amministratore@muse.it','admin','admin','Admin','Admin','2020-08-07','admin'),('gastone@gastone.com','gastone','Gastone00','Gastone','Gastone','1997-07-01','tutor'),('minnie@minnie.it','minnie','Minnie00','Minnie','Minnie','2020-09-02','studente'),('p@p','p','Paperino00','Paperino','Paperino','2020-08-18','tutor'),('paperone@paperone.it','paperone','Paperone00','Paperone','Paperone','2020-09-08','tutor'),('pluto@pluto.it','pluto','Pluto000','Pluto','Pluto','2020-08-18','studente'),('topolino@topolino.com','topolino','Topolino00','Topolino','Topolino','2020-08-12','tutor');
/*!40000 ALTER TABLE `utente` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-09-18 11:38:12
