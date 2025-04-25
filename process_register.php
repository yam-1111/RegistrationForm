<?php
session_start();
header('Content-Type: application/json');

$errors = [];

function sanitize($value) {
    return htmlspecialchars(trim($value));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = sanitize($_POST['fullname'] ?? '');
    $email = sanitize($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $gender = sanitize($_POST['gender'] ?? '');
    $terms = isset($_POST['terms']);

    // Validate
    if (!$fullname || !$email || !$password || !$confirm_password || !$gender || !$terms) {
        $errors[] = "All fields are required and terms must be accepted.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters.";
    }
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }


    // Check user existing
    $file = 'users.json';
    $users = [];
    if (file_exists($file)) {
        $jsonContents = file_get_contents($file);
        if ($jsonContents !== false) {
            $users = json_decode($jsonContents, true) ?? [];
        }
    }
    foreach ($users as $user) {
        if (isset($user['email']) && $user['email'] === $email) {
            $errors[] = "Email already registered.";
            break;
        }
    }

    // Profile picture
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === 0) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
        $file_type = $_FILES['profile_picture']['type'];
        $file_size = $_FILES['profile_picture']['size'];

        if (!in_array($file_type, $allowed_types)) {
            $errors[] = "Profile picture must be JPG, PNG, or JPEG.";
        }
        if ($file_size > 2 * 1024 * 1024) {
            $errors[] = "Profile picture must be under 2MB.";
        }
    } else {
        $errors[] = "Please upload a profile picture.";
    }

    if (!empty($errors)) {
        echo json_encode(['success' => false, 'errors' => $errors]);
        exit;
    }

    // save profile picture
    $upload_dir = 'uploads';
    if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);
    $filename = uniqid() . '_' . basename($_FILES['profile_picture']['name']);
    $target_path = $upload_dir . '/' . $filename;
    move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_path);

    // save to json
    $user_data = [
        'fullname' => $fullname,
        'email' => $email,
        'gender' => $gender,
        'profile_picture' => $target_path,
        'password_hash' => password_hash($password, PASSWORD_DEFAULT)
    ];

    $file = 'users.json';
    $users = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    $users[] = $user_data;
    file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));

    // save session
    $_SESSION['user'] = [
        'fullname' => $fullname,
        'email' => $email,
        'profile_picture' => $target_path
    ];

    echo json_encode(['success' => true]);
    exit;
}

echo json_encode(['success' => false, 'errors' => ['Invalid request.']]);
