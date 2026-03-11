<?php
session_start();
include("config/db.php");
if(!isset($_SESSION['user_id'])) header("Location: auth/login.php");

$result = mysqli_query($conn,"SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<style>
table{border-collapse:collapse;width:100%;}
th,td{border:1px solid #ddd;padding:8px;text-align:center;}
img{width:60px;height:60px;border-radius:50%;object-fit:cover;}
</style>
</head>
<body>
<h2>Dashboard</h2>
<a href="crud/add.php">Add User</a> | <a href="auth/logout.php">Logout</a>
<table>
<tr>
<th>ID</th><th>Name</th><th>Email</th><th>Gender</th><th>Image</th><th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['gender']; ?></td>
<td>
<?php $image = $row['image'] ?: "avatar.png"; ?>
<img src="uploads/<?php echo $image; ?>">
</td>
<td>
<a href="crud/edit.php?id=<?php echo $row['id']; ?>">Edit</a> | 
<a href="crud/delete.php?id=<?php echo $row['id']; ?>">Delete</a>
</td>
</tr>
<?php } ?>

</table>
</body>
</html>