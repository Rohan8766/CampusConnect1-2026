<?php

session_start();

require_once "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare(
        "SELECT id, full_name, student_id,
                email, password
         FROM students
         WHERE email = ? OR student_id = ?"
    );

    $stmt->bind_param(
        "ss",
        $username,
        $username
    );

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $student = $result->fetch_assoc();

        if (
            password_verify(
                $password,
                $student["password"]
            )
        ) {

            $_SESSION["student_id"] =
                $student["id"];

            $_SESSION["student_name"] =
                $student["full_name"];

            header("Location: dashboard.php");

            exit();

        } else {

            $message =
                "Invalid username or password.";
        }

    } else {

        $message =
            "Invalid username or password.";
    }

    $stmt->close();
}

?>

<!DOCTYPE html>

<html>

<head>

    <title>Student Login</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="form-container">

    <h1>CampusConnect 2026</h1>

    <h2>STUDENT LOGIN</h2>

    <?php if ($message != ""): ?>

        <div class="error">
            <?php
            echo htmlspecialchars($message);
            ?>
        </div>

    <?php endif; ?>

    <form method="POST">

        <label>Email / Student ID</label>

        <input
            type="text"
            name="username"
            required
        >

        <label>Password</label>

        <input
            type="password"
            name="password"
            required
        >

        <button type="submit">
            LOGIN
        </button>

    </form>

    <p>
        New student?
        <a href="register.php">
            Register here
        </a>
    </p>

</div>

</body>

</html>
