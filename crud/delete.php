<?php
session_start();
include("../config/db.php");
if(!isset($_SESSION['user_id'])) header("Location: ../auth/login.php");

if(!isset($_GET['id'])) header("Location: ../dashboard.php");
$id = intval($_GET['id']);

if(isset($_POST['confirm'])){
    mysqli_query($conn,"DELETE FROM users WHERE id=$id");
    header("Location: ../dashboard.php");
    exit;
}

if(isset($_POST['cancel'])){
    header("Location: ../dashboard.php");
    exit;
}

$result = mysqli_query($conn,"SELECT * FROM users WHERE id=$id");
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head><title>Delete User</title></head>
<body>
<h2>Delete User</h2>
<p>Are you sure you want to delete <?php echo htmlspecialchars($user['name']); ?>?</p>
<form method="POST">
<button name="confirm">Yes, Delete</button>
<button name="cancel">Cancel</button>
</form>
</body>
</html>