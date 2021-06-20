
<nav>
    <a href="home.php">Home</a>
    <a href="areaDiRicerca.php" >Area Di Ricerca</a>
    <a href="../html/GuidaEFaq.html">Serve aiuto?</a>
    <span id="navOpener" onclick="openNav()">
        <img id ="profile_photo" alt="login" src=
             <?php
             if(isLogged())
                 echo '"../img/lettere/' . $_SESSION['username'][0] .'.jpg"';
             else
                 echo '"../img/login.jpg"';
             ?>
        >
    </span>
</nav>

<div id="login" class="sidenav">
    <p class="closebtn" onclick="closeNav()">&times;</p>
    <?php
        if (isLogged()) {
            echo '<a href="paginaPersonale.php">Il Mio MUSE</a>';
            echo '<a href="logout.php">Logout</a>';
        }    
        else {
            echo '<a href="loginForm.php">Accedi</a>';
            echo '<a href="registrazioneForm.php">Registrati</a>';
        }    
    ?>  
</div>