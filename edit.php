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
    if (isset($_GET['id']) && isset($_GET['ragione'])) {
        $id = $_GET['id'];
        $ragione = $_GET['ragione'];
        echo '
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-2-strong" style="border-radius: 1rem;">
                <div class="card-body p-5">
                    <div class="text-center">
                        <h3 class="mb-5">Modifica documento</h3>
                    </div>

                    <form method="POST" action="homepage.php?modifica=true&ragione=' . $ragione . '&idModifica=' . $id . '">

                        <div class="form-outline mb-4">
                            <label class="form-label">Peso in Kg</label>
                            <input type="number" min="0" name="peso" class="form-control form-control-lg" required />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label">Altezza iniziale in cm</label>
                            <input type="number" min="0" name="altezzaIniziale" id="altezzaIniziale" class="form-control form-control-lg" list="altIn" required />
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
                            <input type="number" name="durata" id="durata" value="Sollevato con una mano?" class="form-control form-control-lg" required />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="typePasswordX-2">Sollevato con una mano?</label>
                            <input type="checkbox" name="unaMano" id="unaMano" />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="typePasswordX-2">Sollevato con una mano?</label>
                            <input type="checkbox" name="duePersone" id="duePersone" />
                        </div>

                        <div class="text-center">
                            <button class="btn btn-primary btn-lg btn-block" type="submit">Modifica</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
        ';
    } else {
        header("refresh:5;url=index.php");
        echo "You are not logged in<br>";
        echo "Redirecting...<br>";
        echo "If you are not redirected, click <a href='index.php'>here</a>";
    }
    ?>
</body>

</html>