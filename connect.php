<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "test";


$name = $_POST['name'];
$address = $_POST['address'];
$phone_no = $_POST['phone_no'];
$email = $_POST['email'];
$residence = $_POST['residence'];
$gender = $_POST['gender'];
$passwrd = $_POST['passwrd'];
$passwrd2 = $_POST['passwrd2'];



// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

//$name = test_input($_POST["name"]);
if (!preg_match("/^[a-zA-Z]/",$name)) {
  //echo <script> alert "Only letters allowed in name field, Enter again! ";
  echo "<script> alert('Only letters allowed in name field, Enter again!')</script>";
  exit();
}

//phone number check
if(!preg_match('/^[0-9]{10}+$/', $phone_no)) {
  echo "<script> alert('Invalid phone number')</script>";
  exit();
}

//$email = test_input($_POST["email"]);
// check if e-mail address is well-formed
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
 // echo 'Invalid email format  ';
 echo "<script> alert('Invalid email format!')</script>";
 exit();
}



// Check if email already exists
$checkEmailQuery = "SELECT email FROM new WHERE email = '$email'";
$result = mysqli_query($conn, $checkEmailQuery);
if (mysqli_num_rows($result) > 0) {
    echo "Email already exists.";
    mysqli_close($conn);
    exit();
}

// Validation of pasword (8,U,l,SS)
$uppercase = preg_match('@[A-Z]@', $passwrd);
$lowercase = preg_match('@[a-z]@', $passwrd);
$number    = preg_match('@[0-9]@', $passwrd);
$specialChars = preg_match('@[^\w]@', $passwrd);

if(!$uppercase || !$lowercase || !$number || !$specialChars ||strlen($passwrd) < 8 ||strlen($passwrd) > 15) {
    echo 'Password should be at least 8 and atmost 15 characters in length and should include at least one upper case,one lowercase, one number, and one special character.  Please Enter again!!';
   exit();}


//Password and Cnfrm passwrd check
if($passwrd != $passwrd2)
      {
        echo "<script> alert(' Please enter same password')</script>";
        exit();
    }


$passwordh = password_hash($passwrd, PASSWORD_BCRYPT);

$sql = "INSERT INTO new (name, address, phone_no, email, residence, gender, password,admin,del)
VALUES ('$name','$address','$phone_no','$email','$residence','$gender','$passwordh','0','1');";

if (mysqli_query($conn, $sql)){
  echo "New records created successfully";}
else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
?> 






