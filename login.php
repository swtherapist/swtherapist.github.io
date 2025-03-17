<?php
header('Content-Type: application/json');
$conn = new mysqli('localhost', 'username', 'password', 'database');

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed.']));
}

$email = $_POST['email'];
$password = $_POST['password'];

$query = $conn->prepare('SELECT * FROM users WHERE email = ? AND password = ?');
$query->bind_param('ss', $email, $password);
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    echo json_encode(['success' => true, 'message' => 'Login successful.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid credentials.']);
}
$query->close();
$conn->close();
?>
