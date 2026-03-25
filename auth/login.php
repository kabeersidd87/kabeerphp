<?php
session_start();
include("../config/db.php");

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $pass  = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn,$query);

    if($result && mysqli_num_rows($result) == 1){
        $user = mysqli_fetch_assoc($result);
        if(password_verify($pass,$user['password'])){
            $_SESSION['user_id'] = $user['id'];
            header("Location: ../dashboard.php");
            exit;
        } else {
            $_SESSION['error'] = "Invalid email or password";
        }
    } else {
        $_SESSION['error'] = "Invalid email or password";
    }
}
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
<h2>Login</h2>
<!-- change for github not needed for code -->
 <h2>git check</h2>
 <!-- second change -->
  <h2>git check2</h2>
<?php if($error) echo "<p style='color:red;'>$error</p>"; ?>
<form method="POST">
<input type="email" name                                                                                                                                                                                                                                                        ="email" placeholder="Email" required><br><br>
<input type="password" name="password" placeholder="Password" required><br><br>
<button name="login">Login</button>
</form>
<p>Don't have account? <a href="signup.php">Sign Up</a></p>
</body>
</html>