<?php
$fName = $_POST['fName'];
$lName = $_POST['lName'];
$email = $_POST['email'];
$password = $_POST['password'];
$username = $_POST['username'];
$areaCode = $_POST['areaCode'];

// if (isset($fName) || isset($lName) || isset($email) || isset($password) || isset($username) || isset($aCode)) {

//   echo $fName, $lName, $email, $password, $username, $aCode;

  if (!empty($fName) || !empty($lName) || !empty($email) || !empty($password) || !empty($username) || !empty($areaCode)) {
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "books";

    // $conn = new mysqli(, $dbUsername, $dbPassword, $dbName);
    $con = mysqli_connect("host","dbUsername","dbPassword","dbName");


    if (mysqli_connect_error()) {
      die('Connect Error(' . mysqli_connect_errno().')'. mysqli_connect_error());
    } else {

      $SELECT = "SELECT email From signupform WHERE email = ? LIMIT 1";
      $INSERT = "INSERT INTO signupform (firstname, lastname, email, password, username, area code) VALUES(?, ?, ?, ?, ?, ?)";
      $stmt = $conn->prepare($SELECT);
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $stmt->bind_result($email);
      $stmt->store_result();
      $rnum = $stmt->num_rows;

      if ($rnum == 0) {
        $stmt->close();

        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("ssssii", $fName, $lName, $email, $password, $username, $areaCode);
        $stmt->execute();
        echo "New record inserted successfully.";
      } else {
        echo "Someone already registered using this email.";
      }
      $stmt->close();
      $conn->close();
    }
    echo ("connection established");
  } else {
    echo "All fields are required";
    die();
  }
// }
?>
