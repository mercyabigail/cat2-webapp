<?php
session_start(); require 'config.php';
if (!isset($_SESSION['user'])) { header("Location: login.php"); exit; }
$msg = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $stmt = $conn->prepare("INSERT INTO feedback (name,message) VALUES (?,?)");
  $stmt->bind_param("ss", $_POST['name'], $_POST['message']);
  $msg = $stmt->execute() ? "Feedback saved!" : "Error saving feedback.";
}
$rows = $conn->query("SELECT * FROM feedback ORDER BY id DESC");
?>
<!DOCTYPE html><html><body style="font-family:sans-serif;max-width:500px;margin:40px auto">
<h2>Feedback Form</h2><p><?= htmlspecialchars($msg) ?></p>
<form method="POST">
  <input name="name" placeholder="Your name" required><br><br>
  <textarea name="message" placeholder="Message" required></textarea><br><br>
  <button>Submit</button>
</form>
<h3>Submitted feedback</h3>
<table border="1" cellpadding="6"><tr><th>ID</th><th>Name</th><th>Message</th><th>Time</th></tr>
<?php while($r = $rows->fetch_assoc()): ?>
<tr><td><?= $r['id'] ?></td><td><?= htmlspecialchars($r['name']) ?></td>
<td><?= htmlspecialchars($r['message']) ?></td><td><?= $r['submitted_at'] ?></td></tr>
<?php endwhile; ?></table></body></html>
