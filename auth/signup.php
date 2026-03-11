<?php
session_start();
include("../config/db.php");

if(isset($_POST['signup'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Default avatar
    $imageName = "avatar.png";

    $query = "INSERT INTO users(name,email,gender,password,image)
              VALUES('$name','$email','$gender','$pass','$imageName')";
    mysqli_query($conn,$query);

    $_SESSION['success'] = "Account created successfully!";
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head><title>Sign Up</title></head>
<body>
<h2>Sign Up</h2>
<form method="POST">
<input type="text" name="name" placeholder="Full Name" required><br><br>
<input type="email" name="email" placeholder="Email" required><br><br>
<input type="password" name="password" placeholder="Password" required><br><br>
Gender:
<input type="radio" name="gender" value="male" required> Male
<input type="radio" name="gender" value="female"> Female
<input type="radio" name="gender" value="other"> Other<br><br>
<button name="signup">Register</button>
</form>
<p>Already have account? <a href="login.php">Login</a></p>
</body>
</html>