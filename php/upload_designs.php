<?php
// Directory to store uploaded images
$uploadDir = '../bgimages/';

if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['image']['tmp_name'];
    $fileName = $_FILES['image']['name'];
    $fileType = $_POST['type']; // front or back

    // Get file extension and validate it
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

    if (!in_array($fileExtension, $allowedExtensions)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid file type. Only JPG, PNG, and GIF are allowed.']);
        exit;
    }

    // Validate file size (example: max 5MB)
    if ($_FILES['image']['size'] > 5 * 1024 * 1024) {
        echo json_encode(['status' => 'error', 'message' => 'File size exceeds the 5MB limit.']);
        exit;
    }

    // Create a unique file name to avoid overwriting
    $newFileName = uniqid() . '-' . preg_replace('/[^a-zA-Z0-9\.\-_]/', '', $fileName); // Sanitize file name

    // Specify where to move the uploaded file
    $destPath = $uploadDir . $newFileName;

    // Move the file to the uploads directory
    if (move_uploaded_file($fileTmpPath, $destPath)) {
        // Return the file path in JSON format
        echo json_encode(['status' => 'success', 'filePath' => $destPath]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error: Could not move the uploaded file.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error: There was an issue with the image upload.']);
}
?>
