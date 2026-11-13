<?php session_start();
if (!isset($_SESSION['user'])) { header("Location: login.php"); exit; }
echo "<h2>Welcome, " . htmlspecialchars($_SESSION['user']) . "! Login successful.</h2>";
echo "<p><a href='feedback.php'>Feedback form</a> | <a href='login.php'>Logout</a></p>";
