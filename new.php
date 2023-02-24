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

    if (isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['id'])) {
        $name = $_SESSION['username'];
        $password = $_SESSION['password'];
        echo '
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-2-strong" style="border-radius: 1rem;">
                <div class="card-body p-5">
                    <div class="text-center">
                        <h3 class="mb-5">Creazione DVR Aziendale</h3>
                    </div>

                    <form method="GET" action="homepage.php">
                        <div class="form-outline mb-4">
                            <label class="form-label" for="typeEmailX-2">Ragione sociale</label>
                            <input type="text" name="ragioneSociale" id="ragioneSociale" class="form-control form-control-lg" required />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label">Peso in Kg</label>
                            <input type="number" min="0" name="peso" class="form-control form-control-lg" required />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label">Altezza iniziale in cm</label>
                            <input type="number" min="0" name="altezzaIniziale" id="altezzaIniziale" class="form-control form-control-lg" list="altIn" required />
                            <datalist id="altIn">
            	                <option id="25" value="<25">
                                <option id="50" value=">=25 & <50">
                                <option id="75" value=">=50 & <75">
                                <option id="100" value=">=75 & <100">
                                <option id="125" value=">=100 & <125">
                                <option id="150" value=">=125 & <150">
                                <option id="175" value=">=150 & <175">
                                <option id="000" value=">=175">
                            </datalist>
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label">Distanza verticale in cm</label>
                            <input type="number" min="0" name="distanzaVerticale" id="distanzaVerticale" class="form-control form-control-lg" required />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="typePasswordX-2">Distanza orizzontale in cm</label>
                            <input type="number" min="0" name="distanzaOrizzontale" id="distanzaOrizzontale" class="form-control form-control-lg" required />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="typePasswordX-2">Dislocazione angolare in gradi</label>
                            <input type="number" min="0" max="360" name="dislocazioneAngolare" id="dislocazioneAngolare" class="form-control form-control-lg" required />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="typePasswordX-2">Presa sul carico</label>
                            <select name="presa" class="form-control form-control-lg" required>
                                <option value="Buona">Buona</option>
                                <option value="Scarsa">Scarsa</option>
                            </select>
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="typePasswordX-2">Frequenza operazione al minuto</label>
                            <input type="number" min="0" name="frequenza" id="frequenza" class="form-control form-control-lg" required />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="typePasswordX-2">Durata operazione in ore</label>
                            <input type="number" min="0.20" max="8.00" step="0.20" name="durata" id="durarata" class="form-control form-control-lg" required />
                        </div>

                        <div class="text-center">
                            <button class="btn btn-primary btn-lg btn-block" type="submit">Crea</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
        ';
    }
    else {
        header("refresh:5;url=index.php");
        echo "You are not logged in<br>";
        echo "Redirecting...<br>";
        echo "If you are not redirected, click <a href='index.php'>here</a>";
    }
    ?>
</body>