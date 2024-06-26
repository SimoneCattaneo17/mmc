<?php
    session_start();
    session_destroy();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="./CSS/style.css">
    <script src="./JavaScript/script.js"></script>
</head>

<body>
    <section class="vh-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5">

                        <div class="text-center">
                            <h3 class="mb-5">Sign in</h3>
                        </div>

                        <form method="POST" action="homepage.php">
                            <div class="form-outline mb-4">
                                <label class="form-label" for="typeEmailX-2">Username:</label>
                                <input type="text" name="username" id="typeUser-2" class="form-control form-control-lg" />
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="typePasswordX-2">Password:</label>
                                <input type="password" name="password" id="typePasswordX-2" class="form-control form-control-lg" />
                            </div>

                            <div class="text-center">
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>