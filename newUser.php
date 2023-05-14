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
    if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['operatore']) && $_SESSION['operatore'] == 1) {
        echo '
        <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-2-strong" style="border-radius: 1rem;">
                <div class="card-body p-5">
                    <div class="text-center">
                        <h3 class="mb-5">Nuovo utente</h3>
                    </div>

                    <form method="POST" action="homepage.php">
                        <div class="form-outline mb-4">
                            <label class="form-label">Username</label>
                            <input type="text" name="newUser" id="newUser" class="form-control form-control-lg" required />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label">Password</label>
                            <input type="text" name="newPswd" id="newPswd" class="form-control form-control-lg" required />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label">Diritti di amministratore?</label>
                            <input type="checkbox" name="newRights" id="newRights" />
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
        header("refresh:5;url=index.php" );
        echo "You are not logged in<br>";
        echo "Redirecting...<br>";
        echo "If you are not redirected, click <a href='index.php'>here</a>";
    }
    ?>
</body>