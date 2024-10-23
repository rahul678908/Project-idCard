<?php

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve template data from POST request
    $front_design = isset($_POST['front_design']) ? $_POST['front_design'] : '';
    $back_design = isset($_POST['back_design']) ? $_POST['back_design'] : '';
    $school_id = isset($_POST['school_id']) ? $_POST['school_id'] : '';

    // Get the image paths from the POST request
    $front_image = isset($_POST['front_image']) ? $_POST['front_image'] : '';
    $back_image = isset($_POST['back_image']) ? $_POST['back_image'] : '';

    // Save the template and image paths to the database
    $stmt = $conn->prepare("INSERT INTO templates (school_id, front_design, back_design, front_image, back_image) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $school_id, $front_design, $back_design, $front_image, $back_image);

    if ($stmt->execute()) {
        echo "Template saved successfully!";
    } else {
        echo "Error saving template: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
