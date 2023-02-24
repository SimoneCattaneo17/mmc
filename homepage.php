<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Homepage</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link href="./CSS/style.css">
        <script src="./JavaScript/script.js"></script>
    </head>
    <body>
        <?php
        require __DIR__ . '/functions.php';
        if(isset($_GET['peso'])) {
            $id_utente = $_SESSION['id'];
            $ragione = $_GET['ragioneSociale'];
            $peso = $_GET['peso'];
            $altezzaIniziale = $_GET['altezzaIniziale'];
            $distanzaVerticale = $_GET['distanzaVerticale'];
            $distanzaOrizzontale = $_GET['distanzaOrizzontale'];
            $dislocazione = $_GET['dislocazioneAngolare'];
            if($_GET['presa'] == "Buona") {
                $presa = true;
            }
            else {
                $presa = false;
            }
            $frequenza = $_GET['frequenza'];
            $durata = $_GET['durata'];
            $sql = "INSERT INTO dvr (id_utente, ragione, peso, altezzaIniziale, distanzaVerticale, distanzaOrizzontale, dislocazione, presa, frequenza, durata) VALUES ('$id_utente', '$ragione', '$peso', '$altezzaIniziale', '$distanzaVerticale', '$distanzaOrizzontale', '$dislocazione', '$presa', '$frequenza', '$durata')";
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
        if(isset($_POST['username']) || isset($_SESSION['id'])){
            if(isset($_POST['username'])) {
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['password'] = $_POST['password'];
            }

            $sql = 'SELECT id, username, pswd FROM utente';

            $result = connect($sql);

            if($result->num_rows > 0) {
                $found = false;
                while ($row = $result->fetch_assoc()) {
                    if($row['username'] == $_SESSION['username'] && $row['pswd'] == $_SESSION['password']) {
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['password'] = $row['pswd'];
                        echo '<header>';
                            echo '<nav class="navbar navbar-expand-lg navbar-light bg-white">';
                                echo '<div class="container-fluid">';
                                    echo '<div class="collapse navbar-collapse" id="navbarNav">';
                                        //left navbar items
                                        echo '<ul class="navbar-nav me-auto">';
                                            echo '<li class="nav-item">';
                                                echo '<a class="nav-link active" aria-current="page" href="new.php">New DVR</a>';
                                            echo '</li>';
                                        echo '</ul>';

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
        }
        else {
            header("refresh:5;url=index.php" );
            echo "You are not logged in<br>";
            echo "Redirecting...<br>";
            echo "If you are not redirected, click <a href='index.php'>here</a>";
        }

        //inserimento nuovo DVR nella tabella
        if(isset($_GET['peso'])) {
            $id_utente = $_SESSION['id'];
            $ragione = $_GET['ragioneSociale'];
            $peso = $_GET['peso'];

            $altezzaIniziale = $_GET['altezzaIniziale'];
            $distanzaVerticale = $_GET['distanzaVerticale'];
            $distanzaOrizzontale = $_GET['distanzaOrizzontale'];
            $dislocazione = $_GET['dislocazioneAngolare'];
            if($_GET['presa'] == "Buona") {
                $presa = true;
            }
            else {
                $presa = false;
            }
            $frequenza = $_GET['frequenza'];
            $durata = $_GET['durata'];

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

            $cp = 23;

            $pesoLimite = $cp * $fa * $fb * $fc * $fd * $fe * $ff;
            $sql = "INSERT INTO mmc_valutazione (id_utente, ragione, peso, altezzaIniziale, distanzaVerticale, distanzaOrizzontale, dislocazione, presa, frequenza, durata, pesoLimite) VALUES ('$id_utente', '$ragione', '$peso', '$altezzaIniziale', '$distanzaVerticale', '$distanzaOrizzontale', '$dislocazione', '$presa', '$frequenza', '$durata', '$pesoLimite')";
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
                                        echo '<th scope="col">Peso</th>';
                                        echo '<th scope="col">Altezza Iniziale</th>';
                                        echo '<th scope="col">Distanza Vert.</th>';
                                        echo '<th scope="col">Distanza Oriz.</th>';
                                        echo '<th scope="col">Dislocazione Ang.</th>';
                                        echo '<th scope="col">Presa</th>';
                                        echo '<th scope="col">Frequenza</th>';
                                        echo '<th scope="col">Durata</th>';
                                        echo '<th scope="col">Data Creazione</th>';
                                        if($_SESSION['operatore']) {
                                            echo '<th scope="col">Elimina</th>';
                                        }
                                    echo '</tr>';
                                echo '</thead>';
                                echo '<tbody>';
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<tr>';
                                            echo '<td>' . $row['ragione'] . '</td>';
                                            echo '<td>' . $row['peso'] . '</td>';
                                            echo '<td>' . $row['altezzaIniziale'] . '</td>';
                                            echo '<td>' . $row['distanzaVerticale'] . '</td>';
                                            echo '<td>' . $row['distanzaOrizzontale'] . '</td>';
                                            echo '<td>' . $row['dislocazione'] . '</td>';
                                            echo '<td>' . $row['presa'] . '</td>';
                                            echo '<td>' . $row['frequenza'] . '</td>';
                                            echo '<td>' . $row['durata'] . '</td>';
                                            echo '<td>' . $row['dataCreazione'] . '</td>';
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