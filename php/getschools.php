<?php
include('config.php'); // Include your database connection

// Fetch the list of schools from the database
$query = "SELECT id, school_name FROM schools";
$result = $conn->query($query);

// Check if any schools were found
if ($result->num_rows > 0) {
    $schools = array();

    // Fetch each school and add it to the array
    while($row = $result->fetch_assoc()) {
        $schools[] = array(
            "id" => $row['id'],
            "school_name" => $row['school_name']
        );
    }

    // Return the schools as a JSON response
    echo json_encode($schools);
} else {
    // If no schools are found, return an empty array
    echo json_encode([]);
}

// Close the database connection
$conn->close();
?>
