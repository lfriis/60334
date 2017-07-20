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

    $query = "INSERT INTO user_codes VALUES (?,?,?,?,?,?)";
    $stmt =  mysqli_prepare($conn, $query);
    mysqli_execute($stmt);
    mysqli_stmt_close($stmt);

    if (!$stmt) echo "INSERT failed: $query </br>" . $conn->error . "</br></br>";
    else echo "Insert Successful";
  }

echo <<<_END

<form action="sectiona.php" method="post"><pre>
  First Name: <input type="text" name="fname" required/></br>
  Last Name:  <input type="text" name="lname" required/></br>
  User Type: <select></br>
              <option value="user" required/>User</option>
              <option value="admin" required/>Admin</option>
             </select></br>
  E-mail: <input type="email" name="email" required/></br>
  Password: <input type="password" name="password" required/></br>
  <input type="submit" value="Submit">
</pre></form>
_END;

$conn->close();

function get_post($conn, $var)
{
  return $conn->real_escape_string($_POST[$var]);
}
?>
