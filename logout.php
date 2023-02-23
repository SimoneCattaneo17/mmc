<!DOCTYPE html>
<html>

<head>
    <title>Logout</title>
</head>

<body>
    <?php
    session_start();
    session_destroy();
    header("refresh:5;url=index.php");
    echo "You have been logged out<br>";
    echo "Redirecting...<br>";
    echo "If you are not redirected, click <a href='index.php'>here</a>";
    ?>
</body>

</html>