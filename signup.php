<?php
require 'config.php';
$msg = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $u = trim($_POST['username']); $e = trim($_POST['email']);
  $p = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $stmt = $conn->prepare("INSERT INTO users (username,email,password) VALUES (?,?,?)");
  $stmt->bind_param("sss", $u, $e, $p);
  $msg = $stmt->execute() ? "Registration successful for $u!" : "Error: username may already exist.";
}
?>
<!DOCTYPE html><html><body style="font-family:sans-serif;max-width:350px;margin:40px auto">
<h2>CAT2 Portal - Sign Up</h2><p><?= htmlspecialchars($msg) ?></p>
<form method="POST">
  <input name="username" placeholder="Username" required><br><br>
  <input type="email" name="email" placeholder="Email" required><br><br>
  <input type="password" name="password" placeholder="Password" required><br><br>
  <button>Sign Up</button>
</form><p><a href="login.php">Login</a></p></body></html>
