<?php
$fName = $_POST['fName'];
$lName = $_POST['lName'];
$email = $_POST['email'];
$password = $_POST['password'];
$username = $_POST['username'];
$areaCode = $_POST['areaCode'];

if (isset($fName) || isset($lName) || isset($email) || isset($password) || isset($username) || isset($aCode)) {

  echo $fName, $lName, $email, $password, $username, $areaCode;

  if (!empty($fName) || !empty($lName) || !empty($email) || !empty($password) || !empty($username) || !empty($areaCode)) {
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "books";

//Create Connection
    $conn = mysqli_connect($host,$dbUsername,$dbPassword,$dbName);

    //Check Connection
    if(! empty( $mysqli->error ) ){
      echo $mysqli->error;  // <- this is not a function call error()
   }
     else {
      //email can only be used once and signup information being called
      $SELECT = "SELECT email From books.signupform WHERE email = ? LIMIT 1";
      $INSERT = "INSERT INTO books.signupform (`firstname`, `lastname`, `email`, `password`, `username`, `area code`) VALUES(`$fName`, `$lName`, `$email`, `$password`, `$username`, `$areaCode`)";
      $stmt = $conn->prepare($SELECT);
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $stmt->bind_result($email);
      $stmt->store_result();
      $rnum = $stmt->num_rows;
      echo $fName, $lName, $email, $password, $username, $areaCode;
      
      // $result = mysql_query($query);
      // if (!$result) {
      //   die('Invalid query: ' . mysql_error());
      // }

      // if ($rnum == 0) {
      //   $stmt->close();
        try{
        $stmt = $conn->prepare($INSERT); 
        $stmt->bind_param("isssssi", $fName, $lName, $email, $password, $username, $areaCode);
        $stmt->execute();         
        }catch (exception $e){
          echo"error";
        }
        

        echo "New record inserted successfully.";
      // } else {
      //   echo "Someone already registered using this email.";
      // }
     
    }
    echo ("Connection established");
  } else {
    echo "All fields are required";
    die();
  }
  $stmt->close();
  $conn->close();
}
// }
?>
