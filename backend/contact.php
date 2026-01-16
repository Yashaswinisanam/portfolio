<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  exit;
}

$name    = trim($_POST["name"]);
$email   = trim($_POST["email"]);
$message = trim($_POST["message"]);

if ($name === "" || $email === "" || $message === "") {
  echo "All fields required.";
  exit;
}

$stmt = $conn->prepare(
  "INSERT INTO messages (name, email, message) VALUES (?, ?, ?)"
);

if (!$stmt) {
  echo "Prepare failed: " . $conn->error;
  exit;
}

$stmt->bind_param("sss", $name, $email, $message);

if ($stmt->execute()) {
  echo "success";
} else {
  echo "Insert failed: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

