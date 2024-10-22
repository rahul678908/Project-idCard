<?php
include('config.php');

$front_template = $_POST['front_template'];
$back_template = $_POST['back_template'];
$school_id = $_POST['school_id'];
$front_image = isset($_POST['front_image']) ? $_POST['front_image'] : null;
$back_image = isset($_POST['back_image']) ? $_POST['back_image'] : null;

// Prepare and bind
$stmt = $mysqli->prepare("INSERT INTO templates (front_design, back_design, front_image, back_image, school_id) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssssi", $front_template, $back_template, $front_image, $back_image, $school_id);

// Execute the statement
if ($stmt->execute()) {
    echo "Templates saved successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$mysqli->close();
?>