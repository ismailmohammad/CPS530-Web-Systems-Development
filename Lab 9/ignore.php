<?php

// Database connection parameters
$servername = getenv("DB_SERVER");
$username = getenv("DB_USERNAME");
$password = getenv("DB_PASSWORD");
$dbname = getenv("DB_NAME");    

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the table already exists
$tableName = "photograph";
$tableCheckQuery = "SHOW TABLES LIKE '$tableName'";
$tableCheckResult = mysqli_query($conn, $tableCheckQuery);

if (mysqli_num_rows($tableCheckResult) == 0) {
    $createTableSQL = "CREATE TABLE $tableName (
        picture_number INT AUTO_INCREMENT PRIMARY KEY,
        subject VARCHAR(255) NOT NULL,
        location VARCHAR(255) NOT NULL,
        date_taken DATE NOT NULL,
        picture_url VARCHAR(255) NOT NULL
    )";
    if (mysqli_query($conn, $createTableSQL)) {
        echo "Table created successfully";
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }
    $imageData = array(
        array('Subject 1', 'Location 1', '2023-01-01', 'https://example.com/image1.jpg'),
        array('Subject 2', 'Location 2', '2023-02-02', 'https://example.com/image2.jpg'),
        array('Subject 3', 'Location 3', '2023-03-03', 'https://example.com/image3.jpg'),
        array('Subject 4', 'Location 4', '2023-04-04', 'https://example.com/image4.jpg'),
        array('Subject 5', 'Location 5', '2023-05-05', 'https://example.com/image5.jpg'),
        array('Subject 6', 'Location 6', '2023-06-06', 'https://example.com/image6.jpg'),
        array('Subject 7', 'Location 7', '2023-07-07', 'https://example.com/image7.jpg'),
        array('Subject 8', 'Location 8', '2023-08-08', 'https://example.com/image8.jpg'),
        array('Subject 9', 'Location 9', '2023-09-09', 'https://example.com/image9.jpg'),
        array('Subject 10', 'Location 10', '2023-10-10', 'https://example.com/image10.jpg')
    );

    // Insert sample data into the table
    foreach ($imageData as $data) {
        $insertSQL = "INSERT INTO $tableName (subject, location, date_taken, picture_url) VALUES (
            '" . $data[0] . "',
            '" . $data[1] . "',
            '" . $data[2] . "',
            '" . $data[3] . "'
        )";

        mysqli_query($conn, $insertSQL);
    }

    echo "Sample data inserted successfully";
} else {
    echo "Table already exists";
}

// Close connection
mysqli_close($conn);

?>
