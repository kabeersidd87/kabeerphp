<?php
session_start();
include("../config/db.php");
if(!isset($_SESSION['user_id'])) header("Location: ../auth/login.php");

// Uploads folder images
$dir = "../uploads/";
$files = array_diff(scandir($dir), ['.','..']);
$files = array_filter($files,function($f){ return preg_match('/\.(jpg|jpeg|png|avif)$/i',$f); });

// Form submission
if(isset($_POST['add'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $pass = password_hash($_POST['password'],PASSWORD_DEFAULT);
    $image = $_POST['image'];

    mysqli_query($conn,"INSERT INTO users(name,email,gender,password,image)
        VALUES('$name','$email','$gender','$pass','$image')");
    header("Location: ../dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head><title>Add User</title></head>
<body>
<h2>Add User</h2>
<form method="POST">
<input type="text" name="name" placeholder="Name" required><br><br>
<input type="email" name="email" placeholder="Email" required><br><br>
<input type="password" name="password" placeholder="Password" required><br><br>

Gender:
<input type="radio" name="gender" value="male" required> Male
<input type="radio" name="gender" value="female"> Female
<input type="radio" name="gender" value="other"> Other<br><br>

<label>Select Profile Image:</label>
<select name="image" required>
<?php foreach($files as $f){ echo "<option value='$f'>$f</option>"; } ?>
</select><br><br>

<button name="add">Add User</button>
</form>
<p><a href="../dashboard.php">Back to Dashboard</a></p>
</body>
</html>