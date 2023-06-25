<?php


$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "test";

$emai = $_GET['ema'];
//$n = $_GET['n'];
//$a = $_GET['a'];
//$p = $_GET['p'];
//$r = $_GET['r'];
//$g = $_GET['g'];


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

    // Sanitize and store the user inpu);

    // Retrieve user data based on the entered email and password
    $query = "SELECT * FROM new WHERE email = '$emai'";
    $result = $conn->query($query);
   

    
        $row = $result->fetch_assoc();

        $n= $row["name"];
        $a= $row["address"];
        $p= $row["phone_no"];
        $g= $row["gender"];
        $r= $row["residence"];
        
      









    ?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit User Information</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            max-width: 350px;
            margin: 0 auto;
        }

        label {
            margin-top: 10px;
        }

        input, select {
            margin-top: 5px;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #46c2d3;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a08e;
        }
    </style>

</head>
<body>
    <h1>Edit User Information</h1>
    <form action="edit.php" method="post">
        <input type="hidden" name="id" value="<?php echo"$n" ?>">
        
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo"$n" ?>" required>
        
        <label for="address">Address:</label>
        <input type="text" name="address" id="address" value="<?php echo"$a" ?>"  required>
       
        <label for="phone">Phone Number:</label>
        <input type="text" name="phone" id="phone" value="<?php echo"$p" ?>" required>
       <!--<label for="email">Email:</label>
        <input type="text" name="email" id="email" required>-
        
        <label for="residence">Residence:</label>
        <input type="text" name="residence" id="residence" required>-->

        <label for="residence">Residence:</label>
        <select name="residence" id="residence" value="<?php echo"$r" ?>" required>
            <option value="Hostel">Hostel</option>
            <option value="PG">PG</option>
            <option value="Dayscholar">Dayscholar</option>
        </select>

        <label for="gender">Gender:</label>
        <select name="gender" id="gender" value="<?php echo"$g" ?>" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select>
        <!--<label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <input type="submit" value="Update">--> 
    
        <input type="hidden" name="em" value="<?php echo"$emai" ?>">
  <button type="submit" style="height:30px; background-color:skyblue;">Submit</button>

   
   
        
    </form>
</body>
</html>







