<?php

session_start();

if (!isset($_SESSION["student_id"])) {

    header("Location: login.php");

    exit();
}

$name = $_SESSION["student_name"];

?>

<!DOCTYPE html>

<html>

<head>

    <title>Welcome - CampusConnect 2026</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <h1>
        Welcome to CampusConnect!
    </h1>

    <h2>
        Hello,
        <?php echo htmlspecialchars($name); ?>!
    </h2>

    <p>
        You have successfully logged in.
    </p>

    <a href="logout.php" class="btn">
        LOGOUT
    </a>

</div>

</body>

</html>
