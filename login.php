<?php
session_start(); require 'config.php';
$msg = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $stmt = $conn->prepare("SELECT password FROM users WHERE username=?");
  $stmt->bind_param("s", $_POST['username']); $stmt->execute();
  $row = $stmt->get_result()->fetch_assoc();
  if ($row && password_verify($_POST['password'], $row['password'])) {
    $_SESSION['user'] = $_POST['username']; header("Location: welcome.php"); exit;
  } else { $msg = "Invalid username or password."; }
}
?>
<!DOCTYPE html><html><body style="font-family:sans-serif;max-width:350px;margin:40px auto">
<h2>CAT2 Portal - Login</h2><p style="color:red"><?= htmlspecialchars($msg) ?></p>
<form method="POST">
  <input name="username" placeholder="Username" required><br><br>
  <input type="password" name="password" placeholder="Password" required><br><br>
  <button>Login</button>
</form><p><a href="signup.php">Sign up</a></p></body></html>
