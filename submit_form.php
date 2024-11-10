<!-- submit_form.php -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    // Validate input
    if (!empty($full_name) && !empty($email) && !empty($phone) && !empty($message)) {
        // Database connection
        $servername = "localhost";
        $username = "root"; // default username for XAMPP
        $password = ""; // default password for XAMPP
        $dbname = "Mantra_submit"; // Updated database name

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO portfolio (full_name, email, phone, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $full_name, $email, $phone, $message);

        // Execute the statement
        if ($stmt->execute()) {
            echo $full_name . ", thank you for your message!";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the connection
        $stmt->close();
        $conn->close();
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request method.";
}
?>
