<?php
session_start();

if (!isset($_SESSION["student_id"])) {
    header("Location: login.php");
    exit();
}

$full_name = $_SESSION["full_name"];
$email = $_SESSION["email"];
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Welcome | CampusConnect 2026</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<nav class="navbar">

    <div class="logo">
        Campus<span>Connect</span>
    </div>

    <a href="logout.php" class="logout-btn">
        Logout
    </a>

</nav>

<section class="welcome-section">

    <div class="welcome-card">

        <div class="success-icon">
            ✓
        </div>

        <span class="welcome-label">
            Login Successful
        </span>

        <h1>
            Welcome to <span>CampusConnect!</span>
        </h1>

        <p>
            Hello <strong><?php echo htmlspecialchars($full_name); ?></strong>,
            we're happy to have you with us.
        </p>

        <div class="student-info">

            <div>
                <small>Student</small>
                <strong>
                    <?php echo htmlspecialchars($full_name); ?>
                </strong>
            </div>

            <div>
                <small>Email</small>
                <strong>
                    <?php echo htmlspecialchars($email); ?>
                </strong>
            </div>

        </div>

        <div class="welcome-actions">

            <a href="index.php" class="secondary-btn">
                ← Home
            </a>

            <a href="logout.php" class="primary-btn">
                Logout
            </a>

        </div>

    </div>

</section>

<footer>
    © 2026 CampusConnect | Student Event Registration Portal
</footer>

</body>
</html>
