<?php
require 'db.php'; // your existing connection file

header('Content-Type: application/json');

// Read the JSON body sent by fetch()
$data = json_decode(file_get_contents("php://input"), true);

$name     = trim($data['name'] ?? '');
$studentId = trim($data['id'] ?? '');
$school   = trim($data['school'] ?? '');
$password = $data['password'] ?? '';

// Server-side validation (never trust the client alone)
if ($name === '' || $studentId === '' || $school === '' || $password === '') {
    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    exit;
}

if (strlen($password) < 8) {
    echo json_encode(['success' => false, 'message' => 'Password must be at least 8 characters.']);
    exit;
}

// Check if this ID is already registered
$stmt = $conn->prepare("SELECT id_pk FROM users WHERE student_id = ?");
$stmt->bind_param("s", $studentId);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'This ID is already registered.']);
    $stmt->close();
    exit;
}
$stmt->close();

// Hash the password — never store it plain
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert the new user
$stmt = $conn->prepare("INSERT INTO users (full_name, student_id, school, password, role) VALUES (?, ?, ?, ?, 'user')");
$stmt->bind_param("ssss", $name, $studentId, $school, $hashedPassword);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Registration failed. Try again.']);
}

$stmt->close();
$conn->close();