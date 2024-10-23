<?php
include('config.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $schoolName = $_POST['schoolName']; // Changed variable name
    $schoolAddress = $_POST['schoolAddress']; // Changed variable name
    $schoolEmail = $_POST['schoolEmail']; // Changed variable name
    $schoolContact = $_POST['schoolContact']; // Changed variable name

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO schools (school_name, school_address, school_email, school_contact) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $schoolName, $schoolAddress, $schoolEmail, $schoolContact);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the school_creation.html with success message
        header("Location: ../college_creation.html?success=1"); // Updated redirect
        exit();
    } else {
        // Redirect with an error message
        header("Location: ../college_creation.html?error=" . urlencode($stmt->error)); // Updated redirect
        exit();
    }

    // Close statement and connection
    $stmt->close();
}

$conn->close();
?>
