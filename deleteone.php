<?php
// Check if the form is submitted
error_reporting(E_ALL);
ini_set('display_errors',1);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Retrieve the form data
$id = $_POST["id"];
$name = $_POST["name"];
$address = $_POST["address"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$residence = $_POST["residence"];
$gender = $_POST["gender"];
$password = $_POST["password"];

// Perform the database update
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "test";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

// Update the user data in the table
$sql = " new SET name='$name', address='$address', phone_no='$phone', email='$email', residence='$residence', gender='$gender', password='$password' WHERE name='$name'";

if ($conn->query($sql) === TRUE) {
echo "User data updated successfully.";
} else {
echo "Error updating user data: " . $conn->error;
}

// Close the connection
$conn->close();
}
?>
