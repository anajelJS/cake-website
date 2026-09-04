<?php
$name = $_POST['name'] ?? '';
$surname = $_POST['surname'] ?? '';
$cake = $_POST['cake'] ?? '';
$email = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

$errors = [];

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Please enter a valid email address';
}

if (empty($name)) {
    $errors[] = 'Please enter your name';
} elseif (!preg_match('/^[a-zA-Z]+$/', $name)) {
    $errors[] = 'Please enter a valid name';
}

if (empty($surname)) {
    $errors[] = 'Please enter your surname';
} elseif (!preg_match('/^[a-zA-Z]+$/', $surname)) {
    $errors[] = 'Please enter a valid surname';
}

if (empty($cake)) {
    $errors[] = 'Please select a cake';
}

if (empty($message)) {
    $errors[] = 'Please enter a message';
} else {
    if (!function_exists('hasTwoLetters')) {
        function hasTwoLetters($message) {
            $letters = 0;
            for ($i = 0; $i < strlen($message); $i++) {
                if (ctype_alpha($message[$i])) {
                    $letters++;
                }
            }
            return $letters >= 2;
        }
    }
    if (!hasTwoLetters($message)) {
        $errors[] = 'Message must contain at least 2 letters.';
    }
}

$success = empty($errors);
?>
