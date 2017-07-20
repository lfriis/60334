<?php //sectiona.php

require_once 'login.php';

$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) die($conn->connect_error);

if (isset($POST_['fname']) &&
    isset($POST_['lname']) &&
    isset($POST_['user_code']) &&
    isset($POST_['created_date']) &&
    isset($POST_['email']) &&
    isset($POST_['password']))
{
  $fname        = get_post($conn, 'fname');
  $lname        = get_post($conn, 'lname');
  $user_code    = get_post($conn, 'user_code');
  $created_date = get_post($conn, 'created_date');
  $email        = get_post($conn, 'email');
  $password     = get_post($conn, 'password');

//PREPARE ("INSERT INTO user_codes VALUES (?,?,?,?,?,?)";
    $query = "INSERT INTO user_codes VALUES
      ('$fname', '$lname', '$user_code', '$created_date', '$email', '$password')";
    $result = $conn->query($query);

    if (!$result) echo "INSERT failed: $query </br>" . $conn->error . "</br></br>";
    else echo "Insert Successful";
  }

echo <<<_END

<form action="sectiona.php" method="post">
  First Name: <input type="text" name="fname" required/></br>
  Last Name:  <input type="text" name="lname" required/></br>
  User Type: <select></br>
              <option value="1" required/>User</option>
              <option value="2" required/>Admin</option>
             </select></br>
  E-mail: <input type="email" name="email" required/></br>
  Password: <input type="password" name="password" required/></br>
  <input type="submit" value="Submit">
</form>
_END;

?>
