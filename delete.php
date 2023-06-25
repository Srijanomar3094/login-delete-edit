<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "test";

// Establish a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize user input
function sanitize_input($input)
{
    global $conn;
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    $input = $conn->real_escape_string($input);
    return $input;
}

// Check if the delete button is clicked
if (isset($_POST["delete_user"])) {
    // Get the email and password of the user to be deleted
    // $ema = sanitize_input($_GET['ema']);
    // $password = sanitize_input($_POST["password"]);

    // Delete user data from the 'new' table
    // $delete_query = "DELETE FROM new WHERE email = '$email' AND password = '$password'";
    // if ($conn->query($delete_query) === TRUE) {
    //     echo "User data deleted successfully.";
    // } else {
    //     echo "Error deleting user data: " . $conn->error;
    // }
}

$ema = $_GET['ema'];
$query = "SELECT * FROM new WHERE email != '$ema' AND del != '0'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Output data of each row
    echo "Updated Table";
    echo "<table><tr><th>Name</th><th>Address</th><th>Phone_No</th><th>Email</th><th>Residence</th><th>Gender</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["name"] . "</td><td>" . $row["address"] . "</td><td>" . $row["phone_no"] . "</td><td>" . $row["email"] . "</td><td>" . $row["residence"] . "</td><td>" . $row["gender"] . "</td><td>
        <button><a href='delete.php?ema=$row[email]'>Delete</a></button></td><td>
        <button><a href='edithtml.php?ema=$row[email]'>Edit</a></button></td></tr>";
    }
    echo "</table>";
}

$quer = "UPDATE new SET del='0' WHERE email='$ema'";
$result = $conn->query($quer);
$conn->close();
?>
