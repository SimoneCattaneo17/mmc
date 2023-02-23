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
                                    echo '</li>';
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
        ?>
    </body>