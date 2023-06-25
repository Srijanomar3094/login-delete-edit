<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")

{
    // Retrieve the form data
  
    //$id = $_POST["id"];
    $name = $_POST["name"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    //$emai = $_POST["email"];
    $residence = $_POST["residence"];
    $gender = $_POST["gender"];
    //echo $gender;
    //$passwor = $_POST["password"];
    
    $em = $_POST["em"];
    //echo "$em";



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
    
    
//$name = test_input($_POST["name"]);
if (!preg_match("/^[a-zA-Z]/",$name)) {
    //echo <script> alert "Only letters allowed in name field, Enter again! ";
    echo "<script> alert('Only letters allowed in name field, Enter again!')</script>";
    exit();
  }
  
  //phone number check
  if(!preg_match('/^[0-9]{10}+$/', $phone)) {
    echo "<script> alert('Invalid phone number')</script>";
    exit();
  }
    // Update the user data in the table 
    $sql = "UPDATE new SET name='$name', address='$address', phone_no='$phone', residence='$residence', gender='$gender' WHERE email='$em'";
    if ($conn->query($sql) === TRUE) {
        echo "User data updated successfully.";
    } else {
        echo "Error updating user data: " . $conn->error;
    }
  

    // Close the connection
    $conn->close();
}
?>








