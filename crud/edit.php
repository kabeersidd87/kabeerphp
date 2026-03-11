<?php
session_start();
include("../config/db.php");
if(!isset($_SESSION['user_id'])) header("Location: ../auth/login.php");

if(!isset($_GET['id'])) header("Location: ../dashboard.php");
$id = intval($_GET['id']);

$result = mysqli_query($conn,"SELECT * FROM users WHERE id=$id");
if(mysqli_num_rows($result)==0) header("Location: ../dashboard.php");
$user = mysqli_fetch_assoc($result);

// Uploads folder images
$dir = "../uploads/";
$files = array_diff(scandir($dir), ['.','..']);
$files = array_filter($files,function($f){ return preg_match('/\.(jpg|jpeg|png|avif)$/i',$f); });

// Update form
if(isset($_POST['update'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $image = $_POST['image'];

    mysqli_query($conn,"UPDATE users SET name='$name',email='$email',gender='$gender',image='$image' WHERE id=$id");
    header("Location: ../dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head><title>Edit User</title></head>
<body>
<h2>Edit User</h2>
<form method="POST">
<input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required><br><br>
<input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br><br>

Gender:
<input type="radio" name="gender" value="male" <?php if($user['gender']=='male') echo 'checked'; ?>> Male
<input type="radio" name="gender" value="female" <?php if($user['gender']=='female') echo 'checked'; ?>> Female
<input type="radio" name="gender" value="other" <?php if($user['gender']=='other') echo 'checked'; ?>> Other<br><br>

<label>Select Profile Image:</label>
<select name="image" required>
<?php foreach($files as $f){ 
$sel = $f==$user['image']?'selected':'';
echo "<option value='$f' $sel>$f</option>"; 
} ?>
</select><br><br>

<button name="update">Update User</button>
</form>
<p><a href="../dashboard.php">Back to Dashboard</a></p>
</body>
</html>