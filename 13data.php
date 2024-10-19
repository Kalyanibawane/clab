<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "zxcv1234";
$dbname = "mehndi_appointments";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO contacts (name, mobile, email, message) VALUES (?, ?, ?, ?)");

    if ($stmt === false) {
        die("Error preparing the statement: " . $conn->error);
    }

    $stmt->bind_param("ssss", $name, $mobile, $email, $message);

    // Execute and check for errors
    if ($stmt->execute()) {
        echo "Data inserted successfully!";
    } else {
        echo "Error inserting data: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
