<?php
// Database connection details
$host = 'localhost';
$dbname = 'anime';
$user = 'root';
$password = '';

// Connect to MySQL database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $feedback = $_POST['feedback'];

    // Insert feedback into the database
    $sql = "INSERT INTO feedback (content) VALUES (:feedback)";
    $stmt = $pdo->prepare($sql);

    // Bind the feedback parameter
    $stmt->bindParam(':feedback', $feedback);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Feedback submitted successfully.";
    } else {
        echo "Error submitting feedback.";
    }
}
?>
