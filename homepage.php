<!DOCTYPE html>
<html>
    <head>
        <title>Homepage</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>
    <body>
        <?php
        require __DIR__ . '/functions.php';

        if(isset($_POST['username']) && isset($_POST['password'])){
            $name = $_POST['username'];
            $password = $_POST['password'];

            $sql = 'SELECT username, pswd FROM utente';

            $result = connect($sql);

            if($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if($row['username'] == $name && $row['pswd'] == $password) {
                        session_start();
                        $_SESSION['username'] = $name;
                        $_SESSION['password'] = $password;
                        echo '<header>';
                            echo '<nav class="navbar navbar-expand-lg navbar-light bg-white">';
                                echo '<div class="container-fluid">';
                                    echo '<div class="collapse navbar-collapse" id="navbarNav">';
                                        echo '<ul class="navbar-nav">';
                                            echo '<li class="nav-item">';
                                                echo '<a class="nav-link active" aria-current="page" href="#">Home</a>';
                                            echo '</li>';
                                            echo '<li class="nav-item">';
                                                echo '<a class="nav-link" href="logout.php">Logout</a>';
                                            echo '</li>';
                                        echo '</ul>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</nav>';
                        echo '</header>';
                    }
                    else {
                        header("refresh:5;url=index.php" );
                        echo "Username and/or Password wrong<br>";
                        echo "Redirecting...<br>";
                        echo "If you are not redirected, click <a href='index.php'>here</a>";
                    }
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