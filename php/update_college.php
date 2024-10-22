<?php
include('config.php');

// Check if the form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $schoolId = $_POST['id']; // Changed variable name to match 'school'
    $schoolName = $_POST['schoolName']; // Changed variable name
    $schoolAddress = $_POST['schoolAddress']; // Changed variable name
    $schoolEmail = $_POST['schoolEmail']; // Changed variable name
    $schoolContact = $_POST['schoolContact']; // Changed variable name

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE schools SET school_name = ?, school_address = ?, school_email = ?, school_contact = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $schoolName, $schoolAddress, $schoolEmail, $schoolContact, $schoolId);

    // Execute the statement
    if ($stmt->execute()) {
        echo "School updated successfully."; // Changed success message
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
