<?php
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
function sanitize_input($input) {
    global $conn;
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    $input = $conn->real_escape_string($input);
    return $input;
}

// Check if the login form is submitted   
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and store the user input
    $email = sanitize_input($_POST["emaill"]);
    $password = sanitize_input($_POST["psw"]);

    // Retrieve user data based on the entered email and password
    $query = "SELECT * FROM new WHERE email = '$email'";
    $result = $conn->query($query);
   

    
        $row = $result->fetch_assoc();
        if ($result->num_rows > 0) {
            if (password_verify($password, $row['password'])){
            echo "User login successful";
       

        // Check if the user is an admin
        if ( $row["admin"] == '1') {
            // Check if delete button is clicked
            if (isset($_POST["delete_user"])) {
                // Delete user data from the 'new' table
                $delete_query = "DELETE FROM new WHERE email = '$email' AND password = '$password'";
                if ($conn->query($delete_query) === TRUE) {
                    echo "User data deleted successfully.";
                } else {
                    echo "Error deleting user data: " . $conn->error;
                }
            }

            // Display all data from the 'new' table
            $query = "SELECT * FROM new  WHERE del != '0'";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                // Output data of each row
                echo "<table><tr><th>Name</th><th>Address</th><th>Phone_No</th><th>Email</th><th>Residence</th><th>Gender</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["name"] . "</td><td>" . $row["address"] . "</td><td>" . $row["phone_no"] . "</td><td>" . $row["email"] . "</td><td>" . $row["residence"] . "</td><td>" . $row["gender"] . "</td><td>
                   
                    <button><a href='delete.php?ema=$row[email]'>Delete</a></button></td><td>
                    <button><a href='edithtml.php?ema=$row[email]'>Edit</a></button></td></tr>";
                }
                echo "</table>";
            } else {
                echo "No data available.";
            }
            
            // Display the delete button
            
            
        } else {
            // Display user's data only
            echo "<p>Welcome, " . $row["name"] . "!</p>";
            echo "<p>Email: " . $row["email"] . "</p>";
            echo "<p>Your address: " . $row["address"] . "</p>";
            echo "<p>Phone number: " . $row["phone_no"] . "</p>";
            echo "<p>Gender: " . $row["gender"] . "</p>";
            echo "<p>Residence: " . $row["residence"] . "</p>";
            echo "<button><a href='edithtml.php?ema=$row[email]'>Edit</a></button></td></tr>";
           
        }
    }
    else {
        // Invalid login credentials
        echo "Invalid email or password.";}
    }

         else {
        // Invalid login credentials
        echo "Invalid email or password.";
    }}


// Close the database connection
$conn->close();
?>


