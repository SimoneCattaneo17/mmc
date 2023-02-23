<!DOCTYPE html>
<html>

<head>
    <title>Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <?php
    require __DIR__ . '/functions.php';
    session_start();

    if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
        $name = $_SESSION['username'];
        $password = $_SESSION['password'];
        /*
        echo '
            <section class="vh-100" style="background-color: #508bfc;">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <div class="card shadow-2-strong" style="border-radius: 1rem;">
                                <div class="card-body p-5 text-center">

                                    <h3 class="mb-5">Creazione DVR Aziendale</h3>

                                    <form method="POST" action="homepage.php">
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="typeEmailX-2">Ragione sociale</label>
                                            <input type="text" name="username" id="typeUser-2" class="form-control form-control-lg" />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="typePasswordX-2">Password</label>
                                            <input type="password" name="password" id="typePasswordX-2" class="form-control form-control-lg" />
                                        </div>

                                        <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        ';
        */
        echo '
        <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-2-strong" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">

                    <h3 class="mb-5">Creazione DVR Aziendale</h3>

                    <form method="POST" action="homepage.php">
                        <div class="form-outline mb-4">
                            <label class="form-label" for="typeEmailX-2">Ragione sociale</label>
                            <input type="text" name="ragioneSociale" id="typeUser-2" class="form-control form-control-lg" />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="typePasswordX-2">Peso in Kg</label>
                            <input type="number" name="peso" id="typePasswordX-2" class="form-control form-control-lg" />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="typePasswordX-2">Altezza iniziale in cm</label>
                            <input name="altezzaIniziale" class="form-control form-control-lg" list="altIn" required />
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
                            <label class="form-label" for="typePasswordX-2">Distanza verticale in cm</label>
                            <input type="text" name="distanzaVerticale" id="typePasswordX-2" class="form-control form-control-lg" />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="typePasswordX-2">Distanza orizzontale in cm</label>
                            <input type="text" name="peso" id="typePasswordX-2" class="form-control form-control-lg" />
                        </div>

                        <button class="btn btn-primary btn-lg btn-block" type="submit">Invia</button>
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