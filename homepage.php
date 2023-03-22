<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Homepage</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link href="./CSS/style.css">
        <link href="./CSS/font-awesome.css">
        <script src="./JavaScript/script.js"></script>
    </head>
    <body>
        <?php
        //non so se serve, dubito
        class valutazione {
            public $id;
            public $id_utente;
            public $ragione;
            public $peso;
            public $altezzaIniziale;
            public $distanzaVerticale;
            public $distanzaOrizzontale;
            public $dislocazione;
            public $presa;
            public $frequenza;
            public $durata;
        }

        require __DIR__ . '/functions.php';
        
        //controllo se l'utente è loggato
        if(isset($_POST['username']) || isset($_SESSION['id'])){
            if(isset($_POST['username'])) {
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['password'] = $_POST['password'];
            }

            $sql = 'SELECT id, username, pswd, operatore FROM mmc_utente';

            $result = connect($sql);

            if($result->num_rows > 0) {
                $found = false;
                while ($row = $result->fetch_assoc()) {
                    if($row['username'] == $_SESSION['username'] && $row['pswd'] == $_SESSION['password']) {
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['password'] = $row['pswd'];
                        $_SESSION['operatore'] = $row['operatore'];
                        echo '<header>';
                            echo '<nav class="navbar navbar-expand-lg navbar-light bg-white">';
                                echo '<div class="container-fluid">';
                                    echo '<div class="collapse navbar-collapse" id="navbarNav">';
                                        //left navbar items
                                        if($_SESSION['operatore']) {
                                            echo '<ul class="navbar-nav me-auto">';
                                                echo '<li class="nav-item">';
                                                    echo '<a class="nav-link active" aria-current="page" href="new.php">Nuova Valutazione</a>';
                                                echo '</li>';
                                            echo '</ul>';
                                        }

                                        //right navbar items
                                        echo '<ul class="navbar-nav ms-auto">';
                                            echo '<li class="nav-item">';
                                                echo '<a class="nav-link" href="logout.php">Logout</a>';
                                            echo '<li>';
                                        echo '</ul>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</nav>';
                        echo '</header>';
                        $found = true;
                    }
                }
                if(!$found) {
                    header("refresh:5;url=index.php" );
                    echo "Username and/or Password wrong<br>";
                    echo "Redirecting...<br>";
                    echo "If you are not redirected, click <a href='index.php'>here</a>";
                }
            }
            else {
                echo '<div class="alert alert-danger" role="alert">
                Nessun Documento trovato
                </div>';
            }
        }
        else {
            header("refresh:5;url=index.php" );
            echo "You are not logged in<br>";
            echo "Redirecting...<br>";
            echo "If you are not redirected, click <a href='index.php'>here</a>";
        }

        //inserimento nuovo documento nella tabella
        if(isset($_POST['peso'])) {
            $id_utente = $_SESSION['id'];
            if(isset($_POST['ragioneSociale'])){
                $ragione = $_POST['ragioneSociale'];
            }
            $peso = $_POST['peso'];
            $altezzaIniziale = $_POST['altezzaIniziale'];
            $distanzaVerticale = $_POST['distanzaVerticale'];
            $distanzaOrizzontale = $_POST['distanzaOrizzontale'];
            $dislocazione = $_POST['dislocazioneAngolare'];
            if($_POST['presa'] == "Buona") {
                $presa = true;
            }
            else {
                $presa = false;
            }
            $frequenza = $_POST['frequenza'];
            $durata = $_POST['durata'];
            $unaMano = $_POST['unaMano'];
            $duePersone = $_POST['duePersone'];

            switch(true) {
                case $altezzaIniziale <= 25:
                    $fa = 0.77;
                    break;
                case $altezzaIniziale > 25 && $altezzaIniziale < 50:
                    $fa = 0.85;
                    break;
                case $altezzaIniziale >= 50 && $altezzaIniziale < 75:
                    $fa = 0.93;
                    break;
                case $altezzaIniziale >= 75 && $altezzaIniziale < 100:
                    $fa = 1.00;
                    break;
                case $altezzaIniziale >= 100 && $altezzaIniziale < 125:
                    $fa = 0.93;
                    break;
                case $altezzaIniziale >= 125 && $altezzaIniziale < 150:
                    $fa = 0.85;
                    break;
                case $altezzaIniziale >= 150 && $altezzaIniziale < 175:
                    $fa = 0.78;
                    break;
                case $altezzaIniziale > 175:
                    $fa = 0;
                    break;
            }

            switch(true){
                case $distanzaVerticale <= 25:
                    $fb = 1;
                    break;
                case $distanzaVerticale > 25 && $distanzaVerticale <= 30:
                    $fb = 0.97;
                    break;
                case $distanzaVerticale > 30 && $distanzaVerticale <= 40:
                    $fb = 0.93;
                    break;
                case $distanzaVerticale > 40 && $distanzaVerticale <= 50:
                    $fb = 0.91;
                    break;
                case $distanzaVerticale > 50 && $distanzaVerticale <= 70:
                    $fb = 0.88;
                    break;
                case $distanzaVerticale > 70 && $distanzaVerticale <= 100:
                    $fb = 0.87;
                    break;
                case $distanzaVerticale > 100 && $distanzaVerticale <= 175:
                    $fb = 0.86;
                    break;
                case $distanzaVerticale > 175:
                    $fb = 0;
                    break;
            }

            switch(true){
                case $distanzaOrizzontale <= 25:
                    $fc = 1;
                    break;
                case $distanzaOrizzontale > 25 && $distanzaOrizzontale <= 30:
                    $fc = 0.83;
                    break;
                case $distanzaOrizzontale > 30 && $distanzaOrizzontale <= 40:
                    $fc = 0.63;
                    break;
                case $distanzaOrizzontale > 40 && $distanzaOrizzontale <= 50:
                    $fc = 0.50;
                    break;
                case $distanzaOrizzontale > 50 && $distanzaOrizzontale <= 55:
                    $fc = 0.45;
                    break;
                case $distanzaOrizzontale > 55 && $distanzaOrizzontale <= 63:
                    $fc = 0.42;
                    break;
                case $distanzaOrizzontale > 63:
                    $fc = 0;
                    break;
            }

            switch(true){
                case $dislocazione == 0:
                    $fd = 1;
                    break; 
                case $dislocazione > 0 && $dislocazione <= 30:
                    $fd = 0.90;
                    break;
                case $dislocazione > 30 && $dislocazione <= 60:
                    $fd = 0.81;
                    break;
                case $dislocazione > 60 && $dislocazione <= 90:
                    $fd = 0.71;
                    break;
                case $dislocazione > 90 && $dislocazione <= 120:
                    $fd = 0.52;
                    break;
                case $dislocazione > 120 && $dislocazione <= 135:
                    $fd = 0.57;
                    break;
                case $dislocazione > 135:
                    $fd = 0;
                    break;
            }

            switch(true){
                case $presa == true:
                    $fe = 1;
                    break;
                case $presa == false:
                    $fe = 0.90;
                    break;
            }

            switch(true){
                case $durata <= 1:
                    switch(true){
                        case $frequenza <= 1:
                            $ff = 1;
                            break;
                        case $frequenza > 1 && $frequenza <= 4:
                            $ff = 0.94;
                            break;
                        case $frequenza > 4 && $frequenza <= 6:
                            $ff = 0.84;
                            break;
                        case $frequenza > 6 && $frequenza <= 9:
                            $ff = 0.75;
                            break;
                        case $frequenza > 9 && $frequenza <= 12:
                            $ff = 0.52;
                            break;
                        case $frequenza > 12 && $frequenza <= 15:
                            $ff = 0.37;
                            break;
                        case $frequenza > 15:
                            $ff = 0;
                            break;
                    }
                    break;
                case $durata > 1 && $durata <= 2:
                    switch(true){
                        case $frequenza <= 1:
                            $ff = 0.95;
                            break;
                        case $frequenza > 1 && $frequenza <= 4:
                            $ff = 0.88;
                            break;
                        case $frequenza > 4 && $frequenza <= 6:
                            $ff = 0.72;
                            break;
                        case $frequenza > 6 && $frequenza <= 9:
                            $ff = 0.50;
                            break;
                        case $frequenza > 9 && $frequenza <= 12:
                            $ff = 0.30;
                            break;
                        case $frequenza > 12 && $frequenza <= 15:
                            $ff = 0.21;
                            break;
                        case $frequenza > 15:
                            $ff = 0;
                            break;
                    }
                    break;
                case $durata > 2 && $durata <= 8:
                    switch(true){
                        case $frequenza <= 1:
                            $ff = 08.95;
                            break;
                        case $frequenza > 1 && $frequenza <= 4:
                            $ff = 0.75;
                            break;
                        case $frequenza > 4 && $frequenza <= 6:
                            $ff = 0.45;
                            break;
                        case $frequenza > 6 && $frequenza <= 9:
                            $ff = 0.27;
                            break;
                        case $frequenza > 9 && $frequenza <= 12:
                            $ff = 0.15;
                            break;
                        case $frequenza > 12:
                            $ff = 0;
                            break;
                    }
                    break;
            }

            if($unaMano == "on"){
                $fg = 0.6;
                $unaMano = 1;
            }
            else {
                $fg = 1;
                $unaMano = 0;
            }

            if($duePersone == "on") {
                $fh = 2;
                $fi = 0.85;
                $duePersone = 1;
            }
            else {
                $fh = 1;
                $fi = 1;
                $duePersone = 0;
            }

            $cp = 23;

            $pesoLimite = $cp * $fa * $fb * $fc * $fd * $fe * $ff * $fg / $fh * $fi;
            
            if(isset($_GET['modifica']) && $_GET['modifica'] == 'true'){
                $idRow = $_GET['idModifica'];
                $sql = "UPDATE mmc_valutazione SET peso = '$peso', altezzaIniziale = '$altezzaIniziale', distanzaVerticale = '$distanzaVerticale', distanzaOrizzontale = '$distanzaOrizzontale', dislocazione = '$dislocazione', presa = '$presa', frequenza = '$frequenza', durata = '$durata', unaMano = '$unaMano', duePersone = '$duePersone', pesoLimite = '$pesoLimite' WHERE id = '$idRow'";
            }
            else {
                $sql = "INSERT INTO mmc_valutazione (id_utente, ragione, peso, altezzaIniziale, distanzaVerticale, distanzaOrizzontale, dislocazione, presa, frequenza, durata, unaMano, duePersone, pesoLimite) VALUES ('$id_utente', '$ragione', '$peso', '$altezzaIniziale', '$distanzaVerticale', '$distanzaOrizzontale', '$dislocazione', '$presa', '$frequenza', '$durata', '$unaMano', '$duePersone', '$pesoLimite')";
            }
            $result = connect($sql);
            if($result) {
                echo '<div class="alert alert-success" role="alert">
                DVR creato con successo!
                </div>';
            }
            else {
                echo '<div class="alert alert-danger" role="alert">
                Errore durante la creazione del DVR!
                </div>';
            }
        }

        //eliminazione valutazione
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "DELETE FROM mmc_valutazione WHERE id = '$id'";
            $result = connect($sql);
            if($result) {
                echo '<div class="alert alert-success" role="alert">
                DVR eliminato con successo!
                </div>';
            }
            else {
                echo '<div class="alert alert-danger" role="alert">
                Errore durante l\'eliminazione del DVR!
                </div>';
            }
        }

        //visualizzazione valutazioni
        if(isset($_SESSION['id'])) {
            $username = $_SESSION['username'];
            if($_SESSION['operatore']) {
                $sql = "SELECT * FROM mmc_valutazione";
            }
            else {
                $sql = "SELECT * FROM mmc_valutazione WHERE ragione = '$username'";
            }
            $result = connect($sql);
            if($result->num_rows > 0) {
                echo '<div class="container">';
                    echo '<div class="row">';
                        echo '<div class="col">';
                            echo '<table class="table table-striped">';
                                echo '<thead>';
                                    echo '<tr>';
                                        echo '<th scope="col">Ragione Sociale</th>';
                                        echo '<th scope="col">Indice di Sollevamento</th>';
                                        echo '<th scope="col">Peso</th>';
                                        echo '<th scope="col">Altezza Iniziale</th>';
                                        echo '<th scope="col">Distanza Vert.</th>';
                                        echo '<th scope="col">Distanza Oriz.</th>';
                                        echo '<th scope="col">Dislocazione Ang.</th>';
                                        echo '<th scope="col">Presa</th>';
                                        echo '<th scope="col">Una mano</th>';
                                        echo '<th scope="col">Due Persone</th>';
                                        echo '<th scope="col">Frequenza</th>';
                                        echo '<th scope="col">Durata</th>';
                                        echo '<th scope="col">Data Creazione</th>';
                                        if($_SESSION['operatore']) {
                                            echo '<th scope="col">Modifica</th>';
                                        }
                                        if($_SESSION['operatore']) {
                                            echo '<th scope="col">Elimina</th>';
                                        }
                                    echo '</tr>';
                                echo '</thead>';
                                echo '<tbody>';
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<tr>';
                                            echo '<td>' . $row['ragione'] . '</td>';
                                            echo '<td>' . $row['peso'] / $row['pesoLimite'] . '</td>';
                                            echo '<td>' . $row['peso'] . '</td>';
                                            echo '<td>' . $row['altezzaIniziale'] . '</td>';
                                            echo '<td>' . $row['distanzaVerticale'] . '</td>';
                                            echo '<td>' . $row['distanzaOrizzontale'] . '</td>';
                                            echo '<td>' . $row['dislocazione'] . '</td>';
                                            if($row['presa'] == 1) {
                                                echo '<td>Buona</td>';
                                            }
                                            else {
                                                echo '<td>Scarsa</td>';
                                            }
                                            if($row['unaMano'] == 1) {
                                                echo '<td>Si</td>';
                                            }
                                            else {
                                                echo '<td>No</td>';
                                            }
                                            if($row['duePersone'] == 1) {
                                                echo '<td>Si</td>';
                                            }
                                            else {
                                                echo '<td>No</td>';
                                            }
                                            echo '<td>' . $row['frequenza'] . '</td>';
                                            echo '<td>' . $row['durata'] . '</td>';
                                            echo '<td>' . $row['dataCreazione'] . '</td>';
                                            if($_SESSION['operatore']) {
                                                echo '<td><a href="edit.php?id=' . $row['id'] . '&ragione=' . $row['ragione'] . '"><i class="fa-solid fa-edit">modifica</i></a></td>';
                                            }
                                            if($_SESSION['operatore']) {
                                                echo '<td><a href="homepage.php?id=' . $row['id'] . '"><i class="fa-solid fa-trash-can">elimina</i></a></td>';
                                            }
                                        echo '</tr>';
                                    }
                                echo '</tbody>';
                            echo '</table>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            }
            else {
                echo '<div class="alert alert-warning" role="alert">
                Nessun DVR presente!
                </div>';
            }
        }
        ?>
    </body>