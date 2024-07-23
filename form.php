<?php
// Start PHP code
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create the database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "myDB";

    //connect to database
    $conn = new mysqli($servername, $username, $password, $dbname);

    //check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Get the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $passwd = $_POST['password'];
    $phone = $_POST['phone'];

    // Sanitize and validate input
    $name = $conn->real_escape_string($_POST["name"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $passwd = $conn->real_escape_string($_POST["password"]);
    $phone = $conn->real_escape_string($_POST["phone"]);

    // Hash the password
    $hashed_password = password_hash($passwd, PASSWORD_DEFAULT);

    // Use prepared statements to prevent SQL Injection
    if ($stmt = $conn->prepare("INSERT INTO users (name, email, password, phone) VALUES (?, ?, ?, ?)")) {
        $stmt->bind_param("ssss", $name, $email, $hashed_password, $phone);

        if ($stmt->execute()) {
            // Redirect to a success page
            // Ensure no output before this
            header("Location: success.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}
// Close PHP tag before starting HTML
?>
<!DOCTYPE html>
<html>
<head>
    <title>Form</title>
</head>
<body>
    <form action="" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="passwd" id="passwd" required>
        <br>
        <label for="phone">Phone:</label>
        <input type="tel" name="phone" id="phone" required>
        <br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>