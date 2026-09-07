<?php

require_once "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $full_name = trim($_POST["full_name"]);
    $student_id = trim($_POST["student_id"]);
    $email = trim($_POST["email"]);
    $college_name = trim($_POST["college_name"]);
    $location = trim($_POST["location"]);
    $event_name = trim($_POST["event_name"]);
    $password = $_POST["password"];

    if (
        empty($full_name) ||
        empty($student_id) ||
        empty($email) ||
        empty($college_name) ||
        empty($location) ||
        empty($event_name) ||
        empty($password)
    ) {

        $message = "All fields are required.";

    } else {

        $hashed_password =
            password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare(
            "INSERT INTO students
            (full_name, student_id, email, college_name,
             location, event_name, password)
            VALUES (?, ?, ?, ?, ?, ?, ?)"
        );

        $stmt->bind_param(
            "sssssss",
            $full_name,
            $student_id,
            $email,
            $college_name,
            $location,
            $event_name,
            $hashed_password
        );

        if ($stmt->execute()) {

            $message =
                "Registration successful! You can now login.";

        } else {

            if ($conn->errno == 1062) {

                $message =
                    "Email or Student ID already registered.";

            } else {

                $message =
                    "Registration failed.";

            }
        }

        $stmt->close();
    }
}

?>

<!DOCTYPE html>

<html>

<head>

    <title>Student Registration</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="form-container">

    <h1>CampusConnect 2026</h1>

    <h2>Student Registration</h2>

    <?php if ($message != ""): ?>

        <div class="message">
            <?php echo htmlspecialchars($message); ?>
        </div>

    <?php endif; ?>

    <form method="POST">

        <label>Full Name</label>

        <input
            type="text"
            name="full_name"
            required
        >

        <label>Student ID</label>

        <input
            type="text"
            name="student_id"
            required
        >

        <label>Email</label>

        <input
            type="email"
            name="email"
            required
        >

        <label>College Name</label>

        <input
            type="text"
            name="college_name"
            required
        >

        <label>Location</label>

        <input
            type="text"
            name="location"
            required
        >

        <label>Event</label>

        <select name="event_name" required>

            <option value="">
                Select Event
            </option>

            <option value="Tech Fest 2026">
                Tech Fest 2026
            </option>

            <option value="Cultural Fest 2026">
                Cultural Fest 2026
            </option>

            <option value="Sports Meet 2026">
                Sports Meet 2026
            </option>

            <option value="Coding Competition 2026">
                Coding Competition 2026
            </option>

        </select>

        <label>Password</label>

        <input
            type="password"
            name="password"
            required
        >

        <button type="submit">
            REGISTER
        </button>

    </form>

    <p>
        Already registered?
        <a href="login.php">Student Login</a>
    </p>

</div>

</body>

</html>
